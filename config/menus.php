<?php
return [
  'Menus' => [

    /* Menu superuser
    *************************/
    'superuser' => [
      '<i class="material-icons">photo</i><p>'.__('Attachments').'<b class="caret"></b></p>' => [
        'collapse' => [
          __('Attachments') => ['controller' => 'Attachments', 'action' => 'index','prefix' => 'Admin', 'plugin' => false],
          __('AtagTypes') => ['controller' => 'AtagTypes', 'action' => 'index','prefix' => 'Admin', 'plugin' => 'Trois/Attachment'],
          __('Atags') => ['controller' => 'Atags', 'action' => 'index','prefix' => 'Admin', 'plugin' => 'Trois/Attachment'],
        ]
      ],
      '<i class="material-icons">person</i><p>'.__('Users').'</p>' => ['controller' => 'Users', 'action' => 'index','prefix' => 'Admin', 'plugin' => false],
      '<i class="material-icons">edit</i><p>'.__('Pages').'</p>' => ['controller' => 'Pages', 'action' => 'index','prefix' => 'Admin', 'plugin' => 'Trois/Pages'],
    ],

    /* Menu admin
    *************************/
    'admin' => [
      '<i class="material-icons">photo</i><p>'.__('Attachments').'</p>' => ['controller' => 'Attachments', 'action' => 'index','prefix' => 'Admin', 'plugin' => false],
      '<i class="material-icons">view_module</i><p>'.__('AtagTypes').'</p>' => ['controller' => 'AtagTypes', 'action' => 'index','prefix' => 'Admin', 'plugin' => 'Trois/Attachment'],
      '<i class="material-icons">view_list</i><p>'.__('Atags').'</p>' => ['controller' => 'Atags', 'action' => 'index','prefix' => 'Admin', 'plugin' => 'Trois/Attachment'],
      '<i class="material-icons">done</i><p>'.__('Users').'</p>' => ['controller' => 'Users', 'action' => 'index','prefix' => 'Admin', 'plugin' => false],
    ],
]];
