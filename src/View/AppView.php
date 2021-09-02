<?php
declare(strict_types=1);

namespace App\View;

use Cake\View\View;

class AppView extends View
{
  public function initialize(): void
  {
    $this->loadHelper('Form', ['templates' => 'app_form']);
    $this->loadHelper('Vue');
    $this->loadHelper('Trois/Attachment.Attachment');
    //$this->loadHelper('Trois/Cms.Cms');
  }
}
