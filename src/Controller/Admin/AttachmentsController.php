<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class AttachmentsController extends AppController
{
  public function index(){}

  public function view()
  {
    $this->set('attachment', $this->Attachments->find()->first());
  }
}
