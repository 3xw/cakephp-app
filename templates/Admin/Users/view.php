<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\User $user
*/
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">vpn_key</i> '.__('Change Password'), ['action' => 'changeUserPassword', $user->id],['class' => '','escape' => false]) ?>
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $user->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete',$user->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters g-0">
  <div class="col-8 mx-auto">
    <div class="card">

      <!-- CONTENT -->
      <div class="card-body">
        <h2><?= h($user->username) ?></h2>
        <label><?= __('Id') ?></label>
        <?= h($user->id) ?>
        <label><?= __('Email') ?></label>
        <?= h($user->email) ?>
        <label><?= __('First Name') ?></label>
        <?= h($user->first_name) ?>
        <label><?= __('Last Name') ?></label>
        <?= h($user->last_name) ?>
        <label><?= __('Role') ?></label>
        <?= h($user->role) ?>
      </div>
    </div>

  </div>
  <div class="col-3 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4><?= __('Informations')?></h4>
      </div>
      <!-- CONTENT -->
      <div class="card-body">
        <figure class="figure figure--table">
          <table class="table">
            <tbody>
              <tr>
                <th scope="row"><?= __('Active') ?></th>
                <td><?= $user->active ? __('Yes') : __('No'); ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Is Superuser') ?></th>
                <td><?= $user->is_superuser ? __('Yes') : __('No'); ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Attachment') ?></th>
                <td><?= $user->has('attachment') ? $this->Html->link($user->attachment->name, ['controller' => 'Attachments', 'action' => 'view', $user->attachment->id]) : '' ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Token Expires') ?></th>
                <td><?= h($user->token_expires) ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Activation Date') ?></th>
                <td><?= h($user->activation_date) ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Tos Date') ?></th>
                <td><?= h($user->tos_date) ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($user->created) ?></td>
              </tr>
              <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($user->modified) ?></td>
              </tr>
            </table>
          </figure>
        </div>
      </div>
    </div>
  </div>
  <div class="utils--spacer-default"></div>
  <?
  echo $this->element('Users/lessons',['active' => true, 'lessons' => $user->lessons]);
  echo $this->element('Users/user_licences',['active' => true, 'userLicences' => $user->active_users_licences]);
  echo $this->element('Users/user_licences',['active' => false, 'userLicences' => $user->unactive_users_licences]);
  echo $this->element('Users/transactions',['active' => false, 'transactions' => $user->transactions]);
  ?>
