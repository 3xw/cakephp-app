<?php
use Cake\Core\Configure;
Configure::load('menus','default',true);
$menu = Configure::read('Menus.'.$this->request->getSession()->read('Auth.role'));
?>
<!-- SIDEBAR -->

<div class="sidebar navbar-expand-md">
  <div class="logo logo-mini d-block d-md-none text-left">
    <?= $this->Html->link('WGR SA', ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin', 'plugin' => false], ['class' => 'logo-text']) ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <i class="material-icons">menu</i>
    </button>
  </div>


  <div class="sidebar--collapse collapse navbar-collapse" id="sidebarCollapse">
      <div class="d-none d-md-block sidebar__toggler <?= ($this->request->getParam('controller') != 'Attachments')? 'actived' : '' ?>">
        <div></div>
        <div></div>
        <div></div>
      </div>

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
          if(array_search($this->request->getParam('controller'), array_column($m['collapse'], 'controller')) !== false )
          {
            if( array_search($this->request->getParam('action'), array_column($m['collapse'], 'action')) !== false )
            {
              $in = $this->request->getSession()->read('Settings.css.sidebar-mini') == '' ? 'in' : '';
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
              $this->request->getParam('controller') == $subMenu['controller'] &&
              $this->request->getParam('action') == $subMenu['action']
            )? 'active' : '' : '';
            echo $this->Html->tag('li',$this->Html->link($subMenuLabel, $subMenu, ['escape' => false]),['class' => $active]);
          }
          echo '</ul>'."\n";
          echo '</div>'."\n";
          echo '</li>'."\n";
        }else
        {
          $active = (!empty($m['controller']))? (
            $this->request->getParam('controller') == $m['controller'] &&
            $this->request->getParam('action') == $m['action']
          )? 'active' : '' : '';
          echo $this->Html->tag('li',$this->Html->link($header, $m, ['escape' => false]),['class' => $active]);
        }
      }
      ?>

    </ul>
  </div>

</div>
