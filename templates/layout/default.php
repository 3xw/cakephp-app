<!DOCTYPE html>
<html lang="<?= substr(\Cake\I18n\I18n::getLocale(), 0, 2) ?>">
<head>
  <?= $this->Html->charset() ?>

  <!-- HEAD -->
  <?= $this->element('head/meta', ['googleId' => false, 'fbId' => false])?>
  <?= $this->element('head/icons',['folder' => 'img/favicon/'])?>
  <?= $this->element('head/standalone',['folder' => 'img/favicon/'])?>
  <?= $this->fetch('meta') ?>

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <?= $this->Html->css(['front/vendors.min.css?v='.md5_file(APP.'../webroot/css/front/vendors.min.css'), 'front/main.min.css?v='.md5_file(APP.'../webroot/css/front/main.min.css')])?>
  <?= $this->fetch('css') ?>

  <!-- COOKIE CONSENT -->
  <?= $this->element('cookies/consent',[
    'cookie' => [
      'tracking' => ['google' => false, 'facbook' => false]
    ]
  ])?>

</head>
<body itemscope itemtype="http://schema.org/WebPage">

  <!-- SITE -->
  <div id="front-app" class="page-wrap">
    <?= $this->element('header')?>
    <div class="container alert-container"><?= $this->Flash->render() ?></div>
    <?= $this->fetch('content') ?>
  </div>
  <?= $this->element('footer')?>

  <!-- SCRIPTS -->
  <?= $this->fetch('template') ?>
  <?= $this->Html->script([
    'front/vendors.min.js?v='.md5_file(APP.'../webroot/js/front/vendors.min.js'),
    'front/main.min.js?v='.md5_file(APP.'../webroot/js/front/main.min.js')
    ])?>
  <?= $this->fetch('script') ?>

</body>
</html>
