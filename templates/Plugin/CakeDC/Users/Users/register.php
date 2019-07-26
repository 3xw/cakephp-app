<?php
/**
* Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/
use Cake\Core\Configure;
$this->layout = 'login';
?>

<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">

      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <? $registrationActive = Configure::read('Users.Registration.active');
        if ($registrationActive) : ?>
        <li class="nav-item">
          <?= $this->Html->link(__d('CakeDC/Users', 'S\'inscrire'), ['action' => 'register'],['class' => '']) ?>
        </li>
      <? endif ?>
      <li class="nav-item">
        <?= $this->Html->link(__d('CakeDC/Users', 'Retour au login'), ['action' => 'login'],['class' => '']) ?>
      </li>
    </ul>
  </div>
</nav>

<div class="utils--spacer-default"></div>
<div class="container">
  <?= $this->Flash->render() ?>
  <?= $this->Flash->render('auth') ?>
  <div class="row no-gutters">

    <div class="col-md-8 col-sm-10 mx-auto col-lg-6">
      <div class="utils--spacer-double"></div>
      <div class="card ">
        <h2 class="text-center">Register</h2>

        <div class="utils--spacer-semi"></div>
        <?= $this->Form->create($user); ?>
        <div class="form-group">
          <?= $this->Form->input('username',['class' => 'form-control', 'label' => false,'placeholder' => 'Choose a username']) ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('email',['class' => 'form-control', 'label' => false,'placeholder' => 'Enter email']) ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('password',['class' => 'form-control', 'label' => false,'placeholder' => 'Password']) ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('password_confirm',['type' => 'password','class' => 'form-control', 'label' => false,'placeholder' => 'Password Confirmation']) ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('first_name',['class' => 'form-control', 'label' => false,'placeholder' => 'Your First Name']) ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('last_name',['class' => 'form-control', 'label' => false,'placeholder' => 'Your Last Name']) ?>
        </div>
        <?php if (Configure::read('Users.Tos.required')): ?>
          <?= $this->Form->input('tos', ['type' => 'checkbox', 'label' => __d('CakeDC/Users', 'Accept TOS conditions?'), 'required' => true]) ?>
        <?php endif; ?>
        <?php if (Configure::read('Users.reCaptcha.registration')): ?>
          <?= $this->User->addReCaptcha() ?>
          <p></p>
        <?php endif; ?>
        <div class="footer text-center">
          <button type="submit" class="btn btn-fill btn-neutral btn-wd">Create Free Account</button>
        </div>
        <?= $this->Form->end() ?>
      </div>

    </div>
  </div>
</div>
