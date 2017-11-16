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

    <!-- LIST ELEMENT -->
    <div class="card">



      <!-- FORM -->
      <?= $this->Form->create($user); ?>

      <!-- avatar -->
      <?= $this->Form->input('attachment_id', ['type' => 'hidden']); ?>
      <?= $this->Attachment->input('attachment_id',[
        'label' => 'avatar',
        'types' =>['image/jpeg','image/png','image/gif'],
        'atags' => ['avatar'],
        'restrictions' => [
          Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED,
          Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED
        ],
        'attachments' => []
      ])
      ?>

      <?php
      echo $this->Form->input('username', ['class' => 'form-control','required' => 'required','placeholder' => 'john_doe']);
      echo $this->Form->input('email', ['class' => 'form-control','required' => 'required','placeholder' => 'john.doe@gmail.com']);
      echo $this->Form->input('first_name', ['class' => 'form-control','required' => 'required','placeholder' => 'John']);
      echo $this->Form->input('last_name', ['class' => 'form-control','required' => 'required','placeholder' => 'Doe']);
      echo $this->Form->input('role', ['class' => 'form-control','options' => ['admin' => 'admin']]);
      echo $this->Form->input('active', ['type' => 'hidden','value' => 1]);
      ?>

      <div class="text-right">
        <div class="btn-group">
          <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-sm btn-info btn-fill']) ?>
          <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success btn-fill']) ?>
        </div>
      </div>

      <?= $this->Form->end() ?>

    </div><!-- end content-->
  </div><!-- end card-->
</div><!-- end col-xs-12-->
