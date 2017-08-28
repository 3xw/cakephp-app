<?= $this->element('header',['title' => __('Attachments')]) ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">

          <!-- HEADER -->
          <div class="header">
            <h4 class="title"><?= __('Attachments library') ?></h4>
            <p class="category">
              <?= __('Manage your attachments') ?>
            </p>
          </div>

          <!-- CONTENT -->
          <div class="content">

            <!-- Attachments element -->
            <?= $this->Attachment->buildIndex([
              'actions' => ['add','edit','delete','download'],
              'types' =>['image/jpeg','image/png','embed/youtube','embed/vimeo'],
              'atags' => [],
              'restrictions' => [
                Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
                Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
              ]
            ]) ?>

          </div>

        </div><!-- end card-->
      </div><!-- end col-xs-12-->
    </div><!-- end row-->
  </div><!-- end container-fluid-->
</div><!-- end content-->
