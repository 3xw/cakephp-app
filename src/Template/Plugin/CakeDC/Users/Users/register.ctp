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

<nav class="navbar navbar-transparent navbar-absolute">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">

      <ul class="nav navbar-nav navbar-right">
        <li>
          <?= $this->Html->link('Looking to login?',['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'login']) ?>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="wrapper wrapper-full-page">
  <div class="full-page register-page" data-color="red" data-image="<?= $this->Url->build('/img/admin/bg.jpg') ?>">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="header-text">
              <h2>Creation de compte</h2>
              <h4>Inscris toi vite vite à notre admin et reçois des newsletters toute ta vie</h4>
              <hr>
              <!--FALSH -->
              <p>
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('auth') ?>
              </p>
            </div>
          </div>
          <div class="col-md-4 col-md-offset-2">
            <div class="media">
              <div class="media-left">
                <div class="icon">
                  <i class="pe-7s-user"></i>
                </div>
              </div>
              <div class="media-body">
                <h4>Pire gartuit</h4>
                Here you can write a feature description for your dashboard, let the users know what is the value that you give them.
              </div>
            </div>

            <div class="media">
              <div class="media-left">
                <div class="icon">
                  <i class="pe-7s-graph1"></i>
                </div>
              </div>
              <div class="media-body">
                <h4>On est pire fort</h4>
                Here you can write a feature description for your dashboard, let the users know what is the value that you give them.

              </div>
            </div>

            <div class="media">
              <div class="media-left">
                <div class="icon">
                  <i class="pe-7s-headphones"></i>
                </div>
              </div>
              <div class="media-body">
                <h4>Jamais joignable</h4>
                Here you can write a feature description for your dashboard, let the users know what is the value that you give them.

              </div>
            </div>

          </div>
          <div class="col-md-4 col-md-offset-s1">
            <?= $this->Form->create($user); ?>
              <div class="card card-plain">
                <div class="content">
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
                </div>
                <div class="footer text-center">
                  <button type="submit" class="btn btn-fill btn-neutral btn-wd">Create Free Account</button>
                </div>
              </div>
            <?= $this->Form->end() ?>

          </div>
        </div>
      </div>
    </div>

    <footer class="footer footer-transparent">
      <div class="container">
        <p class="copyright text-center">
          © <?= date('Y') ?> <a href="http://www.3xw.ch" target="_blank">3xW Sàrl</a>, made with love for a better web
        </p>
      </div>
    </footer>

    <div class="full-page-background" style="background-image: url(<?= $this->Url->build('/img/admin/bg.jpg') ?>) "></div></div>

  </div>


  <!--
  <div class="users form large-10 medium-9 columns">
  <?= $this->Form->create($user); ?>
  <fieldset>
  <legend><?= __d('CakeDC/Users', 'Add User') ?></legend>
  <?php
  echo $this->Form->input('username');
  echo $this->Form->input('email');
  echo $this->Form->input('password');
  echo $this->Form->input('password_confirm', ['type' => 'password']);
  echo $this->Form->input('first_name');
  echo $this->Form->input('last_name');
  if (Configure::read('Users.Tos.required')) {
  echo $this->Form->input('tos', ['type' => 'checkbox', 'label' => __d('CakeDC/Users', 'Accept TOS conditions?'), 'required' => true]);
}
if (Configure::read('Users.reCaptcha.registration')) {
echo $this->User->addReCaptcha();
}
?>
</fieldset>
<?= $this->Form->button(__d('CakeDC/Users', 'Submit')) ?>
<?= $this->Form->end() ?>
</div>
-->
