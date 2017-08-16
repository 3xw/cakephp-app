<?= $this->element('header',['title' => __('Add User'),'menus' => [
  '<i class="fa fa-list"></i><p>'.__('List').'</p>' => ['action' => 'index']
  ]]) ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">

        <!-- LIST ELEMENT -->
        <div class="card">

          <!-- HEADER -->
          <div class="header">
              <h3><?= __('Add User') ?></h3>
          </div>

          <!-- CONTENT -->
          <div class="content">

            <!-- FORM -->
            <?= $this->Form->create($user); ?>
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
                  'attachments' => []
                ])
                ?>
              </div>
              <div class="col-md-6">
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

            </div>

            <div class="btn-group">
              <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-sm btn-info btn-fill']) ?>
              <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success btn-fill']) ?>
            </div>

            <?= $this->Form->end() ?>

          </div><!-- end content-->
        </div><!-- end card-->
      </div><!-- end col-xs-12-->
    </div><!-- end row-->
  </div><!-- end container-fluid-->
</div><!-- end content-->
