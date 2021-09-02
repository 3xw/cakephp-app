<? use Cake\Core\Configure; ?>
<header class="d-flex flex-row justify-content-between align-items-center">
  <div class="logo d-none d-md-block">
    <?= $this->Html->link($this->Attachment->image(['image' => $this->Url->build('/', ['fullBase' => true]).'img/admin/logo--sidebar.png', 'width' => '254'], ['class' => 'img-responsive', 'width' => '127']), ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'Admin', 'plugin' => false], ['class' => 'logo-text', 'escape' => false]) ?>
  </div>
  <div class="sidebar__user-menu">
    <a data-bs-toggle="collapse" href="#collapseExample" class="collapsed" aria-expanded="false">
      <? if(empty($this->request->getSession()->read('Auth.first_name')) && empty($this->request->getSession()->read('Auth.last_name'))): ?>
        <?= $this->request->getSession()->read('Auth.email') ?>
      <? else: ?>
        <?= $this->request->getSession()->read('Auth.first_name').' '.$this->request->getSession()->read('Auth.last_name') ?>
      <? endif ?>
      <i class="material-icons">expand_more</i>
    </a>
    <div class="collapse" id="collapseExample" aria-expanded="false" style="height: 0px;">
      <ul>
        <li>
          <?= $this->Html->link(__('My Profile'), Configure::read('Users.Profile.route')); ?>
        </li>
        <li>
          <?= $this->html->link(__('Edit Profile'), ['controller' => 'Users', 'action' => 'editByUser', $this->request->getSession()->read('Auth.id')]) ?>
        </li>
        <li>
          <?= $this->Html->link(__('Logout'),['controller' => 'Users', 'action' => 'logout', 'prefix' => 'Admin', 'plugin' => false] ) ?>
        </li>
      </ul>
    </div>
  </div>
</header>
