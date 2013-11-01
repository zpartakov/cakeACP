<?php
class JosDemiejourneesController extends AppController {

	var $name = 'JosDemiejournees';
	var $helpers = array('Html', 'Form', 'DatePicker');
			var $components = array('Auth');
	
var $paginate = array(
        'limit' => 100,
        'order' => array(
            'JosDemiejournee.id' => 'asc'
        )
    ); 
	function index() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		$this->JosDemiejournee->recursive = 0;
		$this->set('josDemiejournees', $this->paginate());
	}

	function view($id = null) {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosDemiejournee.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josDemiejournee', $this->JosDemiejournee->read(null, $id));
	}

	function add() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
			eject_non_admin(); //on autorise pas les non-administrateurs
	
	//do not display layout
	#$this->layout = '';
				

	}
	
//ajax jours
function montrejours() {
			eject_non_admin(); //on autorise pas les non-administrateurs
	
}

function metajourplaces() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
	
	/*
	 * pages for members
	 */
	
	/*
	 * registration to demi-journees init (display list)
	 */
	function demijournees() {
		$this->layout = 'intranet';
	}
	
	/*
	 * confirmation of registration step 1, display user a list of items 
	 */
	function confirm() {
		$this->layout = 'intranet';
	}

	/*
	 * insert new registration after confirmation
	*/
	function insert() {
		$this->layout = 'intranet';
	}
	/*
	 * unregister user to a given day
	 */
	function desinscription() {
		$this->layout = 'intranet';
	}
	
	function mesinscriptions() {
		$this->layout = 'intranet';
	}
}

?>
