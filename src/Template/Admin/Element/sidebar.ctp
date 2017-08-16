<?php
use Cake\Core\Configure;

$menu = Configure::read('Menus.'.$this->request->session()->read('Auth.User.role'));
?>
<!-- SIDEBAR -->
<div class="sidebar" data-color="">
  <!-- Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" Tip 2: you can also add an image using data-image tag -->

  <!-- LOGO & LINK -->
  <div class="logo">
    <?= $this->Html->link($this->Attachment->image(['image' => $this->Url->build('/', true).'img/admin/logo--sidebar.png', 'width' => '254'], ['class' => 'img-responsive', 'width' => '127']), ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin', 'plugin' => false], ['class' => 'logo-text', 'escape' => false]) ?>
  </div>
  <div class="logo logo-mini">
    <?= $this->Html->link('WGR SA', ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin', 'plugin' => false], ['class' => 'logo-text']) ?>
  </div>

  <!-- MENU -->
  <div class="sidebar-wrapper">

    <!-- USER -->
    <div class="user">
      <div class="photo">
        <?php
        if(empty($this->request->session()->read('Auth.User.attachment')))
        {
          echo $this->Html->image(Configure::read('Users.Avatar.placeholder'),['class' =>'avatar border-gray']);
        }else{
          echo $this->Attachment->image([
            'image' => $this->request->session()->read('Auth.User.attachment.path'),
            'profile' => $this->request->session()->read('Auth.User.attachment.profile'),
            'width' => 678,
            'cropratio' => '1:1'
          ],['class' =>'avatar border-gray']);
        }
        ?>
      </div>
      <div class="info">
        <a data-toggle="collapse" href="#collapseExample" class="collapsed" aria-expanded="false">
          <?= $this->request->session()->read('Auth.User.first_name').' '.$this->request->session()->read('Auth.User.last_name') ?>
          <b class="caret"></b>
        </a>
        <div class="collapse" id="collapseExample" aria-expanded="false" style="height: 0px;">
          <ul class="nav">
            <li>
              <?= $this->Html->link(__('My Profile'), Configure::read('Users.Profile.route')); ?>
            </li>
            <li>
              <?= $this->html->link(__('Edit Profile'), ['controller' => 'Users', 'action' => 'editByUser', $this->request->session()->read('Auth.User.id')]) ?>
            </li>
            <li>
              <?= $this->Html->link(__('Logout'),['controller' => 'Users', 'action' => 'logout','prefix' => false, 'plugin' => 'CakeDC/Users'] ) ?>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- MENU LIST -->
    <ul class="nav">
      <?php
      $menuCount = 0;
      foreach($menu as $header => $m )
      {
        if(is_array($m) && array_key_exists('collapse', $m))
        {
          $menuCount++;
          $html = '<li>'."\n";
          $html .= '<a data-toggle="collapse" href="#menu-item-'.$menuCount.'" aria-expanded="false">'.$header.'</a>'."\n";
          $html .= '<div class="collapse" id="menu-item-'.$menuCount.'" aria-expanded="false">'."\n";

          // check active
          if(array_search($this->request->params['controller'], array_column($m['collapse'], 'controller')) !== false )
          {
            if( array_search($this->request->params['action'], array_column($m['collapse'], 'action')) !== false )
            {
              $in = $this->request->session()->read('Settings.css.sidebar-mini') == '' ? 'in' : '';
              $html = '<li class="active">'."\n";
              $html .= '<a data-toggle="collapse" href="#menu-item-'.$menuCount.'" aria-expanded="true">'.$header.'</a>'."\n";
              $html .= '<div class="collapse '.$in.'" id="menu-item-'.$menuCount.'" aria-expanded="true">'."\n";
            }
          }

          echo $html;
          echo '<ul class="nav">'."\n";
          foreach($m['collapse'] as $subMenuLabel => $subMenu)
          {
            $active = (!empty($subMenu['controller']))? (
              $this->request->params['controller'] == $subMenu['controller'] &&
              $this->request->params['action'] == $subMenu['action']
            )? 'active' : '' : '';
            echo $this->Html->tag('li',$this->Html->link($subMenuLabel, $subMenu, ['escape' => false]),['class' => $active]);
          }
          echo '</ul>'."\n";
          echo '</div>'."\n";
          echo '</li>'."\n";
        }else
        {
          $active = (!empty($m['controller']))? (
            $this->request->params['controller'] == $m['controller'] &&
            $this->request->params['action'] == $m['action']
          )? 'active' : '' : '';
          echo $this->Html->tag('li',$this->Html->link($header, $m, ['escape' => false]),['class' => $active]);
        }
      }
      ?>

    </ul>
  </div>
</div>
