<?php
use Cake\Core\Configure;
use Trois\Utils\Http\Middleware\CookieConsentMiddleware as Cookie;
if(Cookie::$exists && !Cookie::$allow)
{
  /* not working */
  $cookieName = Configure::read('CookieConsent.cookieName');
  $script = "document.cookie = '$cookieName' + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';";
  $this->Html->scriptBlock($script, ['block' => true]);
}
?>

<div class="utils--spacer-double"></div>
<div class="container">
  <div class="jumbotron">
  <h1 class="display-4">We are sorry, but you must allow our cookies to use this functionality</h1>
  <h1 class="display-4">🍪</h1>
  <p class="lead">First allow cokies, and then click on the button below.</p>
  <hr class="my-4">
  <p class="lead">
    <?= $this->Html->link('Go back', '/', ['class' => 'btn btn-primary btn-lg']) ?>
  </p>
</div>
</div>
