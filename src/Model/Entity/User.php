<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{

  protected $_accessible = [
    'username' => true,
    'email' => true,
    'password' => true,
    'first_name' => true,
    'last_name' => true,
    'token' => true,
    'token_expires' => true,
    'api_token' => true,
    'activation_date' => true,
    'tos_date' => true,
    'active' => true,
    'is_superuser' => true,
    'role' => true,
    'created' => true,
    'modified' => true,
    'attachment_id' => true,
    'locale' => true,
    'attachment' => true,
    'social_accounts' => true,
  ];

  protected $_hidden = [
    'password',
    'token',
  ];
}
