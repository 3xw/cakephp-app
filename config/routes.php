<?php
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->connect('/admin', ['controller' => 'Dashboard', 'action' => 'index', 'prefix'=> 'admin', 'plugin' => false]);
    $routes->fallbacks(DashedRoute::class);
});

// ADMIN SECTION
Router::prefix('admin', function ($routes) {
  $routes->connect('/dashboard/home', ['controller' => 'Dashboard', 'action' => 'index']);
  $routes->extensions(['json']);
  $routes->fallbacks('DashedRoute');
});

Plugin::routes();
