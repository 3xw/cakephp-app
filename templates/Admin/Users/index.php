<?php
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
*/
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">add</i> '.__('Add'),['action'=>'add'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <!-- LIST ELEMENT -->
    <div class="card">

      <div class="card-header">
        <h2 class="card-title">
          <?= __('Users')?> <small><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of
     {{count}} total, starting on record {{start}}, ending on {{end}}') ?></small>
        </h2>
        <?= $this->Form->create(null, ['novalidate', 'class'=>'', 'role'=>'search']) ?>
        <?= $this->Form->input('q', ['class'=>'form-control', 'placeholder'=>__('Search...'), 'label'=>false]) ?>
        <?= $this->Form->end() ?>
        <?php if (isset($q)): ?>
            Search value : <?= $this->Html->link($q.'<i class="material-icons">cancel</i>',['action'=>'index'], ['escape'=>false])?>
            <div class="utils--spacer-semi"></div>
        <?php endif; ?>
      </div>
      <!-- START CONTEMT -->
      <div class="card-body">
        <figure class="figure figure--table">
          <table id="datatables" class="table table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
            <thead class="thead-default">
              <tr>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hospital') ?></th>
                <th scope="col"><?= $this->Paginator->sort('service') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('upcoming_lessons') ?></th>
                <th scope="col"><?= $this->Paginator->sort('past_lessons') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active_users_licences',['label' => 'Active Licences']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('unactive_users_licences',['label' => 'Unactive Licences']) ?></th>
                <th scope="col">Niveau</th>
                <th scope="col"><?= $this->Paginator->sort('transactions') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user->created->format('d.m.y') ?></td>
                <td><?= ($user->name)? $user->name : $user->full_name ?></td>
                <td><?= h($user->hospital) ?></td>
                <td><?= h($user->service) ?></td>
                <td><?= h($user->country) ?></td>
                <td><?php switch ($user->role) {
                  case 'superuser':
                    echo "SU";
                    break;
                  case 'doctor':
                      echo "DR";
                      break;
                  case 'caregiver':
                      echo "CG";
                      break;
                } ?></td>

                <td>
                  <?= ($count = count($user->upcoming_lessons))? $this->Html->tag('span', $count, ['class' =>'badge badge-primary']): '' ?>
                </td>
                <td>
                  <?= ($count = count($user->past_lessons))? $this->Html->tag('span', $count, ['class' =>'badge badge-secondary']): '' ?>
                </td>
                <td>
                  <?= ($count = count($user->active_users_licences))? $this->Html->tag('span', $count, ['class' =>'badge badge-primary']): '' ?>
                </td>
                <td>
                  <?= ($count = count($user->unactive_users_licences))? $this->Html->tag('span', $count, ['class' =>'badge badge-secondary']): '' ?>
                </td>
                <td>
                  <? foreach($user->users_components as $uc) echo $this->Html->tag('span', strtoupper(substr($uc->component->name,0,1).$uc->level).' ('.substr($uc->module->name,0,2).')', ['class' =>'badge badge-info']); ?>
                </td>
                <td>
                  <?= ($count = count($user->transactions))? $this->Html->tag('span', $count, ['class' =>'badge badge-info']): '' ?>
                </td>
                <td data-title="actions" class="actions" class="text-right">
                  <div class="btn-group">
                    <?= $this->Html->link('<i class="material-icons">visibility</i>', ['action' => 'view', $user->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                    <?= $this->Html->link('<i class="material-icons">vpn_key</i>', ['action' => 'changeUserPassword', $user->id],['class' => 'btn btn-xs btn-warning btn-info btn-icon edit','escape' => false]) ?>
                    <?= $this->Html->link('<i class="material-icons">mode_edit</i>', ['action' => 'edit', $user->id], ['class' => 'btn btn-xs btn-simple btn-warning btn-icon edit','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="material-icons">delete</i>', ['action' => 'delete', $user->id], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?',  $user->id)]) ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </figure>
      </div>
      <!-- END CONTEMT -->
      <!-- START FOOTER -->
      <div class="card-footer">
        <div class="row no-gutters">
          <div class="col-6">
            <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of
     {{count}} total, starting on record {{start}}, ending on {{end}}') ?>
          </div>
          <div class="col-6">
          <nav aria-label="pagination">
            <ul class="pagination justify-content-end">
              <?= $this->Paginator->first('<< ' . __('first'),['class'=>'btn '])?>
              <?= $this->Paginator->prev('< ' . __('previous')) ?>
              <?= $this->Paginator->numbers() ?>
              <?= $this->Paginator->next(__('next') . ' >') ?>
              <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- END FOOTER -->
  </div><!-- end content-->
</div><!-- end card-->
</div><!-- end col-xs-12-->
