<?php
class JosReservationsDetailsController extends AppController {

	var $name = 'JosReservationsDetails';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->JosReservationsDetail->recursive = 0;
		$this->set('josReservationsDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosReservationsDetail.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josReservationsDetail', $this->JosReservationsDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JosReservationsDetail->create();
			if ($this->JosReservationsDetail->save($this->data)) {
				$this->Session->setFlash(__('The JosReservationsDetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosReservationsDetail could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JosReservationsDetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosReservationsDetail->save($this->data)) {
				$this->Session->setFlash(__('The JosReservationsDetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosReservationsDetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosReservationsDetail->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for JosReservationsDetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JosReservationsDetail->del($id)) {
			$this->Session->setFlash(__('JosReservationsDetail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>