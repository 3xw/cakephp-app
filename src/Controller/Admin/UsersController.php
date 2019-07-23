<?php
declare(strict_types=1);
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
  public function beforeFilter(EventInterface $event)
  {
    $this->Authentication->allowUnauthenticated(['login']);
  }

  public function login()
  {
    $result = $this->Authentication->getResult();

    // regardless of POST or GET, redirect if user is logged in
    debug($result);
    if ($result->isValid())
    {
      $redirect = $this->request->getQuery('redirect', ['action' => 'index']);
      return $this->redirect($redirect);
    }

    // display error if user submitted and authentication failed
    if ($this->request->is(['post']) && !$result->isValid())
    {
      $this->Flash->error('Invalid username or password');
    }
  }

  public function index()
  {
    $this->paginate = [
      'contain' => ['Attachments'],
    ];
    $users = $this->paginate($this->Users);

    $this->set(compact('users'));
  }

  public function view($id = null)
  {
    $user = $this->Users->get($id, [
      'contain' => ['Attachments', 'SocialAccounts'],
    ]);

    $this->set('user', $user);
  }

  public function add()
  {
    $user = $this->Users->newEmptyEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $attachments = $this->Users->Attachments->find('list', ['limit' => 200]);
    $this->set(compact('user', 'attachments'));
  }

  public function edit($id = null)
  {
    $user = $this->Users->get($id, [
      'contain' => [],
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $attachments = $this->Users->Attachments->find('list', ['limit' => 200]);
    $this->set(compact('user', 'attachments'));
  }

  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
      $this->Flash->success(__('The user has been deleted.'));
    } else {
      $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
