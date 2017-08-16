<?php
use Cake\Core\Configure;
use Cake\I18n\I18n;
use Cake\Utility\Inflector;

$languages = Configure::read('I18n.languages');
$language = I18n::locale();

$this->Html->script(['Template/Admin/Element/locale.js?v='.time()],['block' => 'script']);
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
      'class' => $active
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
      if( $lng == I18n::defaultLocale() )
      {
        $inputConf = ['class' => '', 'label' => $label];
        $inputConf = array_merge($inputConf, $field);
        $inputConf['class'] .= ' form-control '.$class;
        $fieldInputs .= $this->Form->input($key, $inputConf );
      }else{
        $inputConf = ['class' => '', 'label' => $label,'required' => false];
        $inputConf = array_merge($inputConf, $field);
        $inputConf['class'] .= ' form-control '.$class;
        $fieldInputs .= $this->Form->input('_translations.'.$lng.'.'.$key, $inputConf);
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
