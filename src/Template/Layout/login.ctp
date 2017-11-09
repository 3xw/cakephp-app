<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta property="fb:app_id" content="302184056577324" />

  <?
  if($this->request->params['action'] == 'login'){
    $title = __('Login');
    $description = __('Access to admin console');
  }else{
    $title = __('Password recover');
    $description = __('Recover your password');
  }
  ?>

  <title>
    <?= $title ?> - client
  </title>
  <meta name="description" content="<?= $description ?>"/>
  <meta name='url' content='<?= $this->Url->build([], true) ?>'>

  <meta property="og:url" content="<?= $this->Url->build([], true) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="client">
  <meta property="og:title" content="<?= $title ?> - client" />
  <meta property="og:description" content="<?= $description ?>" />

  <? if(!empty($image)): ?>
    <meta property="og:image" content="<?= $this->Attachment->fullPath($image) ?>" />
  <? endif ?>

  <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->request->webroot ?>img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->request->webroot ?>img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->request->webroot ?>img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->request->webroot ?>img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->request->webroot ?>img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= $this->request->webroot ?>img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= $this->request->webroot ?>img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->request->webroot ?>img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->request->webroot ?>img/favicon/apple-icon-180x180.png">
  <meta name="apple-mobile-web-app-title" content="Lausanne Musées">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= $this->request->webroot ?>img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->request->webroot ?>img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= $this->request->webroot ?>img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->request->webroot ?>img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= $this->request->webroot ?>img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= $this->request->webroot ?>img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <script type="text/javascript">
    (function (document, navigator, standalone) { if ((standalone in navigator) && navigator[standalone]) { var curnode, location = document.location, stop = /^(a|html)$/i; document.addEventListener('click', function (e) { curnode = e.target; while (!(stop).test(curnode.nodeName)) { curnode = curnode.parentNode; } if ('href' in curnode && (curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host))) { e.preventDefault(); location.href = curnode.href; } }, false); } })(document, window.navigator, 'standalone');
  </script>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <?= $this->Html->css([
    'admin/vendor.min.css?v='.md5_file(APP.'../webroot/css/admin/vendor.min.css'),
    'admin/admin.min.css?v='.md5_file(APP.'../webroot/css/admin/admin.min.css')
  ]);
  ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>

</head>
<body class="login">

  <!-- CONTENT -->
  <?= $this->fetch('content') ?>

  <!-- SCRIPTS -->
  <?= $this->Html->script([
    'admin/vendor.min.js?v='.md5_file(APP.'../webroot/js/admin/vendor.min.js'),
    'admin/app.min.js?v='.md5_file(APP.'../webroot/js/admin/app.min.js')
  ])
  ?>
  <?= $this->fetch('script') ?>
  <script type="text/javascript">
  $().ready(function(){
    lbd.checkFullPageBackgroundImage();

    setTimeout(function(){
      // after 1000 ms we add the class animated to the login/register card
      $('.card').removeClass('card-hidden');
    }, 700)
  });
  </script>
</body>
</html>
