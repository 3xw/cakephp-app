<?php use Cake\Core\Configure; ?>

<?= $this->element('header',['title' => __('View'),'menus' => [
  '<i class="fa fa-list"></i><p>'.__('List').'</p>' => ['action' => 'index'],
  '<i class="fa fa-plus"></i><p>'.__('Add').'</p>' => ['action' => 'add'],
  '<i class="fa fa-edit"></i><p>'.__('Edit').'</p>' => ['action' => 'edit', $user->id],
  ]]) ?>

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
                <?= $user->first_name.' '.$user->last_name ?>
                <br>
                <small>
                  <?= $user->username ?>
                </small>
              </h4>
            </div>
            <p class="description text-center">
              <?= $user->email ?>
            </p>
            <hr/>
            <div class="text-center" style="margin-top: 20px;">
              <div class="btn-group">
                <?= $this->Html->link(__('Edit profile'), ['controller' => 'Users', 'action' => 'edit', $user->id],['class' =>'btn btn-sm btn-info btn-fill']); ?>
                <?= $this->Html->link(__d('CakeDC/Users', 'Change Password'), ['controller' => 'Users', 'action' => 'changeUserPassword', $user->id],['class' =>'btn btn-sm btn-info btn-fill']); ?>
              </div>
            </div>
          </div>
        </div><!-- profile -->

      </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
  </div> <!-- end container-fluid -->
</div> <!-- end content -->
