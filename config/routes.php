<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

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
  $routes->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
  $routes->setExtensions(['json']);
  $routes->fallbacks(DashedRoute::class);
});

/**
* If you need a different set of middleware or none at all,
* open new scope and define routes there.
*
* ```
* Router::scope('/api', function (RouteBuilder $routes) {
*     // No $routes->applyMiddleware() here.
*     // Connect API actions here.
* });
* ```
*/
