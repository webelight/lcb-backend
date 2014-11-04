<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 */
class CustomersTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('customers');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Creators', [
			'foreignKey' => 'creator_id',
		]);
		$this->belongsTo('Modifiers', [
			'foreignKey' => 'modifier_id',
		]);
		$this->belongsTo('Cities', [
			'foreignKey' => 'city_id',
		]);
		$this->belongsTo('Categories', [
			'foreignKey' => 'category_id',
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->add('recstatus', 'valid', ['rule' => 'boolean'])
			->validatePresence('recstatus', 'create')
			->notEmpty('recstatus')
			->add('creator_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('creator_id')
			->add('modifier_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('modifier_id')
			->validatePresence('name', 'create')
			->notEmpty('name')
			->validatePresence('address', 'create')
			->notEmpty('address')
			->add('pincode', 'valid', ['rule' => 'numeric'])
			->validatePresence('pincode', 'create')
			->notEmpty('pincode')
			->add('email', 'valid', ['rule' => 'email'])
			->validatePresence('email', 'create')
			->notEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->add('contact', 'valid', ['rule' => 'numeric'])
			->validatePresence('contact', 'create')
			->notEmpty('contact')
			->add('credit_period', 'valid', ['rule' => 'numeric'])
			->validatePresence('credit_period', 'create')
			->notEmpty('credit_period')
			->validatePresence('remarks', 'create')
			->notEmpty('remarks')
			->add('city_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('city_id', 'create')
			->notEmpty('city_id')
			->add('category_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('category_id', 'create')
			->notEmpty('category_id');

		return $validator;
	}

}