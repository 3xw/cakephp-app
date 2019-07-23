<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

// Authentication
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Psr\Http\Message\ServerRequestInterface;


// Authorization
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Policy\OrmResolve;

class Application extends BaseApplication implements AuthenticationServiceProviderInterface//,AuthorizationServiceProviderInterface
{

  public function bootstrap(): void
  {
    parent::bootstrap();
    if (PHP_SAPI === 'cli') $this->bootstrapCli();
    if (Configure::read('debug')) $this->addPlugin('DebugKit');

    // Load more plugins here
    //$this->addPlugin('Authentication');
    //$this->addPlugin('Authorization');
  }

  public function getAuthorizationService(ServerRequestInterface $request)
  {
    return new AuthorizationService(new OrmResolver());
  }

  public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
  {
    $service = new AuthenticationService();

    $fields = [
      'username' => 'email',
      'password' => 'password'
    ];

    // Load identifiers
    $service->loadIdentifier('Authentication.Password', compact('fields'));

    // Load the authenticators, you want session first
    $service->loadAuthenticator('Authentication.Session');
    $service->loadAuthenticator('Authentication.Form', [
      'fields' => $fields,
      'loginUrl' => '/users/login'
    ]);

    return $service;
  }

  public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
  {
    $middlewareQueue
    ->add(new ErrorHandlerMiddleware(null, Configure::read('Error')))
    ->add(new AssetMiddleware([
      'cacheTime' => Configure::read('Asset.cacheTime'),
    ]))
    ->add(new RoutingMiddleware($this))
    ;//->add(new AuthenticationMiddleware($this))
    //->add(new AuthorizationMiddleware($this));

    return $middlewareQueue;
  }

  /**
  * @return void
  */
  protected function bootstrapCli(): void
  {
    try {
      $this->addPlugin('Bake');
    } catch (MissingPluginException $e) {
      // Do not halt if the plugin is missing
    }

    // Load more plugins here
  }
}
