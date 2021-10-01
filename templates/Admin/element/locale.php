<?php
use Cake\Core\Configure;
use Cake\I18n\I18n;
use Cake\Utility\Inflector;
use Cake\Utility\Hash;

$languages = Configure::read('I18n.languages');
$primary = I18n::getLocale();

?>

<locale :languages='<?= json_encode($languages) ?>' primary="<?= $primary ?>">
  <?php foreach ($languages as $lng):?>
    <locale-tab lng="<?= $lng ?>" >
      <?php
      $i = 0;
      foreach($fields as $key => $field)
      {
        $label = Inflector::humanize($labels[$i]).' ('.$lng.')';
        $fieldName = $primary == $lng? '': '_translations.'.$lng.'.';
        $fieldName .= is_numeric($key)? $field: $key;

        // value
        if(is_array($field) && !array_key_exists('value', $field) && isset($entity) && !$entity->isNew())
        {
          $field['value'] = Hash::get($entity->toArray(), $fieldName);
        }


        if(is_numeric($key)) echo $this->Form->control($fieldName, ['class' => 'form-control', 'label' => $label]);
        else
        {
          $basicSettings = ['label' => $label,'lng' => $lng,'field' => $fieldName, 'init' => ['label' => $label]];
          if(!empty($field['init']) && array_key_exists('attachment_settings', $field['init']))
          {
            $basicSettings = array_merge($basicSettings, [
              'init' => [
                'label' => $label,
                'attachment_settings' =>  $this->Attachment->setup($fieldName, $field['init']['attachment_settings'])
              ]
            ]);
          }

          if(!empty($field['element'])) echo $this->element($field['element'], array_merge($field, $basicSettings));
          else echo $this->Form->control($fieldName, array_merge($field, $basicSettings));
        }

        $i++;
      }
      ?>
    </locale-tab>
<?php endforeach; ?>
</locale>
