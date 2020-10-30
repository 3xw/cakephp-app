<?php
declare(strict_types=1);
namespace App\Controller\Admin;

use Exception;
use CakeDC\Users\Exception\UserNotActiveException;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use Cake\Core\Configure;
use Cake\Validation\Validator;
use Cake\I18n\I18n;
use Cake\Event\Event;
use CakeDC\Users\Controller\UsersController as CakeDCUsersController;
use Cake\Controller\Component\AuthComponent;
use Cake\Datasource\EntityInterface;
use CakeDC\Users\Plugin as CakeDCPlugin;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*/
class UsersController extends CakeDCUsersController
{
  public $paginate = [
    'limit' => 100,
    'maxLimit' => 200,
    'order' => [
      'Users.last_name' => 'ASC'
    ]
  ];

  public function initialize():void
  {
    parent::initialize();
    $this->loadComponent('Search.Search', [
      'actions' => ['index']
    ]);
  }


  public function register()
  {
    $this->viewBuilder()->setLayout('login');
    return parent::register();
  }

  public function login()
  {
    $this->viewBuilder()->setLayout('login');
    return parent::login();
  }

  public function view($id = null)
  {
    $user = $this->Users->get($id,['contain' => ['Attachments']]);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
  }

  /**
  * Index method
  *
  * @return \Cake\Http\Response|void
  */
  public function index()
  {
    $query = $this->Users->find('search', ['search' => $this->getRequest()->getQuery()])->contain([]);
    if (isset($this->getRequest()->params['?'])) {
      if (!$query->count()) {
        $this->Flash->error(__('No result.'));
      }else{
        $this->Flash->success($query->count()." ".__('result(s).'));
      }
      $this->set('q',$this->getRequest()->params['?']['q']);
    }
    $users = $this->paginate($query);
    $this->set(compact('users'));
    $this->set('_serialize', ['users']);
  }

  public function add()
  {
    $user = $this->Users->newEmptyEntity();
    if ($this->getRequest()->is('post')) {
      $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The parser could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);

  }

  public function edit($id = null)
  {
    $user = $this->Users->get($id,[
      'contain' => ['Attachments']
    ]);

    if ($this->getRequest()->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));

        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
  }

  public function editByUser()
  {
    $user = $this->Users->get($this->getRequest()->getAttribute('identity')['id'],[
      'contain' => ['Attachments']
    ]);
    if ($this->getRequest()->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));

        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
  }

  /* FROM SUPER USER
  ***************************/
  public function changeUserPassword($id = null)
  {
    $user = $this->Users->get($id);

    if ($this->getRequest()->is(['patch', 'post', 'put'])) {
      try {

        // validation
        $validator = $this->getUsersTable()->validationPasswordConfirm(new Validator());
        if (!empty($id)) $validator = $this->getUsersTable()->validationCurrentPassword($validator);

        // save
        $user = $this->getUsersTable()->patchEntity($user, $this->getRequest()->getData(), ['validate' => $validator]);
        if ($result = $this->getUsersTable()->changePassword($user))
        {
          $this->Flash->success(__d('CakeDC/Users', 'Password has been changed successfully'));
          return $this->redirect(['action' => 'index']);
        }
        else $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));

      } catch (UserNotFoundException $exception) {
        $this->Flash->error(__d('CakeDC/Users', 'User was not found'));
      } catch (WrongPasswordException $wpe) {
        $this->Flash->error(__d('CakeDC/Users', '{0}', $wpe->getMessage()));
      } catch (Exception $exception){
        $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
      }
    }

    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
  }
}
