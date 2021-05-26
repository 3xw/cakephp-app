<!DOCTYPE html>
<html lang="<?= substr(\Cake\I18n\I18n::getLocale(), 0, 2) ?>">
<head>
  <?= $this->Html->charset() ?>
  <title><?= $this->fetch('title') ?></title>

  <!-- HEAD -->
  <?= $this->element('head/meta', ['googleId' => false, 'fbId' => false])?>
  <?= $this->element('head/icons',['folder' => 'img/favicon/'])?>
  <?= $this->element('head/standalone',['folder' => 'img/favicon/'])?>
  <?= $this->fetch('meta') ?>

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <?= $this->Html->css(['admin/main.min.css?v='.md5_file(APP.'../webroot/css/admin/main.min.css')])?>
  <?= $this->fetch('css') ?>

  <!-- COOKIE CONSENT -->
  <?= $this->element('cookies/consent',['googleTag' => false, 'fbPixel' => false])?>

</head>
<body itemscope itemtype="http://schema.org/WebPage">

  <div id="admin-app" data-webroot="<?= $this->request->getAttribute('webroot') ?>" class="page-wrap">
    <div class="row row-sidebar no-gutters g-0 <?= ($this->request->getParam('controller') == 'Attachments')? 'utils__sidebar--simple' : '' ?>">
      <div class="col-12 col-md-4 col-lg-3 col-xl-2">
        <?= $this->element('sidebar') ?>
      </div>
      <div class="col-12 col-md-8 col-lg-9 col-xl-10">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('auth') ?>
        <?= $this->element('header') ?>
        <?= $this->fetch('content') ?>
        <? // $this->element('footer') ?>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->
  <?= $this->fetch('template') ?>
  <?= $this->Html->script(['admin/common.min.js?v='.md5_file(APP.'../webroot/js/admin/common.min.js'),'admin/main.min.js?v='.md5_file(APP.'../webroot/js/admin/main.min.js')]) ?>
  <?= $this->fetch('script') ?>

</body>
</html>
