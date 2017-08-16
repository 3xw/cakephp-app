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

<nav class="navbar navbar-transparent navbar-absolute">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse">

      <ul class="nav navbar-nav navbar-right">
        <?php
        $registrationActive = Configure::read('Users.Registration.active');
        if ($registrationActive) {
          echo '<li>'.$this->Html->link(__d('CakeDC/Users', 'Register'), ['action' => 'register'],['class' => 'btn btn-default']).'</li>';
        }
        ?>
        <?= '<li>'.$this->Html->link(__d('CakeDC/Users', 'Retour au login'), ['action' => 'login'],['class' => '']).'</li>'; ?>
      </ul>
    </div>
  </div>
</nav>


<div class="wrapper wrapper-full-page">
  <div class="full-page login-page" data-color="" data-image="">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <?= $this->Form->create('User')?>

              <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
              <div class="card card-hidden">
                <div class="header text-center">Mot de passe oublié</div>
                <div class="content">

                  <!--FALSH -->
                  <p>
                    <?= $this->Flash->render() ?>
                    <?= $this->Flash->render('auth') ?>
                  </p>

                  <!--FORM -->
                  <div class="form-group">
                    <label><?= __d('CakeDC/Users', 'Please enter your email to reset your password') ?></label>
                    <?= $this->Form->input('reference', ['required' => true,'class' => 'form-control', 'label' => false]) ?>
                  </div>

                </div>
                <div class="footer text-center">
                  <button type="submit" class="btn btn-fill btn-success btn-wd">Envoyer</button>
                </div>
              </div>

            <?= $this->Form->end() ?>

          </div>
        </div>
      </div>
    </div>

    <footer class="footer footer-transparent">
      <div class="container">
        <nav class="pull-left">
          <ul>
            <li>
              <?= $this->Html->link('Accueil','/'); ?>
            </li>
          </ul>
        </nav>
        <p class="copyright pull-right">
          © <?= date('Y') ?> <a href="http://www.3xw.ch" target="_blank">3xW Sàrl</a>, made with love for a better web
        </p>
      </div>
    </footer>

  </div>
