<nav class="navbar navbar-expand">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Users') ?> <span class="badge badge-info"><?= $this->Paginator->counter('{{count}}')?></span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">add</i> '.__('Add'),['action'=>'add'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth') ?>

      <!-- CONTENT -->
      <div class="card">
        <!-- START CONTEMT -->
            <figure class="figure figure--table">
                <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead>
                    <tr>
                      <th><?= $this->Paginator->sort('last_name',['label' => 'Nom']) ?></th>
                      <th><?= $this->Paginator->sort('email') ?></th>
                      <th><?= $this->Paginator->sort('role') ?></th>
                      <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($users as $user): ?>
                      <tr>
                        <td data-title="last_name"><?= h($user->last_name).' '.h($user->first_name) ?></td>
                        <td data-title="email"><?= h($user->email) ?></td>
                        <td data-title="role"><?= h($user->role) ?></td>
                        <td data-title="actions" class="actions" class="text-right">
                          <?= $this->Html->link('<i class="material-icons">vpn_key</i>', ['action' => 'changeUserPassword', $user->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                          <?= $this->Html->link('<i class="material-icons">visibility</i>', ['action' => 'view', $user->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                          <?= $this->Html->link('<i class="material-icons">mode_edit</i>', ['action' => 'edit', $user->id], ['class' => 'btn btn-xs btn-simple btn-warning btn-icon edit','escape' => false]) ?>
                          <?= $this->Form->postLink('<i class="material-icons">delete</i>', ['action' => 'delete', $user->id], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                        </td>
                      </tr>

                    <?php endforeach; ?>
                  </tbody>
                </table>
              </figure>
              <div class="card-footer">
                <div class="row no-gutters">
                  <div class="col-6">
                    <?=
                    $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')])
                    ?>
                  </div>
                  <div class="col-6">
                    <nav aria-label="pagination">
                      <ul class="pagination justify-content-end">
                        <?= $this->Paginator->prev(__('Prev')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('Next')) ?>
                      </ul>
                    </nav>
                  </div>
                </div>

            </div>


          </div><!-- end dataTables_wrapper-->
        </div><!-- end fresh-datatables-->
      </div><!-- end content-->
    </div><!-- end card-->
  </div><!-- end col-xs-12-->
</div><!-- end row-->
