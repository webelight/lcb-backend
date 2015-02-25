<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController {

/**
 * Initialize method
 *
 * @return void
 */
	public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
		$this->response->header('Access-Control-Allow-Origin', '*');
		$this->response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');        
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->params['_ext']) {
			$this->set('orders', $this->Orders->find('all',['contain' => ['Creators', 'Modifiers', 'Users','Customers', 'VesselOwners', 'Statuses', 'Vessels','Loadings'=>['PortAgents','Ports','Ports2','LoiStatuses','BlStatuses','ShipmentTypes'],'Dischargings'=>['PortAgents','Ports','Ports2'],'Invoices','Events']]));
			$this->set('_serialize', ['orders']);
		} else {
			$this->paginate = [
				'contain' => ['Creators', 'Modifiers', 'Users','Customers', 'VesselOwners', 'Statuses', 'Vessels','Loadings'=>['PortAgents','Ports','Ports2','LoiStatuses','BlStatuses','ShipmentTypes'],'Dischargings'=>['PortAgents','Ports','Ports2'],'Invoices','Events']
			];
			$this->set('orders', $this->paginate($this->Orders));
		}
	}

/**
 * View method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		if($this->request->params['_ext']){
			$order = $this->Orders->get($id, [
				'contain' => ['Loadings'=>['PortAgents','Ports','LoiStatuses','BlStatuses','ShipmentTypes'],'Dischargings'=>['PortAgents'],'Invoices','Events']
			]);
			$this->set('order', $order);
			$this->set('_serialize', ['order']);
		} else {
		$order = $this->Orders->get($id, [
			'contain' => ['Creators', 'Modifiers','Loadings'=>['PortAgents','Ports','LoiStatuses','BlStatuses','ShipmentTypes'],'Dischargings'=>['PortAgents'],'Invoices']
		]);
		$this->set('order', $order);
		}
	}

/**
 * View Order method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view_order($id = null) {
		if($this->request->params['_ext']){
			$order = $this->Orders->get($id, [
				'contain' => ['Statuses','Customers','VesselOwners','Vessels','Loadings'=>['PortAgents','Ports','Ports2','LoiStatuses','BlStatuses','ShipmentTypes'],'Dischargings'=>['PortAgents','Ports','Ports2'],'Invoices','Events','Users']
			]);
			$this->set('order', $order);
			$this->set('_serialize', ['order']);
		}
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		if($this->request->params['_ext']){
			$order = $this->Orders->newEntity($this->request->data);
			if ($this->Orders->save($order, ['validate' => false])) {
				$message = 'Saved';
			} else {
				$message = 'Error';
			}
			$this->set([
				'data' => $this->request->data,
				'message' => $message,
				'order' => $order,
				'_serialize' => ['message', 'order', 'data']
			]);
		} else {
		$order = $this->Orders->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Orders->save($order)) {
				$this->Flash->success('The order has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The order could not be saved. Please, try again.');
			}
		}
		$creators = $this->Orders->Creators->find('list');
		$modifiers = $this->Orders->Modifiers->find('list');
		$customers = $this->Orders->Customers->find('list');
		$vesselOwners = $this->Orders->VesselOwners->find('list');
		$statuses = $this->Orders->Statuses->find('list');
		$vessels = $this->Orders->Vessels->find('list');
		$this->set(compact('order', 'creators', 'modifiers', 'customers', 'vesselOwners', 'statuses', 'vessels'));
		}
	}

/**
 * Edit method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		if($this->request->params['_ext']){
			$order = $this->Orders->get($id, [
				'contain' => ['Loadings'=>['PortAgents','Ports','LoiStatuses','BlStatuses','ShipmentTypes'],'Dischargings'=>['PortAgents'],'Invoices','Events']
			]);
			if ($this->request->is(['patch', 'post', 'put'])) {
				$order = $this->Orders->patchEntity($order, $this->request->data);
				if ($this->Orders->save($order, ['validate' => false])) {
					$message = 'Saved';
				}
				else {
					$message = 'Error';
				}
			}
			$this->set([
				'order' => $order,
				'message' => $message,
				'data' => $this->request->data,
				'_serialize' => ['message','order','data']
			]);
		} else {
		$order = $this->Orders->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$order = $this->Orders->patchEntity($order, $this->request->data);
			if ($this->Orders->save($order)) {
				$this->Flash->success('The order has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The order could not be saved. Please, try again.');
			}
		}
		$creators = $this->Orders->Creators->find('list');
		$modifiers = $this->Orders->Modifiers->find('list');
		$customers = $this->Orders->Customers->find('list');
		$vesselOwners = $this->Orders->VesselOwners->find('list');
		$statuses = $this->Orders->Statuses->find('list');
		$vessels = $this->Orders->Vessels->find('list');
		$this->set(compact('order', 'creators', 'modifiers', 'customers', 'vesselOwners', 'statuses', 'vessels'));
	}
}

/**
 * Delete method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$order = $this->Orders->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Orders->delete($order)) {
			$this->Flash->success('The order has been deleted.');
		} else {
			$this->Flash->error('The order could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
