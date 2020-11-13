<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class ErrorController extends AppController
{
  public function beforeRender(EventInterface $event)
  {
    parent::beforeRender($event);

    $this->viewBuilder()->setTemplatePath('Error');
  }
}
