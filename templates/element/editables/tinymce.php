<?php
$html = $this->element('Trois/Tinymce.tinymce',[
  'field' => 'body',
  'value' => $entity->{$field},
  'init' => [
    'external_plugins' => [
      'attachment' => $this->Url->build('/attachment/js/Plugins/tinymce/plugin.min.js', ['fullBase' => true]),
    ],
    'attachment_settings' => $this->Attachment->setup('body',[
      'types' => [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'image/jpeg',
        'image/png',
        'image/gif',
        'embed/youtube',
        'embed/vimeo'
      ],
      'atags' => [],
      'restrictions' => [
        Trois\Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
        Trois\Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
      ],
    ])
  ]
]);

echo $this->Html->tag('cms-editable-inputs-handler', $html, $attributes);
?>
