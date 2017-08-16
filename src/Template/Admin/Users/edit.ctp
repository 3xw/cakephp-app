<?php use Cake\Core\Configure; ?>
<?= $this->element('header',['title' => __('Edit User'),'menus' => [
  '<i class="fa fa-list"></i><p>'.__('List').'</p>' => ['action' => 'index'],
  '<i class="fa fa-plus"></i><p>'.__('Add').'</p>' => ['action' => 'add'],
  ]]) ?>
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <?= $this->Form->create($user); ?>
        <section class="card">
          <header class="header">
            <h3><?= __('Edit User') ?></h3>
          </header>
          <div class="content">

            <div class="row">
              <div class="col-md-12">
                <?php echo $this->Form->input('attachment_id',['style' => 'display:none;','label' => false]) ?>
                <!-- avatar -->
                <?= $this->Attachment->input('attachment_id',[
                  'label' => 'avatar',
                  'types' =>['image/jpeg','image/png','image/gif'],
                  'atags' => ['avatar'],
                  'restrictions' => [
                    Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED,
                    Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED
                  ],
                  'attachments' => $user->attachment? [$user->attachment]: []
                ])
                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->input('username', ['class' => 'form-control','required' => 'required','placeholder' => 'john_doe']);
                echo $this->Form->input('email', ['class' => 'form-control','required' => 'required','placeholder' => 'john.doe@gmail.com']);
                echo $this->Form->input('first_name', ['class' => 'form-control','required' => 'required','placeholder' => 'John']);
                echo $this->Form->input('last_name', ['class' => 'form-control','required' => 'required','placeholder' => 'Doe']);
                echo $this->Form->input('role', ['class' => 'form-control','required' => 'required','placeholder' => 'user']);
                //echo $this->Form->input('active', ['type' => 'checkbox','checked' => 'checked']);
                ?>
              </div>

            </div>
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
