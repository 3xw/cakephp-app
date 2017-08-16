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
<?= $this->element('header',['title' => __('Index of <%= $pluralHumanName %>'),'form' => true, 'menus' => [ '<i class="fa fa-plus"></i><p>'.__('Add').'</p>' => ['action' => 'add']]]) ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">

        <!-- LIST ELEMENT -->
        <div class="card">

          <!-- HEADER -->
          <div class="header">
              <h4 class="title">List of <?= __('<%= $pluralHumanName %>') ?></h4>
              <p class="category">
                <?=
                $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')])
                ?>
            </p>
          </div>

          <!-- CONTENT -->
          <div class="content">
            <div class="fresh-datatables">
              <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <!-- TABLE -->
                <div class="row">
                  <div class="col-sm-12">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                      <thead>
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
                              <?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', <%= $pk %>],['class' => 'btn btn-simple btn-info btn-icon edit','escape' => false]) ?>
                              <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', <%= $pk %>], ['class' => 'btn btn-simple btn-warning btn-icon edit','escape' => false]) ?>
                              <?= $this->Form->postLink('<i class="fa fa-times"></i>', ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- PAGINATION -->
                <div class="row">
                  <div class="col-sm-5">
                    <div class="dataTables_info" id="datatables_info" role="status" aria-live="polite">
                      <?=
                      $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-7">
                    <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                      <ul class="pagination">
                        <?= $this->Paginator->prev(__('Prev')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('Next')) ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div><!-- end dataTables_wrapper-->
            </div><!-- end fresh-datatables-->
          </div><!-- end content-->
        </div><!-- end card-->
      </div><!-- end col-xs-12-->
    </div><!-- end row-->
  </div><!-- end container-fluid-->
</div><!-- end content-->
