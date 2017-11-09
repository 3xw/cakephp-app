<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Cache\Cache;
use Cake\Datasource\EntityInterface;
use ArrayObject;

/**
* ClearCache behavior
*/
class ClearCacheBehavior extends Behavior
{

  /**
  * Default configuration.
  *
  * @var array
  */
  protected $_defaultConfig = [
    'cache' => []
  ];

  public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
  {
    $this->clear();
  }

  public function afterDelete(Event $event, EntityInterface $entity, ArrayObject $options)
  {
    $this->clear();
  }

  public function clear()
  {
    foreach($this->config('cache') as $cache )
    {
      Cache::clear(false, $cache);
    }
  }

}
