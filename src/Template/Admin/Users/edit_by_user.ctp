<?php use Cake\Core\Configure; ?>
<?= $this->element('header',['title' => __('Edit My Profile')]) ?>
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <?= $this->Form->create($user); ?>
        <section class="card">
          <header class="header">
            <h3><?= __('Edit My Profile') ?></h3>
          </header>
          <div class="content">
            <?php echo $this->Form->input('attachment_id',['style' => 'display:none;','label' => false]) ?>
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
            <div class="btn-group">
              <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-sm btn-info btn-fill']) ?>
              <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success btn-fill']) ?>
            </div>
          </div>
        </section>
        <?= $this->Form->end() ?>
      </div>

    </div>
  </div>
</div>
