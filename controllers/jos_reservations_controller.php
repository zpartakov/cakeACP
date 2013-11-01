<?php
#App::import('Vendor','include_fonctions.php');
class JosReservationsController extends AppController {

	var $name = 'JosReservations';
	var $components = array('Auth');
	
	var $helpers = array('Html', 'Form');

	function index() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		$this->JosReservation->recursive = 0;
		$this->set('josReservations', $this->paginate());
	$aujourdhui=date("Y-m-d");
	$def_jours_affiches=20; //test to remove

		}

	function view($id = null) {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosReservation.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josReservation', $this->JosReservation->read(null, $id));
	}

	function add() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!empty($this->data)) {
			$this->JosReservation->create();
			if ($this->JosReservation->save($this->data)) {
				$this->Session->setFlash(__('The JosReservation has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosReservation could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JosReservation', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosReservation->save($this->data)) {
				$this->Session->setFlash(__('The JosReservation has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosReservation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosReservation->read(null, $id);
		}
	}

	function delete($id = null) {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for JosReservation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JosReservation->del($id)) {
			$this->Session->setFlash(__('JosReservation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	function adds() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		

	}
	
}
?>