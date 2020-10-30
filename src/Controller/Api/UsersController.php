<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Core\Configure;
use App\Controller\AppController;

class UsersController extends AppController
{
  public function initialize():void
  {
    parent::initialize();
    debug(Configure::read('Auth.AuthorizationMiddleware'));
  }

  public function whoAmI()
  {
    $this->set('data', $this->Auth->user());
    $this->set('_serialize', ['data']);
  }
}
