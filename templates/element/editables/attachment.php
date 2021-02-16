<?
/*
$html = $this->Attachment->input('Attachments', // if Attachments => HABTM else if !Attachments => belongsTo
['label' => __('Images'),
'types' =>['image/jpeg','image/png', 'application/pdf', 'video/mp4'],
'atags' => [],
  'restrictions' => [
    Trois\Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
    Trois\Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
  ],
  'attachments' => $article->attachments?? [] // array of exisiting Attachment entities ( HABTM ) or entity ( belongsTo )
]);

echo $this->Html->tag('cms-editable-attachment', $html, $attributes);
*/
?>
