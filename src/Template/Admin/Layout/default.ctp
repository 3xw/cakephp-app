<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title><?= $this->fetch('title') ?></title>
  <?= $this->Html->meta('icon') ?>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  <?= $this->Html->css([
    'admin/bootstrap.min.css','admin/light-bootstrap-dashboard.css',
    'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
    'https://fonts.googleapis.com/css?family=Roboto:400,700,300',
    'admin/chardinjs.css',
    'admin/pe-icon-7-stroke.css',
    'admin/admin.css'
  ])
  ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>

</head>
<body class="<?= $this->request->session()->read('Settings.css.sidebar-mini'); ?>">

  <div id="admin-app" class="wrapper">

    <!-- SIDEBAR -->
    <?= $this->element('sidebar') ?>

    <!-- MAIN -->
    <div class="main-panel">

      <!--FALSH -->
      <?= $this->Flash->render() ?>
      <?= $this->Flash->render('auth') ?>

      <!-- CONTENT -->
      <?= $this->fetch('content') ?>

      <!-- FOOTER -->
      <?= $this->element('footer') ?>

    </div>
  </div>

  <!-- TEMPLATES -->
  <?= $this->fetch('template') ?>

  <!-- SCRIPTS -->
  <?= $this->Html->script([
    'admin/jquery.min.js','admin/jquery-ui.min.js','admin/bootstrap.min.js',
    'admin/light-bootstrap-dashboard.js','admin/bootstrap-notify.js',
    'admin/chardinjs.js',
    'admin/bootstrap-selectpicker',
    'admin/vue.js','admin/vue-resource.min.js',
    'admin/admin.js'
  ])
  ?>
  <?= $this->fetch('script') ?>
</body>
</html>
