<?php
class JosDemiejourneesController extends AppController {

	var $name = 'JosDemiejournees';
	var $helpers = array('Html', 'Form', 'DatePicker');
var $paginate = array(
        'limit' => 100,
        'order' => array(
            'JosDemiejournee.id' => 'asc'
        )
    ); 
	function index() {
		$this->JosDemiejournee->recursive = 0;
		$this->set('josDemiejournees', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosDemiejournee.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josDemiejournee', $this->JosDemiejournee->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JosDemiejournee->create();
			if ($this->JosDemiejournee->save($this->data)) {
				$this->Session->setFlash(__('The JosDemiejournee has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosDemiejournee could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JosDemiejournee', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosDemiejournee->save($this->data)) {
				$this->Session->setFlash(__('The JosDemiejournee has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosDemiejournee could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosDemiejournee->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for JosDemiejournee', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JosDemiejournee->del($id)) {
			$this->Session->setFlash(__('JosDemiejournee deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

//a function to adjust the number of persons for the demi-journees	
		function ajustements() {
			//do not display layout
			#$this->layout = '';
						

			}
			
			//ajax jours
			function montrejours() {
			}

function metajourplaces() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
		$id=$_GET['id'];
		$nplaces=$_GET['val'];
		$sqlo="UPDATE jos_demiejournees 
		SET nplaces = '" .$nplaces ."'
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
	
	function metajourstatut() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
		$id=$_GET['id'];
		$nplaces=$_GET['val'];
		#echo $nplaces; exit;
		if($nplaces=="true"){
			$nplaces=1;
		}elseif($nplaces=="false"){
			$nplaces=0;
		}
		$sqlo="UPDATE jos_demiejournees 
		SET statut = '" .$nplaces ."'
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
