<?php use Cake\Core\Configure; ?>
<nav class="navbar navbar-expand">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Edit User') ?>
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
      <?= $this->Form->create($user); ?>
      <!-- avatar -->
      <?= $this->Attachment->input('attachment_id',[
        'label' => 'Avatar',
        'types' =>['image/jpeg','image/png','image/gif'],
        'atags' => ['avatar',$user->username],
        'restrictions' => [
          Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
          Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
        ],
        'attachments' => $user->attachment? [$user->attachment]: []
      ])
      ?>
      <?php
      //echo $this->Form->input('username', ['class' => 'form-control']);
      echo $this->Form->input('email', ['class' => 'form-control']);
      //echo $this->Form->input('password', ['class' => 'form-control']);
      echo $this->Form->input('first_name', ['class' => 'form-control']);
      echo $this->Form->input('last_name', ['class' => 'form-control']);
      //echo $this->Form->input('token', ['class' => 'form-control']);
      //echo $this->Form->input('token_expires', ['class' => 'form-control']);
      //echo $this->Form->input('api_token', ['class' => 'form-control']);
      //echo $this->Form->input('activation_date', ['class' => 'form-control']);
      //echo $this->Form->input('tos_date', ['class' => 'form-control']);
      echo $this->Form->input('active', ['type' => 'checkbox']);
      //echo $this->Form->input('is_superuser', ['class' => 'form-control']);
      //echo $this->Form->input('role', ['class' => 'form-control']);
      ?>
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
