<?php
class JosDemiejourneesDefaultSchedulesController extends AppController {

	var $name = 'JosDemiejourneesDefaultSchedules';
	#var $components = array('Alaxos.AlaxosFilter');	

	var $helpers = array('Html', 'Form', 'DatePicker');
var $paginate = array(
        'limit' => 50,
        'order' => array(
            'JosDemiejourneesDefaultSchedule.id' => 'asc'
        )
    ); 
	function index() {
		#$this->Node->locale = 'fr_CH';
		$this->JosDemiejourneesDefaultSchedule->recursive = 0;
		$this->set('josDemiejourneesDefaultSchedules', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid jos demiejournees default schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('josDemiejourneesDefaultSchedule', $this->JosDemiejourneesDefaultSchedule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JosDemiejourneesDefaultSchedule->create();
			if ($this->JosDemiejourneesDefaultSchedule->save($this->data)) {
				$this->Session->setFlash(__('The jos demiejournees default schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jos demiejournees default schedule could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid jos demiejournees default schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosDemiejourneesDefaultSchedule->save($this->data)) {
				$this->Session->setFlash(__('The jos demiejournees default schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jos demiejournees default schedule could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosDemiejourneesDefaultSchedule->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for jos demiejournees default schedule', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JosDemiejourneesDefaultSchedule->delete($id)) {
			$this->Session->setFlash(__('Jos demiejournees default schedule deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Jos demiejournees default schedule was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function metajourplaces() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
		$id=$_GET['id'];
		$nplaces=$_GET['val'];
		$sqlo="UPDATE jos_demiejournees_default_schedules  
		SET npers = '" .$nplaces ."'
		WHERE id=" .$id;
			#echo "<br>".$sqlo; exit;
			
			$sql=mysql_query($sqlo);
			if(!$sql) { 
				echo "SQL error with query: " .$sqlo ."<br>".mysql_error(); //sql problem
			} else {
				header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
				exit();
			}
	}

}
?>
