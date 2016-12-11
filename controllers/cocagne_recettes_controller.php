<?php
class CocagneRecettesController extends AppController {

	var $name = 'CocagneRecettes';
		#criteres de tri
	var $paginate = array(
        'limit' => 100,
        'order' => array(
            'CocagneRecette.titre' => 'asc'
        )
    );
	function index() {
		$this->CocagneRecette->recursive = 0;
							if($this->data['cocagneRecette']['q']) {
					$input = $this->data['cocagneRecette']['q']; 
					# sanitize the query
					App::import('Sanitize');
					$q = Sanitize::escape($input);
					$options = array(
					"CocagneRecette.titre LIKE '%" .$q ."%'" ." OR CocagneRecette.ingredients LIKE '%" .$q ."%'" ." OR CocagneRecette.preparation LIKE '%" .$q ."%'"
					);
					$this->set(array('cocagneRecettes' => $this->paginate('CocagneRecette', $options))); 
		} else {
		$this->set('cocagneRecettes', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cocagne recette', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cocagneRecette', $this->CocagneRecette->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CocagneRecette->create();
			if ($this->CocagneRecette->save($this->data)) {
				$this->Session->setFlash(__('The cocagne recette has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cocagne recette could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cocagne recette', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CocagneRecette->save($this->data)) {
				$this->Session->setFlash(__('The cocagne recette has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cocagne recette could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CocagneRecette->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cocagne recette', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CocagneRecette->delete($id)) {
			$this->Session->setFlash(__('Cocagne recette deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cocagne recette was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>