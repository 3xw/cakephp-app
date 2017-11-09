<nav class="navbar navbar-expand">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Attachments') ?></span>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-11 mx-auto">
        <div class="card">

          <!-- HEADER -->
          <div class="header">
            <h3 class="title"><?= __('Attachments library') ?></h3>
            <p class="category">
              <?= __('Manage your attachments') ?>
            </p>
          </div>

          <!-- CONTENT -->
          <div class="content">

            <!-- Attachments element -->
            <?= $this->Attachment->buildIndex([
              'actions' => ['add','edit','delete','view'],
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
