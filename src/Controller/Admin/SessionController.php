<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
* Session Controller
*
* @property \App\Model\Table\SessionTable $Session
*/
class SessionController extends AppController
{

  // will be renamme
  public function storeKeyValue()
  {
    if ($this->request->is('post'))
    {
      $this->request->session()->write($this->request->data['key'],$this->request->data['value']);
    }
    $this->set('data', $this->request->data);
    $this->set('_serialize', ['data']);
  }

  public function setKeyValue()
  {
      $this->storeKeyValue();
  }


  public  function getKeyValue()
  {
    $data = [];
    if ($this->request->is('post'))
    {
      $data = $this->request->session()->read($this->request->data['key']);
    }
    $this->set('data', $data);
    $this->set('_serialize', ['data']);
  }

}
