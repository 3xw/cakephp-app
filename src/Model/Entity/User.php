<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use CakeDC\Users\Model\Entity\User as CakeDCUser;

class User extends CakeDCUser
{

  protected $_accessible = [
      '*' => true,
      'id' => false,
      'is_superuser' => false,
      'role' => true,
  ];

}
