<?php use Cake\Core\Configure; ?>
<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\User $user
*/
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit profile'), ['controller' => 'Users', 'action' => 'editByUser'],['class' =>'', 'escape'=>false]); ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">vpn_key</i> '.__d('CakeDC/Users', 'Change Password'), ['action' => 'changePassword'],['class' => '','escape' => false]) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">vpn_key</i> '.__d('CakeDC/Users', 'Logout'),['controller' => 'Users', 'action' => 'logout','prefix' => false, 'plugin' => 'CakeDC/Users'],['class' => '','escape' => false] ) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-6 mx-auto">
    <div class="card"> 
      <!-- CONTENT -->
      <div class="card-body text-center">
        <h4 class="title">
          <?= $user->first_name.' '.$user->last_name ?>
          <br>
          <small>
            <?= $user->username ?>
          </small>
        </h4>
        <p>
          <?= $user->email ?>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="utils--spacer-default"></div>
