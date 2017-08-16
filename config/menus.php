<?php
return [
  'Menus' => [

    /* Menu superuser
    *************************/
    'superuser' => [
      '<i class="pe-7s-cloud"></i><p>'.__('Attachments').'</p>' => ['controller' => 'Attachments', 'action' => 'index','prefix' => 'admin', 'plugin' => false],
      '<i class="pe-7s-users"></i><p>'.__('Users').'</p>' => ['controller' => 'Users', 'action' => 'index','prefix' => 'admin', 'plugin' => false],
    ],

    /* Menu admin
    *************************/
    'admin' => [
      '<i class="pe-7s-cloud"></i><p>'.__('Attachments').'</p>' => ['controller' => 'Attachments', 'action' => 'index','prefix' => 'admin', 'plugin' => false],
      '<i class="pe-7s-users"></i><p>'.__('Users').'</p>' => ['controller' => 'Users', 'action' => 'index','prefix' => 'admin', 'plugin' => false],
    ],
]];
