<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PortAgents Model
 */
class PortAgentsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('port_agents');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Creators', [
			'className' => 'Users',
			'foreignKey' => 'creator_id'
		]);
		$this->belongsTo('Modifiers', [
			'className' => 'Users',
			'foreignKey' => 'modifier_id'
		]);
		$this->hasMany('Dischargings', [
			'alias' => 'Dischargings',
			'foreignKey' => 'port_agent_id',
			'dependent' => true,
    	'cascadeCallbacks' => true
		]);
		$this->hasMany('Loadings', [
			'alias' => 'Loadings',
			'foreignKey' => 'port_agent_id',
			'dependent' => true,
    	'cascadeCallbacks' => true
		]);
		$this->hasMany('PortAgentContacts', [
			'alias' => 'PortAgentContacts',
			'foreignKey' => 'port_agent_id',
			'dependent' => true,
    	'cascadeCallbacks' => true
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator instance
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->add('recstatus', 'valid', ['rule' => 'numeric'])
			->requirePresence('recstatus', 'create')
			->notEmpty('recstatus')
			->add('creator_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('creator_id')
			->add('modifier_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('modifier_id')
			->requirePresence('name', 'create')
			->add('name',['unique' => ['rule' => 'validateUnique', 'provider' => 'table']])
			->notEmpty('name');

		return $validator;
	}

}
