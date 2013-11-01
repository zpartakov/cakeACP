<?php
class JosPddsController extends AppController {

	var $name = 'JosPdds';
			var $components = array('Auth');
	
	#criteres de tri
	var $paginate = array(
        'limit' => 100,
        'order' => array(
            'JosPdd.PDDTexte' => 'asc'
        )
    );
    
	function index() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		$this->JosPdd->recursive = 0;
		if($this->data['JosPdd']['q']) {
			$input = $this->data['JosPdd']['q']; 		
			# sanitize the query
			App::import('Sanitize');
			$q = Sanitize::escape($input);
			
			$options = array(
			"JosPdd.Lieu_dit LIKE '%" .$q ."%'" 
					." OR JosPdd.PDDTexte LIKE '%" .$q ."%'" 
					." OR JosPdd.mail LIKE '%" .$q ."%'"
			);
			$this->set(array('josPdds' => $this->paginate('JosPdd', $options))); 
		} else {
		$this->set('josPdds', $this->paginate());
		}
	}

	function view($id = null) {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid jos pdd', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('josPdd', $this->JosPdd->read(null, $id));
	}

	function add() {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!empty($this->data)) {
			$this->JosPdd->create();
			if ($this->JosPdd->save($this->data)) {
				$this->Session->setFlash(__('The jos pdd has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jos pdd could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid jos pdd', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosPdd->save($this->data)) {
				$this->Session->setFlash(__('The jos pdd has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jos pdd could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosPdd->read(null, $id);
		}
	}

	function delete($id = null) {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for jos pdd', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JosPdd->delete($id)) {
			$this->Session->setFlash(__('Jos pdd deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Jos pdd was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function miseajour() { //pour mettre a jour les PDD a partir du fichier access
					eject_non_admin(); //on autorise pas les non-administrateurs
		
	}
	
	function deleteuser() {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		/*
		 * supprimer un coopérateur d'un PDD
		 */
	}	
	function adduser() {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
		/*
		 * ajouter un coopérateur à un PDD
		 */
	}
/* liste des emails des PDD utilisables dynamiquement dans un email */	
	function emails() {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
				//do not display layout
	//	$this->layout = '';

		$this->JosPdd->recursive = 0;
		$this->set('josPdds', $this->paginate());
	}
	
	/* liste dynamique des PDD pour une question limesurvey */	
	function lime() {
					eject_non_admin(); //on autorise pas les non-administrateurs
		
			
}
}
