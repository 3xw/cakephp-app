<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\I18n\I18n;
use Cake\Routing\Router;

class AppController extends Controller
{
  public function initialize(): void
  {
    parent::initialize();

    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');

    /*
     * Enable the following component for recommended CakePHP form protection settings.
     * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
     */
    //$this->loadComponent('FormProtection');
  }

  public function beforeFilter(EventInterface $event)
  {
    // layout
    if (null !== $this->request->getParam('prefix') && $this->request->getParam('prefix') == 'Admin') {
      $this->viewBuilder()->setLayout('admin');
    }

    // locale
    $lng = I18n::getLocale();
    $this->set('lng', $lng);

    // urls
    $this->set('referer', $this->referer());
    $this->set('fullBase', Router::url('/',true));
  }
}
