<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\CustomersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomersTable Test Case
 */
class CustomersTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.customers',
		'app.creators',
		'app.modifiers',
		'app.cities',
		'app.countries',
		'app.ports',
		'app.dischargings',
		'app.loadings',
		'app.loi_statuses',
		'app.bill_statuses',
		'app.orders',
		'app.customer_masters',
		'app.ship_owners',
		'app.status_masters',
		'app.vessel_masters',
		'app.port_masters',
		'app.vessel_owners',
		'app.vessel_owner_categories',
		'app.vessel_owner_contacts',
		'app.vessels',
		'app.customer_categories',
		'app.customer_contacts'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Customers') ? [] : ['className' => 'App\Model\Table\CustomersTable'];
		$this->Customers = TableRegistry::get('Customers', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customers);

		parent::tearDown();
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
