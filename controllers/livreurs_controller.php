<?php
class LivreursController extends AppController {

	var $name = 'Livreurs';

	function index() {
		$this->Livreur->recursive = 0;
		$this->set('livreurs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid livreur', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('livreur', $this->Livreur->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Livreur->create();
			if ($this->Livreur->save($this->data)) {
				$this->Session->setFlash(__('The livreur has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The livreur could not be saved. Please, try again.', true));
			}
		}
		$option=array("order"=>"name");
		$josUsers = $this->Livreur->JosUser->find('list',$options);
		$this->set(compact('josUsers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid livreur', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Livreur->save($this->data)) {
				$this->Session->setFlash(__('The livreur has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The livreur could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Livreur->read(null, $id);
		}
		$josUsers = $this->Livreur->JosUser->find('list');
		$this->set(compact('josUsers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for livreur', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Livreur->delete($id)) {
			$this->Session->setFlash(__('Livreur deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Livreur was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
