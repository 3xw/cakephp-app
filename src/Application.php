<?php
declare(strict_types=1);

/**
* CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
* @link      https://cakephp.org CakePHP(tm) Project
* @since     3.3.0
* @license   https://opensource.org/licenses/mit-license.php MIT License
*/
namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

use Trois\Utils\Http\Middleware\CorsMiddleware;
use Trois\Utils\Http\Middleware\ClusterAliasMiddleware;
use Trois\Utils\Http\Middleware\CsrfProtectionMiddleware;
use Trois\Utils\Http\Middleware\ModifyConfigureMiddleware;

/**
* Application setup class.
*
* This defines the bootstrapping logic and middleware layers you
* want to use in your application.
*/
class Application extends BaseApplication
{
  /**
  * {@inheritDoc}
  */
  public function bootstrap(): void
  {
    // Call parent to load bootstrap from files.
    parent::bootstrap();

    if (PHP_SAPI === 'cli') {
      $this->bootstrapCli();
    }

    /*
    * Only try to load DebugKit in development mode
    * Debug Kit should not be installed on a production system
    */
    if (Configure::read('debug')) {
      $this->addPlugin('DebugKit');
    }

    // Load more plugins here
    Configure::load('users');
    $this->addPlugin(\CakeDC\Users\Plugin::class); // permissions.php automatically loaded...

    // Attachment
    $this->addPlugin(\Trois\Attachment\Plugin::class); // attachment.php automatically loaded...

    // pages
    $this->addPlugin(\Trois\Pages\Plugin::class);
  }

  /**
  * Setup the middleware queue your application will use.
  *
  * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
  * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
  */
  public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
  {
    // set body parser
    $bodies = new BodyParserMiddleware();
    $bodies->addParser(['application/vnd.api+json'], function ($body) {
        return json_decode($body, true);
    });

    $middlewareQueue
    ->add(CorsMiddleware::class)

    // Catch any exceptions in the lower layers,
    // and make an error page/response
    ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

    // Handle plugin/theme assets like CakePHP normally does.
    ->add(new AssetMiddleware([
      'cacheTime' => Configure::read('Asset.cacheTime'),
    ]))

    // Add routing middleware.
    // If you have a large number of routes connected, turning on routes
    // caching in production could improve performance. For that when
    // creating the middleware instance specify the cache config name by
    // using it's second constructor argument:
    // `new RoutingMiddleware($this, '_cake_routes_')`
    ->add(new RoutingMiddleware($this))

    // Parse various types of encoded request bodies so that they are
    // available as array through $request->getData()
    // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
    ->add($bodies)

    // TROIS AFTER Routing stuff!!
    ->add(ModifyConfigureMiddleware::class)
    ->add(CsrfProtectionMiddleware::class)
    ->add(ClusterAliasMiddleware::class);

    return $middlewareQueue;
  }

  /**
  * @return void
  */
  protected function bootstrapCli(): void
  {
    try {
      $this->addPlugin('Bake');
      $this->addPlugin(\Trois\Bake\Plugin::class);
    } catch (MissingPluginException $e) {
      // Do not halt if the plugin is missing
    }

    $this->addPlugin('Migrations');

    // Load more plugins here
  }
}
