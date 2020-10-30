<?php
return [
  'Trois.modifyConfigure.rules' => [

    [ // load api configure
      'config' => 'api',
      'debug' => '*',
      'method' => '*', // ['GET','POST','PUT','DELETE'] or '*'
      'prefix' => 'Api',
      'plugin' => '*',
      'controller' => '*',
      'action' => '*',
      'extension' => '*',
    ]
  ]
];
