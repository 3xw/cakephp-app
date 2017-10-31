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
%>
<div class="row justify-content-md-center">
  <div class="col">
    <div class="card">
      <?= $this->Form->create($<%= $singularVar %>, ['novalidate']); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-4">
            <h4 class="title"><?= __('<%= Inflector::humanize($action) %> <%= $singularHumanName %>') ?></h4>
          </div>
          <div class="col-8">
            <ul class="nav justify-content-end">
              <li class="nav-item">
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- FORM -->
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
            if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
              %>
              echo $this->Form->input('<%= $field %>', ['empty' => true, 'default' => '', 'class' => 'form-control']);
              <%
            }   else {
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
    </div>
    <div class="card-footer text-right">
      <div class="btn-group">
        <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
</div>
