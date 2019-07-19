<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Partner[]|\Cake\Collection\CollectionInterface $partners
*/
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">

      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <!-- LIST ELEMENT -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">
          <?= __('Attachments library')?>
        </h2>
      </div>
      <!-- START CONTEMT -->
      <div class="card-body">
        <?= $this->Attachment->buildIndex([
          'actions' => ['add','edit','delete','view'],
          'types' =>['image/jpeg','image/png','embed/youtube','embed/vimeo','video/quicktime','transit/youtube'],
          'atags' => [
            'A1 Junction Grand-saconnex', 'A1 Goulet Crissier',
            'démolition','pont','terrassement','construction','marquage','etc','jour','nuit','coucher soleil','levé soleil'
          ],
          'atagsDisplay' => 'select', // false | 'select' | 'input'
          'restrictions' => [
            Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
            Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
          ],
          /*
          'listeners' => [
            'beforeSave' => [
              'Attachment\Listener\ModifyTypeListener' => [
                'type' => 'transit',
                'subtype' => 'youtube',
              ]
            ],
          ]*/
          ]) ?>
        </div>
        <!-- END CONTEMT -->
        <!-- START FOOTER -->
        <!-- END FOOTER -->
      </div><!-- end content-->
    </div><!-- end card-->
  </div><!-- end col-xs-12-->
