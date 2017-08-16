<?php
namespace App\Controller\Admin;


use CakeDC\Users\Exception\UserNotActiveException;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use Cake\Core\Configure;
use Cake\Validation\Validator;
use Exception;
use Cake\Event\Event;
use CakeDC\Users\Controller\UsersController as CakeDCUsersController;
use Cake\Controller\Component\AuthComponent;
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
  ];

  public function view($id = null)
  {
    $user = $this->Users->get($id,['contain' => ['Attachments']]);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
  }

  public function index()
  {
    $this->set('users', $this->paginate($this->Users->find('search', ['search' => $this->request->query])));
    $this->set(compact('users'));
    $this->set('_serialize', ['users']);
  }

  public function add()
  {
    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->data);
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

    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->data);
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

  public function editByUser($id = null)
  {
    $user = $this->Users->get($id,[
      'contain' => ['Attachments']
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->data);
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

    if ($this->request->is(['patch', 'post', 'put'])) {
      try {
        $validator = $this->getUsersTable()->validationPasswordConfirm(new Validator());
        if (!empty($id)) {
          $validator = $this->getUsersTable()->validationCurrentPassword($validator);
        }
        $user = $this->getUsersTable()->patchEntity($user, $this->request->data(), ['validate' => $validator]);
        if ($user->errors()) {
          $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
        } else {
          $user = $this->getUsersTable()->changePassword($user);
          if ($user) {
            $this->Flash->success(__d('CakeDC/Users', 'Password has been changed successfully'));

            return $this->redirect(['action' => 'index']);
          } else {
            $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
          }
        }
      } catch (UserNotFoundException $exception) {
        $this->Flash->error(__d('CakeDC/Users', 'User was not found'));
      } catch (WrongPasswordException $wpe) {
        $this->Flash->error(__d('CakeDC/Users', '{0}', $wpe->getMessage()));
      } catch (Exception $exception) {
        $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
      }
    }

    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
  }
}
