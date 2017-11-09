<?php use Cake\Core\Configure; ?>
<nav class="navbar navbar-expand">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('User') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $user->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete', $user->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
        <div class="card text-center">


              <?php
              if(empty($user->attachment))
              {
                echo $this->Html->image(Configure::read('Users.Avatar.placeholder'),['class' =>'rounded-circle']);
              }else{
                echo $this->Attachment->image([
                  'image' => $user->attachment->path,
                  'profile' => $user->attachment->profile,
                  'width' => 678,
                  'cropratio' => '1:1'
                ],['class' =>'rounded-circle']);
              }
              ?>

              <h4 class="title">
                <?= $user->first_name.' '.$user->last_name ?>
                <br>
                <small>
                  <?= $user->username ?>
                </small>
              </h4>
            <p >
              <?= $user->email ?>
            </p>
            <div  >
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
