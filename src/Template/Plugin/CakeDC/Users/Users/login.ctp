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
          echo '<li>'.$this->Html->link(__d('CakeDC/Users', 'S\'inscrire'), ['action' => 'register'],['class' => 'btn btn-default']).'</li>';
        }
        ?>
        <?= '<li>'.$this->Html->link(__d('CakeDC/Users', 'Mot de passe oublié'), ['action' => 'request_reset_password'],['class' => '']).'</li>'; ?>
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
          <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">
            <?= $this->Form->create('User')?>

            <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
            <div class="card card-hidden">
              <div class="container-flex">
                <div class="login-img">
                  <?= $this->Attachment->image(['image' => 'logo-sumus.png', 'profile' => 'img', 'width' => '254'], ['class' => 'img-responsive', 'width' => '127']) ?>
                </div>
                <div class="login-form">
                  <div class="header text-center">Connexion</div>
                  <div class="content">
                    <p>
                      <?= $this->Flash->render() ?>
                      <?= $this->Flash->render('auth') ?>
                    </p>
                    <div class="form-group">
                      <label>Adresse Email</label>
                      <?= $this->Form->input('email', ['required' => true,'class' => 'form-control', 'placeholder' =>"mon-email@gmail.com", 'label' => false]) ?>
                    </div>
                    <div class="form-group">
                      <label>Mot de passe</label>
                      <?= $this->Form->input('password', ['required' => true,'class' => 'form-control', 'label' => false]) ?>
                    </div>
                    <div class="form-group">
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
        <p class="copyright pull-right" style="color:#dadada;">
          © <?= date('Y') ?> <a href="http://wgrcommunication.ch/h" target="_blank">WGR SA</a>
        </p>
      </div>
    </footer>

  </div>

</div>
