<?php
class ListeAttentesController extends AppController {

	var $name = 'ListeAttentes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->ListeAttente->recursive = 0;
		$this->set('listeAttentes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ListeAttente.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('listeAttente', $this->ListeAttente->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ListeAttente->create();
			if ($this->ListeAttente->save($this->data)) {
				$this->Session->setFlash(__('The ListeAttente has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ListeAttente could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ListeAttente', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->ListeAttente->save($this->data)) {
				$this->Session->setFlash(__('The ListeAttente has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ListeAttente could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ListeAttente->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ListeAttente', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ListeAttente->del($id)) {
			$this->Session->setFlash(__('ListeAttente deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>