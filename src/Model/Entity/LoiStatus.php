<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LoiStatus Entity.
 */
class LoiStatus extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'recstatus' => true,
		'created_id' => true,
		'modified_id' => true,
		'name' => true,
		'creator' => true,
		'modifier' => true,
		'dischargings' => true,
		'loadings' => true,
	];

}
