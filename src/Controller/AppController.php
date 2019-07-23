<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
  public function initialize(): void
  {
    parent::initialize();

    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');

    /*
    * Enable the following component for recommended CakePHP security settings.
    * see https://book.cakephp.org/3.0/en/controllers/components/security.html
    */
    //$this->loadComponent('Security');

    $this->loadComponent('Authentication.Authentication', [
      'logoutRedirect' => '/plugins/cakephp-app/admin/users/login'  // Default is false
    ]);
  }
}
