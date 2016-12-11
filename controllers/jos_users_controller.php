<?php
class JosUsersController extends AppController {

	var $name = 'JosUsers';
	var $helpers = array('Html', 'Form');
#criteres de tri
	var $paginate = array(
        'limit' => 500,
        'order' => array(
            'JosUser.name' => 'asc'
        )
    );
	function index() {
		$this->JosUser->recursive = 0;
			if($this->data['JosUser']['q']) {
					$input = $this->data['JosUser']['q']; 
					# sanitize the query
					App::import('Sanitize');
					$q = Sanitize::escape($input);
					$options = array(
					"JosUser.name LIKE '%" .$q ."%'" ." OR JosUser.username LIKE '%" .$q ."%'"
					);
					$this->set(array('josUsers' => $this->paginate('JosUser', $options))); 
			} else {
		$this->set('josUsers', $this->paginate());
		}
	}
	/* a function to export datas in a nice simple table
	 * */
	function export() {
		//do not display layout
		$this->layout = '';

		$this->JosUser->recursive = 0;
			if($this->data['JosUser']['q']) {
					$input = $this->data['JosUser']['q']; 
					# sanitize the query
					App::import('Sanitize');
					$q = Sanitize::escape($input);
					$options = array(
					"JosUser.name LIKE '%" .$q ."%'" ." OR JosUser.username LIKE '%" .$q ."%'"
					);
					$this->set(array('josUsers' => $this->paginate('JosUser', $options))); 
			} else {
		$this->set('josUsers', $this->paginate());
		}

	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosUser.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josUser', $this->JosUser->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JosUser->create();
			if ($this->JosUser->save($this->data)) {
				$this->Session->setFlash(__('The JosUser has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosUser could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JosUser', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosUser->save($this->data)) {
				$this->Session->setFlash(__('The JosUser has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosUser could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosUser->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for JosUser', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JosUser->del($id)) {
			$this->Session->setFlash(__('JosUser deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	function livreur($id = null) {
		//do not display layout
		$this->layout = '';
	}

}
?>
