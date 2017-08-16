<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.10.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/

?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>

  <title><?= (!empty($title))? $title.' - ' : '' ?> client</title>

  <meta name="viewport"                 content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="xxx" />
  <meta name="author"                   content="<?= (!empty($author))? $author : 'client' ?>">
  <meta name="description"              content="<?= (!empty($description))? $description : '' ?>">

  <meta property="fb:app_id"            content="xxx" />
  <meta property="og:type"              content="<?= ($this->request->params['controller'] == 'Posts')? 'article' : 'website' ?>" />
  <meta property="og:url"               content="<?= $this->Url->build([], true) ?>" />
  <meta property="og:title"             content="<?= (!empty($title))? $title.' - ' : '' ?>client" />
  <meta property="og:description"       content="<?= (!empty($description))? $description : '' ?>" />
  <meta property="og:image"             content="<?= (empty($image))? $this->Url->build('/', true).'img/fb-bann.png' : $this->Attachment->fullPath($image) ?>" />


  <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->Url->build('/', true) ?>img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= $this->Url->build('/', true) ?>img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->Url->build('/', true) ?>img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= $this->Url->build('/', true) ?>img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->Url->build('/', true) ?>img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= $this->Url->build('/', true) ?>img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= $this->Url->build('/', true) ?>img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">

  <script type="text/javascript">
  (function (document, navigator, standalone) { if ((standalone in navigator) && navigator[standalone]) { var curnode, location = document.location, stop = /^(a|html)$/i; document.addEventListener('click', function (e) { curnode = e.target; while (!(stop).test(curnode.nodeName)) { curnode = curnode.parentNode; } if ('href' in curnode && (curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host))) { e.preventDefault(); location.href = curnode.href; } }, false); } })(document, window.navigator, 'standalone');
  </script>
  <?= $this->Html->meta('icon') ?>

  <?= $this->Html->css(['front/vendor.min.css?v='.md5_file(APP.'../webroot/css/front/vendor.min.css'), 'front/front.min.css?v='.md5_file(APP.'../webroot/css/front/front.min.css')]) ?>
  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">
  <div id="front-app" class="page-wrap <?= (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'funds')? 'funds' : '' ?>">
    <?= $this->element('header')?>
    <div class="container alert-container">
      <?= $this->Flash->render() ?>
    </div>
    <?= $this->fetch('content') ?>
  </div>
  <?= $this->element('footer')?>

  <!-- TEMPLATES -->
  <?= $this->fetch('template') ?>

  <?= $this->Html->script([
    'front/vendor.min.js?v='.md5_file(APP.'../webroot/js/front/vendor.min.js'),
    'front/app.min.js?v='.md5_file(APP.'../webroot/js/front/app.min.js'),
  ]) ?>
  <?= $this->fetch('script') ?>
</body>
</html>
