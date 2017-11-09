<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\ORM\Entity;
use Cake\Event\Event;
use Geo\Model\Behavior\GeocoderBehavior as BaseBehavior;

class GeocoderBehavior extends BaseBehavior
{
  public function beforeSave(Event $event, Entity $entity, ArrayObject $options)
  {
    if ($this->_config['on'] === 'beforeSave') {
      if (!$this->geocode($entity)) {
        $event->stopPropagation();
        return false;
      }
    }
  }
}
