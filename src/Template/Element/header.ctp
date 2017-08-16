<header>
  <div class="navbar <?= (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'funds')? 'navbar--blue' : '' ?>">
    <div class="navbar__header">
      <div class="navbar__background sumus-linear-gradient hidden"></div>
      <div class="navbar__toggle">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="navbar__logo">
        <a href="<?= $this->Url->build('/', true) ?>">
          <?= $this->Attachment->image(['image' => 'logo.png', 'profile' => 'img', 'width' => '254'], ['width' => '127']) ?>
        </a>
      </div>
      <div class="navbar__top-nav">
        <ul class="list-unstyled list-inline">
          <li>
            <a href="https://www.linkedin.com/company/wgr-communication" target="_blank">
              <i class="fa fa-linkedin fa-lg"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="navbar__nav hidden">
      <div class="navbar__nav-content hidden">
        <ul class="list-unstyled">
          <li><?= $this->Html->link('HOME', '/') ?></li>
        </ul>
      </div>
    </div>
  </div>
</header>
