<?php
return [
  'Trois.csrf.rules' => [
    [
      'prefix' => '*',
      'plugin' => 'Trois/Cms',
      'controller' => '*',
      'action' => '*'
    ],
    [ // HOOKS
      'prefix' => 'Api',
      'plugin' => false,
      'controller' => 'Hooks',
      'action' => '*',
    ],
    [ // SEARCH
      'prefix' => 'Api',
      'plugin' => false,
      'controller' => 'Search',
      'action' => '*',
    ],
  ]
];
