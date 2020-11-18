<?php
use Cake\Core\Configure;
use Trois\Utils\Http\Middleware\CookieConsentMiddleware as Cookie;
if(Cookie::$exists && !Cookie::$allow)
{
  // php vars
  $cookieName = Configure::read('CookieConsent.cookieName');
  $host = $_SERVER['HTTP_HOST'];

  // js
  $script = "window.addEventListener('load', function(){\n";
  $script .= "\tdocument.cookie = \"$cookieName=;expires= Thu, 01 Jan 1970 00:00:00 GMT;path=/\"\n";
  $script .= "\tconsole.log('delete cookie')\n";
  $script .= "})\n";
  $this->Html->scriptBlock($script, ['block' => true]);
}
?>

<div class="utils--spacer-double"></div>
<div class="container">
  <div class="jumbotron">
  <h1 class="display-4">We are sorry, but you must allow our cookies to use this functionality</h1>
  <h1 class="display-4">🍪</h1>
  <p class="lead">Please follow the link bellow and consent to cookies.</p>
  <hr class="my-4">
  <p class="lead">
    <?= $this->Html->link('Go back to intro', '/', ['class' => 'btn btn-primary btn-lg']) ?>
  </p>
</div>
</div>
