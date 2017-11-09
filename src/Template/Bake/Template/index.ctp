<%
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.1.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
  return !in_array($schema->columnType($field), ['binary', 'text']);
})
->take(7);
%>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('<%= $pluralHumanName %>') ?> <span class="badge badge-info"><?= $this->Paginator->counter('{{count}}')?></span>
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
    <!-- LIST ELEMENT -->
    <div class="card">
      <!-- START CONTEMT -->
      <div class="card-body">
        <?= $this->Form->create('Search', ['novalidate', 'class'=>'', 'role'=>'search']) ?>
        <?= $this->Form->input('q', ['class'=>'form-control', 'placeholder'=>__('Search...'), 'label'=>false]) ?>
        <?= $this->Form->end() ?>
        <figure class="figure figure--table">

        <table id="datatables" class="table table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
          <thead class="thead-default">
            <tr>
              <% foreach ($fields as $field): %>
              <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
              <% endforeach; %>
              <th class="actions"><?= __('Actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
              <tr>
                <% foreach ($fields as $field) {
                  $isKey = false;
                  if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                      if ($field === $details['foreignKey']) {
                        $isKey = true;
                        %>
                        <td data-title="<%= Inflector::humanize($field) %>"><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
                        <%
                        break;
                      }
                    }
                  }
                  if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                      %>
                      <td data-title="<%= $field %>"><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                      <%
                    } else {
                      %>
                      <td data-title="<%= $field %>"><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                      <%
                    }
                  }
                }
                $pk = '$' . $singularVar . '->' . $primaryKey[0];
                %>
                <td data-title="actions" class="actions" class="text-right">
                  <div class="btn-group">
                    <?= $this->Html->link('<i class="material-icons">visibility</i>', ['action' => 'view', <%= $pk %>],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                    <?= $this->Html->link('<i class="material-icons">mode_edit</i>', ['action' => 'edit', <%= $pk %>], ['class' => 'btn btn-xs btn-simple btn-warning btn-icon edit','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="material-icons">delete</i>', ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
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
      <!-- END FOOTER -->
    </div><!-- end content-->
  </div><!-- end card-->
</div><!-- end col-xs-12-->
