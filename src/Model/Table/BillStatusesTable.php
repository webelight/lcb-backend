<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BillStatuses Model
 */
class BillStatusesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('bill_statuses');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Creators', [
			'foreignKey' => 'creator_id',
		]);
		$this->belongsTo('Modifiers', [
			'foreignKey' => 'modifier_id',
		]);
		$this->hasMany('Dischargings', [
			'foreignKey' => 'bill_status_id',
		]);
		$this->hasMany('Loadings', [
			'foreignKey' => 'bill_status_id',
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