<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 */
class CountriesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('countries');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->addBehavior('Blame.Blame');

		$this->belongsTo('Creators', [
			'className' => 'Users',
			'foreignKey' => 'creator_id',
		]);
		$this->belongsTo('Modifiers', [
			'className' => 'Users',
			'foreignKey' => 'modifier_id',
		]);		$this->hasMany('Cities', [
			'foreignKey' => 'country_id',
		]);
		$this->hasMany('Ports', [
			'foreignKey' => 'country_id',
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
			->notEmpty('name');

		return $validator;
	}

}