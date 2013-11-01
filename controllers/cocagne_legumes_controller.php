<?php
class CocagneLegumesController extends AppController {

	var $name = 'CocagneLegumes';
		var $components = array('Auth');
	
		#criteres de tri
	var $paginate = array(
        'limit' => 100,
        'order' => array(
            'CocagneLegume.legume' => 'asc'
        )
    );
	function index() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		$this->CocagneLegume->recursive = 0;
					if($this->data['CocagneLegume']['q']) {
					$input = $this->data['CocagneLegume']['q']; 
					# sanitize the query
					App::import('Sanitize');
					$q = Sanitize::escape($input);
					$options = array(
					"CocagneLegume.legume LIKE '%" .$q ."%'" ." OR CocagneLegume.remarques LIKE '%" .$q ."%'" ." OR CocagneLegume.conseils LIKE '%" .$q ."%'"
					);
					$this->set(array('cocagneLegumes' => $this->paginate('CocagneLegume', $options))); 
		} else {
		$this->set('cocagneLegumes', $this->paginate());
		}
	}

	function view($id = null) {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid cocagne legume', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cocagneLegume', $this->CocagneLegume->read(null, $id));
	}

	function add() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!empty($this->data)) {
			$this->CocagneLegume->create();
			if ($this->CocagneLegume->save($this->data)) {
				$this->Session->setFlash(__('The cocagne legume has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cocagne legume could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cocagne legume', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CocagneLegume->save($this->data)) {
				$this->Session->setFlash(__('The cocagne legume has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cocagne legume could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CocagneLegume->read(null, $id);
		}
	}

	function delete($id = null) {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cocagne legume', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CocagneLegume->delete($id)) {
			$this->Session->setFlash(__('Cocagne legume deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cocagne legume was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>