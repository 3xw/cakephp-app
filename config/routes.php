<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

// csrf
$csrf = new CsrfProtectionMiddleware(['httponly' => true]);
$routes->registerMiddleware('csrf', $csrf);
$routes->applyMiddleware('csrf');

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder)
{

  $builder->setExtensions(['json']);
  $resources = [];
  foreach($resources as $res) $builder->resources($res);

  $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
  $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

  $builder->fallbacks();
});

// ADMIN SECTION
$routes->prefix('Admin', function (RouteBuilder $builder) {
  $builder->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
  $builder->setExtensions(['json']);
  $builder->fallbacks();
});
