<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
  public function initialize(array $config): void
  {
    parent::initialize($config);

    $this->setTable('users');
    $this->setDisplayField('id');
    $this->setPrimaryKey('id');

    $this->addBehavior('Timestamp');

    $this->belongsTo('Attachments', [
      'foreignKey' => 'attachment_id',
      'className' => 'Attachments',
    ]);
    $this->hasMany('SocialAccounts', [
      'foreignKey' => 'user_id',
      'className' => 'SocialAccounts',
    ]);
  }

  public function validationDefault(Validator $validator): Validator
  {
    $validator
    ->uuid('id')
    ->allowEmptyString('id', 'create');

    $validator
    ->scalar('username')
    ->maxLength('username', 255)
    ->requirePresence('username', 'create')
    ->notEmptyString('username');

    $validator
    ->email('email')
    ->allowEmptyString('email');

    $validator
    ->scalar('password')
    ->maxLength('password', 255)
    ->requirePresence('password', 'create')
    ->notEmptyString('password');

    $validator
    ->scalar('first_name')
    ->maxLength('first_name', 50)
    ->allowEmptyString('first_name');

    $validator
    ->scalar('last_name')
    ->maxLength('last_name', 50)
    ->allowEmptyString('last_name');

    $validator
    ->scalar('token')
    ->maxLength('token', 255)
    ->allowEmptyString('token');

    $validator
    ->dateTime('token_expires')
    ->allowEmptyDateTime('token_expires');

    $validator
    ->scalar('api_token')
    ->maxLength('api_token', 255)
    ->allowEmptyString('api_token');

    $validator
    ->dateTime('activation_date')
    ->allowEmptyDateTime('activation_date');

    $validator
    ->dateTime('tos_date')
    ->allowEmptyDateTime('tos_date');

    $validator
    ->boolean('active')
    ->notEmptyString('active');

    $validator
    ->boolean('is_superuser')
    ->notEmptyString('is_superuser');

    $validator
    ->scalar('role')
    ->maxLength('role', 255)
    ->allowEmptyString('role');

    $validator
    ->scalar('locale')
    ->maxLength('locale', 5)
    ->allowEmptyString('locale');

    return $validator;
  }

  /**
  * Returns a rules checker object that will be used for validating
  * application integrity.
  *
  * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
  * @return \Cake\ORM\RulesChecker
  */
  public function buildRules(RulesChecker $rules): RulesChecker
  {
    $rules->add($rules->isUnique(['username']));
    $rules->add($rules->isUnique(['email']));
    $rules->add($rules->existsIn(['attachment_id'], 'Attachments'));

    return $rules;
  }
}
