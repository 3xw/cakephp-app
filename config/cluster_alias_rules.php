<?php
return [
  'Trois.clusterAlias.rules' => [

    [ // use reader
      'slave' => false,
      'latency' => false, //milliseconds
      'from' => 'default',
      'to' => 'default',
      'debug' => '*',
      'method' => '*', // ['GET','POST','PUT','DELETE'] or '*'
      'prefix' => '*',
      'plugin' => '*',
      'controller' => '*',
      'action' => '*',
      'extension' => '*',
    ]
  ]
];
