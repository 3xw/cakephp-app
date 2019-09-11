<?= $this->Attachment->buildIndex([
  'actions' => ['add','edit','delete','view'],
  'types' =>['image/jpeg','image/png','embed/youtube','embed/vimeo','video/quicktime','transit/youtube'],
  'atags' => [],
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
