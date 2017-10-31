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

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
->map(function($field) use ($immediateAssociations) {
  foreach ($immediateAssociations as $alias => $details) {
    if ($field === $details['foreignKey']) {
      return [$field => $details];
    }
  }
})
->filter()
->reduce(function($fields, $value) {
  return $fields + $value;
}, []);

$groupedFields = collection($fields)
->filter(function($field) use ($schema) {
  return $schema->columnType($field) !== 'binary';
})
->groupBy(function($field) use ($schema, $associationFields) {
  $type = $schema->columnType($field);
  if (isset($associationFields[$field])) {
    return 'string';
  }
  if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
    return 'number';
  }
  if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
    return 'date';
  }
  return in_array($type, ['text', 'boolean']) ? $type : 'string';
})
->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<div class="row justify-content-md-center">
  <div class="col">

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-4">
            <h4 class="title"><?= __('<%= Inflector::humanize($singularVar) %>') ?></h4>
          </div>
          <div class="col-8">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <div class="btn-group">
                  <?= $this->Html->link(__('<i class="fa fa-edit"></i> '.__('Edit')), ['action' => 'edit', <%= $pk %>], ['class' => 'btn btn-simple btn-info btn-icon edit','escape'=>false]) ?>
                  <?= $this->Form->postLink(__('<i class="fa fa-trash-o"></i> '.__('Delete')), ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-simple btn-danger btn-icon edit','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- CONTENT -->
      <div class="card-body">
        <table class="table">
          <tbody>
            <% if ($groupedFields['string']) : %>
            <% foreach ($groupedFields['string'] as $field) : %>
            <% if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
            %>
            <tr>
              <th scope="row"><?= __('<%= Inflector::humanize($details['property']) %>') ?></th>
              <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
            </tr>
            <% else : %>
            <tr>
              <th scope="row"><?= __('<%= Inflector::humanize($field) %>') ?></th>
              <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
            </tr>
            <% endif; %>
            <% endforeach; %>
            <% endif; %>
            <% if ($associations['HasOne']) : %>
            <%- foreach ($associations['HasOne'] as $alias => $details) : %>
            <tr>
              <th scope="row"><?= __('<%= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) %>') ?></th>
              <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
            </tr>
            <%- endforeach; %>
            <% endif; %>
            <% if ($groupedFields['number']) : %>
            <% foreach ($groupedFields['number'] as $field) : %>
            <tr>
              <th scope="row"><?= __('<%= Inflector::humanize($field) %>') ?></th>
              <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
            </tr>
            <% endforeach; %>
            <% endif; %>
            <% if ($groupedFields['date']) : %>
            <% foreach ($groupedFields['date'] as $field) : %>
            <tr>
              <th scope="row"><%= "<%= __('" . Inflector::humanize($field) . "') %>" %></th>
              <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
            </tr>
            <% endforeach; %>
            <% endif; %>
            <% if ($groupedFields['boolean']) : %>
            <% foreach ($groupedFields['boolean'] as $field) : %>
            <tr>
              <th scope="row"><?= __('<%= Inflector::humanize($field) %>') ?></th>
              <td><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></td>
            </tr>
            <% endforeach; %>
            <% endif; %>
          </tbody>
        </table>

        <% if ($groupedFields['text']) : %>
        <% foreach ($groupedFields['text'] as $field) : %>
        <div class="row">
          <div class="col-sm-12">
            <h4><?= __('<%= Inflector::humanize($field) %>') ?></h4>
            <?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?>
          </div>
        </div>
        <% endforeach; %>
        <% endif; %>
      </div>
      <div class="card-footer">
        <?= $this->Html->link('<i class="fa fa-arrow-left" aria-hidden="true"></i> '.__('Back'), $referer, ['class' => 'btn btn-light', 'escape'=>false]) ?>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col">
    <%
    $relations = $associations['HasMany'] + $associations['BelongsToMany'];
    foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    %>
    <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related <%= $otherPluralHumanName %>') ?></h4>
          <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
            <thead>
              <tr>
                <% foreach ($details['fields'] as $field): %>
                <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                <% endforeach; %>
                <th class="actions"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
                <tr>
                  <%- foreach ($details['fields'] as $field): %>
                  <td data-title="<%= Inflector::humanize($field) %>"><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></td>
                  <%- endforeach; %>
                  <%- $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                  <td data-title="actions" class="actions" class="text-right">
                    <div class="btn-group">
                      <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('View'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                    </td>
                  </div>
                </tr >

              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
    <% endforeach; %>
  </div>
</div>
