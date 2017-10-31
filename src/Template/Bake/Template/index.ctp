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
<div class="row">
  <div class="col">
    <!-- LIST ELEMENT -->
    <div class="card">
      <!-- START HEADER -->
      <div class="card-header">
        <div class="row">
          <div class="col-4">
            <h4 class="card-title"><?= __('<%= $pluralHumanName %>') ?> <span class="badge badge-info"><?= $this->Paginator->counter('{{count}}')?></span></h4>
          </div>
          <div class="col-8">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Add'),['action'=>'add'], ['class' => 'btn   btn-simple btn-info btn-icon add','escape'=>false]) ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- END HEADER -->
      <!-- START CONTEMT -->
      <div class="card-body">
        <?= $this->Form->create('Search', ['novalidate', 'class'=>'', 'role'=>'search']) ?>
        <?= $this->Form->input('q', ['class'=>'form-control', 'placeholder'=>__('Search...'), 'label'=>false]) ?>
        <?= $this->Form->end() ?>
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
                    <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', <%= $pk %>],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', <%= $pk %>], ['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-times"></i>', ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- END CONTEMT -->
      <!-- START FOOTER -->
      <div class="card-footer">
        <div class="row">
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
