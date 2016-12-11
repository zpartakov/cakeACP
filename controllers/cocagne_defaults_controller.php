<?php
class CocagneDefaultsController extends AppController {

	var $name = 'CocagneDefaults';

	function index() {
		$this->CocagneDefault->recursive = 0;
		$this->set('cocagneDefaults', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cocagne default', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cocagneDefault', $this->CocagneDefault->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CocagneDefault->create();
			if ($this->CocagneDefault->save($this->data)) {
				$this->Session->setFlash(__('The cocagne default has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cocagne default could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cocagne default', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CocagneDefault->save($this->data)) {
				$this->Session->setFlash(__('The cocagne default has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cocagne default could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CocagneDefault->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cocagne default', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CocagneDefault->delete($id)) {
			$this->Session->setFlash(__('Cocagne default deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cocagne default was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

	public function export() {
		$this->layout = '';
	}

}


?>
