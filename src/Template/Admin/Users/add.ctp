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
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($user) ?>
      <div class="card-header">
        <h2><?= __('Add User') ?></h2>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8">
            <?php
            echo $this->Form->input('username', ['class' => 'form-control','required' => 'required','placeholder' => 'john_doe']);
            echo $this->Form->input('email', ['class' => 'form-control','required' => 'required','placeholder' => 'john.doe@gmail.com']);
            echo $this->Form->input('password', ['class' => 'form-control','required' => 'required']);
            echo $this->Form->input('first_name', ['class' => 'form-control','required' => 'required','placeholder' => 'John']);
            echo $this->Form->input('last_name', ['class' => 'form-control','required' => 'required','placeholder' => 'Doe']);
            echo $this->Form->input('role', ['class' => 'form-control','options' => ['admin' => 'admin']]);
            echo $this->Form->input('active', ['type' => 'hidden','value' => 1]);
            ?>
          </div>
          <div class="col-sm-4">
            <?= $this->Attachment->input('attachment_id',[
              'label' => __('Avatar'),
              'types' =>['image/jpeg','image/png'],
              'atags' => [],
              'cols' => 'col-xs-6 col-md-6 col-lg-4',
              'maxquantity' => 1,
              'restrictions' => [
                Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
                Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
                ],
                'attachments' => []
              ]
            );?>
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
