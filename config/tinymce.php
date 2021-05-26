<?php
return [
  'Trois/Tinymce'  => [
    'height' => 500,
    'language' => 'fr_FR',
    'language_url' => 'https://static.3xw.ch/tinymce/5.1/lang/fr_FR.js',
    'menubar' => false,
    'plugins' => ['attachment advlist autolink lists link charmap print preview searchreplace visualblocks code fullscreen emoticons insertdatetime table paste  code help wordcount'],
    'toolbar'  => 'attachment | insert | undo redo | links | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | emoticons | code | removeformat ',
    'block_formats' => 'Paragraphe=p;Titre 1=h1;Titre 2=h2;Titre 3=h3',
    'formats' => [
      'bold' => ['inline'  => 'strong'],
      'italic' => ['inline'  => 'em'],
      'underline' => ['inline'  => 'u'],
      'strikethrough' => ['inline'  => 'del'],
      'lead' => ['block'  => 'p', 'classes'  => 'lead'],
    ],
    'valid_elements' => '*[style],p[style],strong,em,i,u,del,a[href|target],ul,ol,li[style],table,th,td[style],tr,img[src|style|class|alt|width|height]',
    'valid_styles' => ['*' => 'text-align,color'],
    'content_css' => [],
    'theme' => 'silver',
    'mobile' => [
      'theme' => 'silver',
    ]
  ]
];
