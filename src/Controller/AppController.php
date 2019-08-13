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

    /*
    * Enable the following component for recommended CakePHP security settings.
    * see https://book.cakephp.org/3.0/en/controllers/components/security.html
    */
    //$this->loadComponent('Security');
  }

  public function beforeFilter(EventInterface $event)
  {
    // auth
    //debug($this->request->getSession()->read());
    /*
    if(empty($this->Authentication)) $this->loadComponent('Authentication.Authentication');
    if (empty($this->request->getParam('prefix')))
    {
      if( !empty($this->request->getParam('prefix')) && ($this->request->getParam('prefix') == 'CakeDC/Users' || $this->request->getParam('prefix') == 'attachment'))
      {
        $this->Authentication->allowUnauthenticated(['login','register','proceed']);
      }else
      {
        $this->Authentication->allowUnauthenticated(['*']);
      }
    }else
    {
      $this->Authentication->allowUnauthenticated(['login','register']);
    }
    */
  }
}
