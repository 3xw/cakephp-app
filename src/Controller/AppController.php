<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
  public function initialize(): void
  {
    parent::initialize();

    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');

    $this->loadComponent('Authentication.Authentication', [
      'logoutRedirect' => '/users/login'  // Default is false
    ]);

    /*
    * Enable the following component for recommended CakePHP security settings.
    * see https://book.cakephp.org/3.0/en/controllers/components/security.html
    */
    //$this->loadComponent('Security');
  }

  public function beforeFilter(EventInterface $event)
  {
    $this->set("referer", $this->referer());
  }
}
