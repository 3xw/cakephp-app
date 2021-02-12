<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder)
{
  //$builder->redirect('/', '/admin/users/login', ['status' => 302]);
  $builder->connect('/', ['plugin' => false, 'controller' => 'Pages', 'action' => 'display', 'home']);
  $builder->connect('/pages/*', ['plugin' => false, 'controller' => 'Pages', 'action' => 'display']);

  $builder->connect('/*', ['plugin' => false, 'controller' => 'Pages', 'action' => 'view']);

  $builder->fallbacks();
});

// ADMIN SECTION
$routes->prefix('Admin', function (RouteBuilder $builder)
{
  $builder->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
  $builder->setExtensions(['json']);
  $builder->fallbacks();
});

// API SECTION
$routes->prefix('Api', function (RouteBuilder $builder)
{
  $resources = [];
  foreach($resources as $res) $builder->resources($res,['inflect' => 'dasherize']);

  $builder->setExtensions(['json']);
  $builder->fallbacks();
});
