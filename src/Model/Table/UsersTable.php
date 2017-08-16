<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakeDC\Users\Model\Table\UsersTable as CakeDCUsersTable;

class UsersTable extends CakeDCUsersTable
{

  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->belongsTo('Attachments', [
      'foreignKey' => 'attachment_id',
      'joinType' => 'LEFT'
    ]);

    // Add the behaviour to your table
    $this->addBehavior('Search.Search');

    // Setup search filter using search manager
    $this->searchManager()
    // Here we will alias the 'q' query param to search the `Articles.title`
    // field and the `Articles.content` field, using a LIKE match, with `%`
    // both before and after.
    ->add('q', 'Search.Like', [
      'before' => true,
      'after' => true,
      'mode' => 'or',
      'comparison' => 'LIKE',
      'wildcardAny' => '*',
      'wildcardOne' => '?',
      'field' => [$this->aliasField('first_name'), $this->aliasField('last_name'),$this->aliasField('email'),$this->aliasField('role')]
    ]);
  }

  public function validationStrongPassword(Validator $validator)
  {
    $validator->add('password', 'custom', [
      'rule' => function ($value, $context) {
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/i', $value)? true : false;
      },
      'message' => __('Password need to be at least 8 characters long AND must contain at least 1 Alphabet and 1 Number'),
      'on' => ['create', 'update'],
      'allowEmpty' => false
    ]);
    return $validator;
  }

  public function validationStrongUsername(Validator $validator)
  {
    $validator->add('username', 'custom', [
      'rule' => function ($value, $context) {
        return preg_match('/^[a-zA-Z0-9._\-]{5,}$/i', $value)? true : false;
      },
      'message' => __('Username need to be at least 5 characters long AND must contain only following chars').': a-z A-Z 0-9 '.__('and optionally').' . _ -',
      'on' => ['create', 'update'],
      'allowEmpty' => false
    ]);
    return $validator;
  }

  public function validationPasswordConfirm(Validator $validator)
  {
    $validator = parent::validationPasswordConfirm($validator);
    $validator = $this->validationStrongPassword($validator);
    //debug($validator);
    //die();
    return $validator;
  }

  public function validationDefault(Validator $validator)
  {
    $validator = parent::validationDefault($validator);
    $validator = $this->validationStrongUsername($validator);
    $validator = $this->validationStrongPassword($validator);
    return $validator;
  }
}
