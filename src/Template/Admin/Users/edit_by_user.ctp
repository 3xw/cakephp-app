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
        <?= $this->Html->link('<i class="material-icons">vpn_key</i> '.__d('CakeDC/Users', 'Change Password'), ['action' => 'changePassword'],['class' => '','escape' => false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-8 mx-auto">
    <div class="card">
      <?= $this->Form->create($user) ?>
      <div class="card-header">
        <h2><?= __('Edit My Profile') ?></h2>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            
            <?php
            //echo $this->Form->input('username', ['class' => 'form-control']);
            echo $this->Form->input('email', ['class' => 'form-control']);
            //echo $this->Form->input('password', ['class' => 'form-control']);
            echo $this->Form->input('first_name', ['class' => 'form-control']);
            echo $this->Form->input('last_name', ['class' => 'form-control']);
            ?>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <div class="btn-group">
            <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
          </div>
        </div>
      </div>
      <?= $this->Form->end() ?>
  </div>
</div>
</div>
<div class="utils--spacer-default"></div>
