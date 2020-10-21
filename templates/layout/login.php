<!DOCTYPE html>
<html>
<head>

  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= $this->fetch('title') ?></title>

  <?= $this->Html->meta('icon') ?>

  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <?= $this->Html->css([
    'admin/main.min.css?v='.md5_file(APP.'../webroot/css/admin/main.min.css')])
  ?>
  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
</head>
<body class="login">

    <div id="admin-app" data-webroot="<?= $this->request->getAttribute('webroot') ?>" class="page-wrap">
      <div class="row no-gutters">
        <div class="col-12 col-md-8 col-lg-9 col-xl-10 mx-auto">
          <?= $this->Flash->render() ?>
          <?= $this->Flash->render('auth') ?>
          <?= $this->fetch('content') ?>
          <?= $this->element('footer') ?>
        </div>
      </div>
    </div>
    <?= $this->fetch('template') ?>
    <?= $this->Html->script([
      'admin/common.min.js?v='.md5_file(APP.'../webroot/js/admin/common.min.js'),
      'admin/main.min.js?v='.md5_file(APP.'../webroot/js/admin/main.min.js')
      ]) ?>
    <?= $this->fetch('script') ?>
  </body>
  </html>
