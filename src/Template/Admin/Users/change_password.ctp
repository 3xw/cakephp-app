<?php use Cake\Core\Configure; ?>
<nav class="navbar navbar-expand">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Change Password') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($user) ?>


      <?php if ($validatePassword) : ?>
        <?= $this->Form->input('current_password', [
          'type' => 'password',
          'required' => true,
          'label' => __d('CakeDC/Users', 'Current password'),
          'class' => 'form-control'
        ]);
        ?>
      <?php endif; ?>
      <?= $this->Form->input('password',['class' => 'form-control']); ?>
      <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true,'class' => 'form-control']); ?>
      <div class="text-right">
        <div class="btn-group">
          <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-sm btn-info btn-fill']) ?>
          <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success btn-fill']) ?>
        </div>
      </div>

      <?= $this->Form->end() ?>
    </div>
  </div>

</div>
