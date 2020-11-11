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
<body>
  <div id="admin-app" data-webroot="<?= $this->request->getAttribute('webroot') ?>" class="page-wrap">
    <div class="row row-sidebar no-gutters <?= ($this->request->getParam('controller') == 'Attachments')? 'utils__sidebar--simple' : '' ?>">
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

  <!-- TEMPLATES -->
  <?= $this->fetch('template') ?>

  <!-- TOKEN -->
  <?php if($csrfToken = $this->getRequest()->getAttribute('csrfToken')): ?>
    <script type="text/javascript">
      window.csrfToken = '<?= $csrfToken ?>'
    </script>
  <?php endif; ?>

  <!-- SCRIPTS -->
  <?= $this->Html->script([
      'admin/common.min.js?v='.md5_file(APP.'../webroot/js/admin/common.min.js'),
      'admin/main.min.js?v='.md5_file(APP.'../webroot/js/admin/main.min.js')
  ]) ?>
  <?= $this->fetch('script') ?>
</body>
</html>
