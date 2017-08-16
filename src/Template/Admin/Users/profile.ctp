<?php use Cake\Core\Configure; ?>
<?= $this->element('header',['title' => __('My Profile')]) ?>

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-offset-3 col-md-6">

        <div class="card card-user">
          <div class="image">
            <img src="<?= $this->Url->build('/img/admin/bg.jpg') ?>" alt="...">
          </div>
          <div class="content">
            <div class="author">
              <?php
              if(empty($user->attachment))
              {
                echo $this->Html->image(Configure::read('Users.Avatar.placeholder'),['class' =>'avatar border-gray']);
              }else{
                echo $this->Attachment->image([
                  'image' => $user->attachment->path,
                  'profile' => $user->attachment->profile,
                  'width' => 678,
                  'cropratio' => '1:1'
                ],['class' =>'avatar border-gray']);
              }
              ?>

              <h4 class="title">
                <?= $this->request->session()->read('Auth.User.first_name').' '.$this->request->session()->read('Auth.User.last_name') ?>
                <br>
                <small>
                  <?= $this->request->session()->read('Auth.User.username') ?>
                </small>
              </h4>
            </div>
            <p class="description text-center">
              <?= $this->request->session()->read('Auth.User.email') ?>
            </p>

            <?php if (!empty($user->social_accounts)): ?>
              <hr>
              <h6 class="subheader"><?= __d('CakeDC/Users', 'Social Accounts') ?></h6>
              <table cellpadding="0" cellspacing="0">
                <thead>
                  <tr>
                    <th><?= __d('CakeDC/Users', 'Avatar'); ?></th>
                    <th><?= __d('CakeDC/Users', 'Provider'); ?></th>
                    <th><?= __d('CakeDC/Users', 'Link'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($user->social_accounts as $socialAccount):
                    $escapedUsername = h($socialAccount->username);
                    $linkText = empty($escapedUsername) ? __d('CakeDC/Users', 'Link to {0}', h($socialAccount->provider)) : h($socialAccount->username)
                    ?>
                    <tr>
                      <td><?=
                        $this->Html->image(
                        $socialAccount->avatar,
                        ['width' => '90', 'height' => '90']
                        ) ?>
                      </td>
                      <td><?= h($socialAccount->provider) ?></td>
                      <td><?=
                      $this->Html->link(
                      $linkText,
                      $socialAccount->link,
                      ['target' => '_blank']
                      ) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
            <hr/>
            <div class="text-center" style="margin-top: 20px;">
              <div class="btn-group">
                <?= $this->Html->link(__('Edit profile'), ['controller' => 'Users', 'action' => 'editByUser', $this->request->session()->read('Auth.User.id')],['class' =>'btn btn-sm btn-info btn-fill']); ?>
                <?= $this->Html->link(__d('CakeDC/Users', 'Change Password'), ['controller' => 'Users', 'action' => 'changePassword'],['class' =>'btn btn-sm btn-info btn-fill']); ?>
              </div>
            </div>

          </div>
        </div>

      </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
  </div>
</div>
