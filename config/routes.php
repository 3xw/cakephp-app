<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
  // Register scoped middleware for in scopes.
  $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
    'httpOnly' => true
  ]));
  $builder->applyMiddleware('csrf');
  $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
  $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

  $builder->fallbacks();
});

// ADMIN SECTION
$routes->prefix('admin', function (RouteBuilder $builder) {
  $builder->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
  $builder->setExtensions(['json']);
  $builder->fallbacks();
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
