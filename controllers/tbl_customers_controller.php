<?php
/*
 * Table des Cocagnard/e/s avec adresse etc. pour commandes
 * 
 * */
class TblCustomersController extends AppController {

	var $name = 'TblCustomers';
#criteres de tri
	var $paginate = array(
        'limit' => 500,
        'order' => array(
            'TblCustomer.PersNom,TblCustomer.PersPrenom' => 'asc'
        )
    );
    
	function index() {
		$this->TblCustomer->recursive = 0;
				if($this->data['TblCustomer']['q']) {
					$input = $this->data['TblCustomer']['q']; 
					# sanitize the query
					App::import('Sanitize');
					$q = Sanitize::escape($input);
					$options = array(
					"TblCustomer.PersNom LIKE '%" .$q ."%'" ." OR TblCustomer.PersPrenom LIKE '%" .$q ."%'"
					);
					$this->set(array('tblCustomers' => $this->paginate('TblCustomer', $options))); 
			} else {
		$this->set('tblCustomers', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tbl customer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tblCustomer', $this->TblCustomer->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TblCustomer->create();
			if ($this->TblCustomer->save($this->data)) {
				$this->Session->setFlash(__('The tbl customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tbl customer could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tbl customer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TblCustomer->save($this->data)) {
				$this->Session->setFlash(__('The tbl customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tbl customer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TblCustomer->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tbl customer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TblCustomer->delete($id)) {
			$this->Session->setFlash(__('Tbl customer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tbl customer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
		function miseajour() { //pour mettre a jour les cocagnards a partir du fichier access
		#todo before miseajour PDD http://129.194.18.217/cocagne/cake/jos_pdds/miseajour todo corriger serveur
	}
	
	function update_c5 () {
		/*
		 * a script to migrate joomla users to concrete5
		 * 
		 * */
		 				//do not display layout
		//$this->layout = '';
	}
}
?>
