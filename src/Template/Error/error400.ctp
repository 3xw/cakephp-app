<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'default';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
if (extension_loaded('xdebug')) :
    xdebug_print_function_stack();
endif;

$this->end();
endif;
?>
<div class="container">
  <div class="row">
    <div class="col-6 mx-auto text-center">
      <div class="utils--spacer-double"></div>

      <h2><?= __d('cake', 'An Internal Error Has Occurred') ?></h2>

      <p class="error">
          <strong><?= __d('cake', 'Error') ?>: </strong>
          <?= empty($error->getMessage())? h($message): $error->getMessage() ?>
      </p>

      <div class="utils--spacer-double"></div>
    </div>
  </div>
</div>
