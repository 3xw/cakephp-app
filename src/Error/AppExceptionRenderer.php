<?php
namespace App\Error;

use Throwable;
use Psr\Http\Message\ResponseInterface;
use Cake\Error\ExceptionRenderer;
use Cake\Http\Exception\HttpException;
use Cake\Http\Exception\InvalidCsrfTokenException;
use Trois\Utils\Http\Middleware\CookieConsentMiddleware as Consent;

class AppExceptionRenderer extends ExceptionRenderer
{
  protected function _template(Throwable $exception, string $method, int $code): string
  {
    if($exception instanceof InvalidCsrfTokenException && !Consent::$allow) return $this->template = 'error_cookie_consent';
    return parent::_template($exception, $method, $code);
  }
}
