<?php
class JosUsersController extends AppController {

	var $name = 'JosUsers';
	var $helpers = array('Html', 'Form');
			var $components = array('Auth');
	
#criteres de tri
	var $paginate = array(
        'limit' => 500,
        'order' => array(
            'JosUser.name' => 'asc'
        )
    );
	function index() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		//do not display layout
	//	$this->layout = '';

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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosUser.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josUser', $this->JosUser->read(null, $id));
	}

	function add() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
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
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		//do not display layout
		$this->layout = '';
	}

	
	function changepanier() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		$user=$_GET['user'];
		$panier=$_GET['panier'];
		$pddori=$_GET['pddori'];
		
		//echo "user: " .$user ." - panier: " .$panier; 		exit; //tests
		if($pddori==1){
			$sqlo="UPDATE jos_paniers
			SET panier = '" .$panier ."'
			WHERE user_id=" .$user;
		} else {
			$sqlo="
			INSERT INTO jos_paniers (panier,user_id)
			VALUES
			('".$panier ."','" .$user ."')";
		}

		//echo "<br>".$sqlo; exit;
			
		$sql=mysql_query($sqlo);
		if(!$sql) {
			echo "SQL error with query: " .$sqlo ."<br>".mysql_error(); //sql problem
		} else {
			header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
			exit();
		}
	}
	
	function changepdd() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		$user=$_GET['user'];
		$pdd=$_GET['pdd'];
		
			$sqlo="UPDATE jos_users_pdds
			SET jos_pdd_id = '" .$pdd ."'
			WHERE user_id=" .$user;
		$sql=mysql_query($sqlo);
		if(!$sql) {
			echo "SQL error with query: " .$sqlo ."<br>".mysql_error(); //sql problem
		} else {
			header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
			exit();
		}
	}
	
	function importer() {
				eject_non_admin(); //on autorise pas les non-administrateurs
		
		/*
		 * use only once to import user from a csv-excel like file
		 */
	}
	
	/*
	 * pages for members
	*/
	function coordonnees() {
		$this->layout = 'intranet';
	}
	
}
?>
