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
  return $schema->columnType($field) !== 'binary';
});

if (isset($modelObject) && $modelObject->hasBehavior('Tree')) {
  $fields = $fields->reject(function ($field) {
    return $field === 'lft' || $field === 'rght';
  });
}
%>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('<%= Inflector::humanize($action) %> <%= $singularHumanName %>') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
          <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($<%= $singularVar %>); ?>
      <?php
      <%
      foreach ($fields as $field) {
        if (in_array($field, $primaryKey)) {
          continue;
        }
        if (isset($keyFields[$field])) {
          $fieldData = $schema->column($field);
          if (!empty($fieldData['null'])) {
            %>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true, 'class' => 'form-control']);
            <%
          } else {
            %>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'class' => 'form-control']);
            <%
          }
          continue;
        }
        if (!in_array($field, ['created', 'modified', 'updated'])) {
          $fieldData = $schema->column($field);
          if (in_array($fieldData['type'], ['date', 'datetime', 'time']) && (!empty($fieldData['null']))) {
            %>
            echo $this->Form->input('<%= $field %>', ['empty' => true, 'default' => '', 'class' => 'form-control']);
            <%
          } else {
            %>
            echo $this->Form->input('<%= $field %>', ['class' => 'form-control']);
            <%
          }
        }
      }
      if (!empty($associations['BelongsToMany'])) {
        foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
          %>
          <%
          if (($assocData['property'] === 'attachments')) {
            %>
            echo $this->Attachment->input('Attachments', // if Attachments => HABTM else if !Attachments => belongsTo
            ['label' => __('Images'),
            'types' =>['image/jpeg','image/png'],
            'atags' => [],
            'restrictions' => [
              Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
              Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
            ],
            'attachments' => [] // array of exisiting Attachment entities ( HABTM ) or entity ( belongsTo )
          ]);
          <%
        }   else {
          %>
          echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>, 'class' => 'form-control']);
          <%
        }
      }
    }
    %>
    ?>
    <div class="text-right">
      <div class="btn-group">
        <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
</div>
<div class="utils--spacer-default"></div>
