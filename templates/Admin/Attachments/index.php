<?= $this->Attachment->index([
  'types' =>['image/jpeg','image/png','embed/youtube','embed/vimeo','video/quicktime','transit/youtube', 'application/pdf','application/zip'],
  'atags' => [],
  'atagsDisplay' => 'select', // false | 'select' | 'input'
  'restrictions' => [
    Trois\Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
    Trois\Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
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
