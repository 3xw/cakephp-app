<?php
use Cake\Core\Configure;
$menu = Configure::read('Menus.'.$this->request->session()->read('Auth.User.role'));
?>
<!-- SIDEBAR -->
<div class="sidebar navbar-expand-md " >

  <!-- LOGO & LINK -->
  <div class="logo d-none d-md-block text-center">
    <?= $this->Html->link($this->Attachment->image(['image' => $this->Url->build('/', true).'img/admin/logo--sidebar.png', 'width' => '254'], ['class' => 'img-responsive', 'width' => '127']), ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin', 'plugin' => false], ['class' => 'logo-text', 'escape' => false]) ?>
  </div>
  <div class="logo logo-mini d-block d-md-none text-left">
    <?= $this->Html->link('WGR SA', ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin', 'plugin' => false], ['class' => 'logo-text']) ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <i class="material-icons">menu</i>
    </button>
  </div>
  <div class="utils--spacer-semi"></div>
  <div class="sidebar--collapse collapse navbar-collapse" id="sidebarCollapse">
    <hr>
    <div class="utils--spacer-semi"></div>

    <!-- USER -->
    <div class="sidebar__user text-center">
      <div class="sidebar__user-picture">
        <?php
        if(empty($this->request->session()->read('Auth.User.attachment')))
        {
          echo $this->Html->image(Configure::read('Users.Avatar.placeholder'),['class' =>'sidebar__avatar rounded-circle img-fluid']);
        }else{
          echo $this->Attachment->image([
            'image' => $this->request->session()->read('Auth.User.attachment.path'),
            'profile' => $this->request->session()->read('Auth.User.attachment.profile'),
            'width' => 678,
            'cropratio' => '1:1'
          ],['class' =>'sidebar__avatar rounded-circle img-fluid']);
        }
        ?>
      </div>
      <div class="utils--spacer-mini"></div>

      <div class="sidebar__user-menu">
        <a data-toggle="collapse" href="#collapseExample" class="collapsed" aria-expanded="false">
          <? if(empty($this->request->session()->read('Auth.User.first_name')) && empty($this->request->session()->read('Auth.User.last_name'))): ?>
            <?= $this->request->session()->read('Auth.User.email') ?>
          <? else: ?>
            <?= $this->request->session()->read('Auth.User.first_name').' '.$this->request->session()->read('Auth.User.last_name') ?>
          <? endif ?>
          <i class="material-icons">expand_more</i>
        </a>
        <div class="collapse" id="collapseExample" aria-expanded="false" style="height: 0px;">
          <ul>
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
    <div class="utils--spacer-semi"></div>
    <hr>
    <div class="utils--spacer-semi"></div>

    <!-- MENU -->
    <ul class="sidebar__menu">
      <?php
      $menuCount = 0;
      foreach($menu as $header => $m )
      {
        if(is_array($m) && array_key_exists('collapse', $m))
        {
          $menuCount++;
          $html = '<li>'."\n";
          $html .= '<a data-toggle="collapse" href="#menu-item-'.$menuCount.'" aria-expanded="false" aria-controls="menu-item-'.$menuCount.'">'.$header.'<i class="material-icons ml-auto">expand_more</i></a>'."\n";
          $html .= '<div class="collapse" id="menu-item-'.$menuCount.'">'."\n";

          // check active
          if(array_search($this->request->params['controller'], array_column($m['collapse'], 'controller')) !== false )
          {
            if( array_search($this->request->params['action'], array_column($m['collapse'], 'action')) !== false )
            {
              $in = $this->request->session()->read('Settings.css.sidebar-mini') == '' ? 'in' : '';
              $html = '<li class="active">'."\n";
              $html .= '<a data-toggle="collapse" href="#menu-item-'.$menuCount.'" aria-expanded="false" aria-controls="menu-item-'.$menuCount.'">'.$header.'<i class="material-icons ml-auto">expand_more</i></a>'."\n";
              $html .= '<div class="collapse '.$in.'" id="menu-item-'.$menuCount.'">'."\n";
            }
          }

          echo $html;
          echo '<ul>'."\n";
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
