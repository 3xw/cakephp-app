<?php
use Cake\I18n\I18n;
?>
<!DOCTYPE html>
<html lang="<?= substr(I18n::getLocale(), 0, 2) ?>">
<head>
  <?= $this->Html->charset() ?>

  <title><?= (!empty($title))? $title.' - ' : '' ?> client</title>

  <meta name="viewport"                 content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="xxx" />
  <meta name="author"                   content="<?= (!empty($author))? $author : 'client' ?>">
  <meta name="description"              content="<?= (!empty($description))? $description : '' ?>">

  <meta property="fb:app_id"            content="xxx" />
  <meta property="og:type"              content="<?= ($this->request->getAttribute('params')['controller'] == 'Posts')? 'article' : 'website' ?>" />
  <meta property="og:url"               content="<?= $this->Url->build([], ['fullBase' => true]) ?>" />
  <meta property="og:title"             content="<?= (!empty($title))? $title.' - ' : '' ?>client" />
  <meta property="og:description"       content="<?= (!empty($description))? $description : '' ?>" />
  <meta property="og:image"             content="<?= (empty($image))? $this->Url->build('/', ['fullBase' => true]).'img/fb-bann.png' : $this->Attachment->fullPath($image) ?>" />


  <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= $this->Url->build('/', ['fullBase' => true]) ?>img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">

  <script type="text/javascript">
  (function (document, navigator, standalone) { if ((standalone in navigator) && navigator[standalone]) { var curnode, location = document.location, stop = /^(a|html)$/i; document.addEventListener('click', function (e) { curnode = e.target; while (!(stop).test(curnode.nodeName)) { curnode = curnode.parentNode; } if ('href' in curnode && (curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host))) { e.preventDefault(); location.href = curnode.href; } }, false); } })(document, window.navigator, 'standalone');
  </script>
  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>
  <?= $this->Html->css([
    'front/main.min.css?v='.md5_file(APP.'../webroot/css/front/main.min.css')])
  ?>
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
    'front/main.min.js?v='.md5_file(APP.'../webroot/js/front/main.min.js')])
  ?>
  <?= $this->fetch('script') ?>
</body>
</html>
