<?php
class DjMaintenancesController extends AppController {

	var $name = 'DjMaintenances';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->DjMaintenance->recursive = 0;
		$this->set('djMaintenances', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid DjMaintenance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('djMaintenance', $this->DjMaintenance->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DjMaintenance->create();
			if ($this->DjMaintenance->save($this->data)) {
				$this->Session->setFlash(__('The DjMaintenance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The DjMaintenance could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid DjMaintenance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DjMaintenance->save($this->data)) {
				$this->Session->setFlash(__('The DjMaintenance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The DjMaintenance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DjMaintenance->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for DjMaintenance', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->DjMaintenance->del($id)) {
			$this->Session->setFlash(__('DjMaintenance deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The DjMaintenance could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>