<?php
use Cake\Core\Configure;
unset($user->password);
?>

<?= $this->element('header',['title' => __('Change Password'),'menus' => [
  '<i class="fa fa-list"></i><p>'.__('List').'</p>' => ['action' => 'index'],
  '<i class="fa fa-plus"></i><p>'.__('Add').'</p>' => ['action' => 'add'],
  '<i class="fa fa-edit"></i><p>'.__('Edit').'</p>' => ['action' => 'edit'],
  ]]) ?>

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-6">
        <?= $this->Form->create($user) ?>
        <div class="card">
          <div class="header">
            <h3 class="panel-title">
              <?= __d('CakeDC/Users', 'Please enter the new password') ?>
            </h3>
          </div>
          <div class="content">
            <div class="users form">

              <?= $this->Form->input('password',['class' => 'form-control']); ?>
              <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true,'class' => 'form-control']); ?>
              <div class="btn-group">
                <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-sm btn-info btn-fill']) ?>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success btn-fill']) ?>
              </div>
            </div>
          </div>
        </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>
