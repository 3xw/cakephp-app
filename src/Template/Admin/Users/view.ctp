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
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $user->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete',$user->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-8 mx-auto">
    <div class="card">
      <!-- pic -->
      <?php if ($user->attachment): ?>
        <?php if ($user->attachment->type == 'image'): ?>
          <?= $this->Attachment->image(['image' => $user->attachment->path, 'profile' => $user->attachment->profile, 'width' => '1200px',  'cropratio' => '16:8'], ['class' => 'card-img-top']) ?>
        <?php endif; ?>
      <?php endif; ?>
      <!-- CONTENT -->
      <div class="card-body">
        <h2><?= h($user->username) ?></h2>
        <label><?= __('Id') ?></label>
        <?= h($user->id) ?>
        <label><?= __('Email') ?></label>
        <?= h($user->email) ?>
        <label><?= __('Password') ?></label>
        <?= h($user->password) ?>
        <label><?= __('First Name') ?></label>
        <?= h($user->first_name) ?>
        <label><?= __('Last Name') ?></label>
        <?= h($user->last_name) ?>
        <label><?= __('Token') ?></label>
        <?= h($user->token) ?>
        <label><?= __('Api Token') ?></label>
        <?= h($user->api_token) ?>
        <label><?= __('Role') ?></label>
        <?= h($user->role) ?>

      </div>
    </div>
    <?php if (!empty($user->social_accounts)): ?>
      <div class="card  mt-4">
        <div class="card-header">
          <h4 class="card-title"><?= __('Related Social Accounts')?></h4>
        </div>
        <div class="card-body">
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                  <th scope="col"><?= __('Id') ?></th>
                  <th scope="col"><?= __('User Id') ?></th>
                  <th scope="col"><?= __('Provider') ?></th>
                  <th scope="col"><?= __('Username') ?></th>
                  <th scope="col"><?= __('Reference') ?></th>
                  <th scope="col"><?= __('Avatar') ?></th>
                  <th scope="col"><?= __('Description') ?></th>
                  <th scope="col"><?= __('Link') ?></th>
                  <th scope="col"><?= __('Token') ?></th>
                  <th scope="col"><?= __('Token Secret') ?></th>
                  <th scope="col"><?= __('Active') ?></th>
                  <th scope="col"><?= __('Data') ?></th>
                  <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user->social_accounts as $socialAccounts): ?>
                  <tr>
                    <td><?= h($socialAccounts->id) ?></td>
                    <td><?= h($socialAccounts->user_id) ?></td>
                    <td><?= h($socialAccounts->provider) ?></td>
                    <td><?= h($socialAccounts->username) ?></td>
                    <td><?= h($socialAccounts->reference) ?></td>
                    <td><?= h($socialAccounts->avatar) ?></td>
                    <td><?= h($socialAccounts->description) ?></td>
                    <td><?= h($socialAccounts->link) ?></td>
                    <td><?= h($socialAccounts->token) ?></td>
                    <td><?= h($socialAccounts->token_secret) ?></td>
                    <td><?= h($socialAccounts->active) ?></td>
                    <td><?= h($socialAccounts->data) ?></td>
                    <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link(__('View'), ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccounts->id]) ?>
                      </td>
                    </div>
                  </tr >
                <?php endforeach; ?>
              </tbody>
            </table>
          </figure>
        </div>
      </div>
    <?php endif; ?>
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
