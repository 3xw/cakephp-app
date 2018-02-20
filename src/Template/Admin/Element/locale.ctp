<?php
use Cake\Core\Configure;
use Cake\I18n\I18n;
use Cake\Utility\Inflector;

$languages = Configure::read('I18n.languages');
$language = I18n::locale();

$this->Html->scriptBlock('var languages = '.  json_encode($languages).'; var language = "'.$language.'";', ['block' => 'script']);

$li = $fieldInputs = $originalFieldInputs = '';

foreach( $languages as $lng )
{
  //active
  $active = ( $lng == $language )? 'active': '';

  //class
  $class = 'locale-'.$lng;

  // tabs
  $li .= $this->Html->tag(
    'li',
    $this->Html->link($lng, '#locale-selector-ul', ['aria-controls' => '#locale-selector-ul']),
    [
      'role' => 'presentation',
      'class' => 'locale-selector-li locale-selector-li--'.$lng.' '.$active
    ]
  );

  // fields
  $i = 0;
  foreach($fields as $key => $field)
  {

    if(!is_array($field))
    {

      if(!empty($labels) && !empty($labels[$i])){
        $label = Inflector::humanize($labels[$i]).' ('.$lng.')';
      }else{
        $label = Inflector::humanize($field).' ('.$lng.')';
      }
      if( $lng == I18n::defaultLocale() )
      {
        $fieldInputs .= $this->Form->input($field, ['class' => 'form-control '.$class, 'label' => $label]);
      }else{
        $fieldInputs .= $this->Form->input('_translations.'.$lng.'.'.$field, ['class' => 'form-control '.$class, 'label' => $label,'required' => false]);
      }
    }else{
      if(!empty($labels) && !empty($labels[$i])){
        $label = Inflector::humanize($labels[$i]).' ('.$lng.')';
      }else{
        $label = Inflector::humanize($key).' ('.$lng.')';
      }

      $inputConf = ['class' => '', 'label' => $label];
      $inputConf['required'] = ($lng == I18n::defaultLocale())? true: false;
      $fieldName = ($lng == I18n::defaultLocale())? $key: '_translations.'.$lng.'.'.$key;
      if(!empty($field['Attachment.trumbowyg']))
      {
        $inputConf = array_merge($inputConf, $field['Attachment.trumbowyg']);
        $inputConf['class'] .= ' form-control '.$class;
        if(!empty($field['Attachment.trumbowyg']['content'])){
          $inputConf['content'] = ($lng == I18n::defaultLocale())? $field['Attachment.trumbowyg']['content']->$fieldName : $field['Attachment.trumbowyg']['content']->_translations[$lng]->$key;
        }
        $fieldInputs .= $this->Attachment->trumbowyg($fieldName,$inputConf);
      }else
      {
        $inputConf = array_merge($inputConf, $field);
        $inputConf['class'] .= ' form-control '.$class;
        $fieldInputs .= $this->Form->input($fieldName, $inputConf);
      }
    }
    $i++;
  }
}

?>
<div class="locale-area">
  <ul id="locale-selector-ul" class="nav nav-tabs" role="tablist">
    <?= $li; ?>
  </ul>
  <div class="tab-locale">
    <?= $fieldInputs ?>
    <?= $originalFieldInputs ?>
  </div>
</div>
