<?
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
?>
<?= $this->element('header',['title' => 'Dashboard','form' => false]) ?>

<data class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- hello -->
      <div class="col-md-12">
        <div class="card">
          <!-- HEADER -->
          <div class="header">
            <h4>Settings</h4>
          </div>
          <!-- CONTENT -->
          <div class="content">

            <div class="row">
              <div class="col-md-6">
                  <h4>Environment</h4>
                  <ul>
                  <?php if (version_compare(PHP_VERSION, '5.6.0', '>=')) : ?>
                      <li class="alert alert-success">Your version of PHP is 5.6.0 or higher (detected <?= PHP_VERSION ?>).</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your version of PHP is too low. You need PHP 5.6.0 or higher to use CakePHP (detected <?= PHP_VERSION ?>).</li>
                  <?php endif; ?>

                  <?php if (extension_loaded('mbstring')) : ?>
                      <li class="alert alert-success">Your version of PHP has the mbstring extension loaded.</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your version of PHP does NOT have the mbstring extension loaded.</li>;
                  <?php endif; ?>

                  <?php if (extension_loaded('openssl')) : ?>
                      <li class="alert alert-success">Your version of PHP has the openssl extension loaded.</li>
                  <?php elseif (extension_loaded('mcrypt')) : ?>
                      <li class="alert alert-success">Your version of PHP has the mcrypt extension loaded.</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
                  <?php endif; ?>

                  <?php if (extension_loaded('intl')) : ?>
                      <li class="alert alert-success">Your version of PHP has the intl extension loaded.</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your version of PHP does NOT have the intl extension loaded.</li>
                  <?php endif; ?>
                  </ul>
              </div>
              <div class="col-md-6">
                  <h4>Filesystem</h4>
                  <ul>
                  <?php if (is_writable(TMP)) : ?>
                      <li class="alert alert-success">Your tmp directory is writable.</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your tmp directory is NOT writable.</li>
                  <?php endif; ?>

                  <?php if (is_writable(LOGS)) : ?>
                      <li class="alert alert-success">Your logs directory is writable.</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your logs directory is NOT writable.</li>
                  <?php endif; ?>

                  <?php $settings = Cache::getConfig('_cake_core_'); ?>
                  <?php if (!empty($settings)) : ?>
                      <li class="alert alert-success">The <em><?= $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
                  <?php else : ?>
                      <li class="alert alert-warning">Your cache is NOT working. Please check the settings in config/app.php</li>
                  <?php endif; ?>
                  </ul>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-6">
                  <h4>Database</h4>
                  <?php
                  try {
                      $connection = ConnectionManager::get('default');
                      $connected = $connection->connect();
                  } catch (Exception $connectionError) {
                      $connected = false;
                      $errorMsg = $connectionError->getMessage();
                      if (method_exists($connectionError, 'getAttributes')) :
                          $attributes = $connectionError->getAttributes();
                          if (isset($errorMsg['message'])) :
                              $errorMsg .= '<br />' . $attributes['message'];
                          endif;
                      endif;
                  }
                  ?>
                  <ul>
                  <?php if ($connected) : ?>
                      <li class="alert alert-success">CakePHP is able to connect to the database.</li>
                  <?php else : ?>
                      <li class="bullet problem">CakePHP is NOT able to connect to the database.<br /><?= $errorMsg ?></li>
                  <?php endif; ?>
                  </ul>
              </div>
              <div class="col-md-6">
                  <h4>DebugKit</h4>
                  <ul>
                  <?php if (Plugin::loaded('DebugKit')) : ?>
                      <li class="alert alert-success">DebugKit is loaded.</li>
                  <?php else : ?>
                      <li class="bullet problem">DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</li>
                  <?php endif; ?>
                  </ul>
              </div>

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</data>
