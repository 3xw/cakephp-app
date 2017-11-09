<?php
use Cake\Core\Configure;
$this->layout = 'login';

$this->Form->templates([
  'checkbox' => '
  <input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
  'checkboxWrapper' => '',
  'checkboxFormGroup' => '{{label}}',
  'label' => '{text}}',
  'formGroup' => '{{input}}{{label}}',
  'inputContainer' => '{{content}}',
]);

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
      <?   $registrationActive = Configure::read('Users.Registration.active');
      if ($registrationActive) : ?>
      <li class="nav-item">
        <?= $this->Html->link(__d('CakeDC/Users', 'S\'inscrire'), ['action' => 'register'],['class' => '']) ?>
      </li>
    <? endif ?>
    <li class="nav-item">
      <?= $this->Html->link(__d('CakeDC/Users', 'Mot de passe oublié'), ['action' => 'request_reset_password'],['class' => '']) ?>
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

      <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
      <div class="card">
        <div class="utils--spacer-semi"></div>

        <div class=" text-center">
          <?= $this->Attachment->image(['image' => 'admin/logo--login.png', 'profile' => 'img', 'width' => '200'], ['class' => 'img-responsive', 'width' => '127']) ?>
          <div class="utils--spacer-mini"></div>

          <h2>Connexion</h2>
        </div>



        <div class="utils--spacer-semi">

        </div>
        <?= $this->Form->create('User') ?>

        <div class="form-group">
          <label>Adresse Email</label>
          <?= $this->Form->input('email', ['required' => true,'class' => 'form-control', 'placeholder' =>"mon-email@gmail.com", 'label' => false]) ?>
        </div>
        <div class="form-group">
          <label>Mot de passe</label>
          <?= $this->Form->input('password', ['required' => true,'class' => 'form-control', 'label' => false]) ?>
        </div>
        <div class="checkbox">
          <?php
          if (Configure::check('Users.RememberMe.active')) {
            echo $this->Form->input(Configure::read('Users.Key.Data.rememberMe'), [
              'type' => 'checkbox',
              'label' => ' '.__d('CakeDC/Users', 'Remember me'),
              'checked' => 'checked',
              //'data-toggle' => "checkbox"
            ]);
          }
          ?>
        </div>
        <div class="footer text-center">
          <button type="submit" class="btn btn-fill btn-success btn-wd">Connexion</button>
        </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>
<footer class="footer">
  <nav class="navbar navbar-expand-lg fixed-bottom">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <?= $this->Html->link('Accueil','/'); ?>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          © <?= date('Y') ?> <a href="http://wgrcommunication.ch/h" target="_blank">WGR SA</a>
        </li>
      </ul>
    </div>
  </nav>
</footer>
