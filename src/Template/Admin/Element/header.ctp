<?php
$url = $this->Url->build([
  'controller' => 'Session',
  'action' => 'storeKeyValue',
  'prefix' => 'admin',
  'plugin' => false,
  '_ext' => 'json'
]);
?>
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <div class="navbar-minimize" data-url="<?= $url ?>">
      <button id="minimizeSidebar" class="btn btn-danger btn-fill btn-round btn-icon">
        <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
        <i class="fa fa-navicon visible-on-sidebar-mini"></i>
      </button>
    </div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?= $title ?></a>
    </div>
    <div class="collapse navbar-collapse">

      <?php if(isset($form) && $form): ?>
        <!-- use with https://github.com/FriendsOfCake/search#table-class -->
        <form class="navbar-form navbar-left navbar-search-form" role="search" action="<?= $this->request->here ?>" method="get">
          <div class="input-group" data-position="bottom" data-intro="Rechercher">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" name="q" value="<?= !empty($this->request->query['q'])? $this->request->query['q'] : '' ?>" class="form-control" placeholder="<?= __('Search...') ?>">
          </div>
        </form>
      <?php endif; ?>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <?= $this->Html->link('<i class="fa fa-home"></i><p>'.__('Home').'</p>',['prefix' => 'admin', 'plugin' => false, 'controller' => 'Dashboard', 'action' => 'index'],['escape' => false]) ?>
        </li>
        <?php
        if(isset($menus) && !empty($menus))
        {
          $menuCount = 0;
          foreach($menus as $title => $content )
          {
            $menuCount++;
            if(array_key_exists('dropdown', $content))
            {
              echo '<li class="dropdown">'."\n";
              echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$title.'</a>'."\n";
              echo '<ul class="dropdown-menu">'."\n";
              foreach($content['dropdown'] as $subMenuLabel => $subMenu)
              {
                echo $this->Html->tag('li',$this->Html->link($subMenuLabel, $subMenu, ['escape' => false]))."\n";
              }
              echo '</ul>'."\n";
              echo '</li>'."\n";
            }else
            {
              echo $this->Html->tag('li',$this->Html->link($title, $content, ['escape' => false]));
            }
          }
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
