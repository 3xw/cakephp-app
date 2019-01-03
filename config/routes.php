<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Core\Plugin;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks(DashedRoute::class);
});

// ADMIN SECTION
Router::prefix('admin', function ($routes) {
  //$routes->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
  $routes->setExtensions(['json']);
  $routes->fallbacks(DashedRoute::class);
});

 // old but needed for CakeDC/Users :/
 Plugin::routes();
