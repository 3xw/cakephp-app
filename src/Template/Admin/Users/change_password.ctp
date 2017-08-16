<?php use Cake\Core\Configure; ?>
<?= $this->element('header',['title' => __('Change Password')]) ?>
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
