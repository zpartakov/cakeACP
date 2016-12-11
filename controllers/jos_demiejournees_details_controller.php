<?php
class JosDemiejourneesDetailsController extends AppController {

	var $name = 'JosDemiejourneesDetails';
	var $helpers = array('Html', 'Form');
	        var $components = array('RequestHandler'); 
	#criteres de tri
	var $paginate = array(
        'limit' => 100,
        'order' => array(
            'JosDemiejourneesDetail.date' => 'asc'
        )
    );
	function index() {
		$this->JosDemiejourneesDetail->recursive = 0;
		$this->set('josDemiejourneesDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid JosDemiejourneesDetail.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('josDemiejourneesDetail', $this->JosDemiejourneesDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JosDemiejourneesDetail->create();
			if ($this->JosDemiejourneesDetail->save($this->data)) {
				$this->Session->setFlash(__('The JosDemiejourneesDetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The JosDemiejourneesDetail could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid JosDemiejourneesDetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->JosDemiejourneesDetail->save($this->data)) {
				#$this->Session->setFlash(__('The JosDemiejourneesDetail has been saved', true));
#				$this->redirect(array('action'=>'index'));
$this->redirect($_SERVER["HTTP_REFERER"]);

			} else {
				$this->Session->setFlash(__('The JosDemiejourneesDetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JosDemiejourneesDetail->read(null, $id);
		}
	}

	function delete() {

	}

function liste() {
			$this->JosDemiejourneesDetail->recursive = 0;
			$aujourdhui=date("Y-m-d h:i");
			$options = array(
				"JosDemiejourneesDetail.date >= '" .$aujourdhui ."'"
			);
			$this->set(array('josDemiejourneesDetails' => $this->paginate('JosDemiejourneesDetail', $options))); 
	}
	
	function changer()
	{
	}
	
	function metajourplaces() //fonction pour mettre a jour automatiquement le nombr de personnes pour une date donnee
	{
		$id=$_GET['id'];
		$nplaces=$_GET['val'];
		//echo "Date: " .$date ." - npers: " .$val; 		exit; //tests
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

function correction() {
	}

function correction2() {
	}
	
function archiver() {
}

function intialiser() {
}


   function export() //http://bakery.cakephp.org/articles/view/exporting-data-to-csv-the-cakephp-way
        {
            // Stop Cake from displaying action's execution time
            Configure::write('debug',0);
            // Find fields needed without recursing through associated models

            $data = $this->JosDemiejourneesDetail->find(
                'all',
                array(
                    'fields' => array('date','user','npers','rem'),
                    'JosDemiejourneesDetail' => "JosDemiejourneesDetail.date ASC",

                    'contain' => false
            ));
            
            // Define column headers for CSV file, in same array format as the data itself
            $headers = array(
                'JosDemiejourneesDetail'=>array(
                    'date' => 'date',
                    'user' => 'Cocagnard/e',
                    'npers' => 'Nombre de personnes',
                    'rem' => 'Remarques'
                )
            );
                    $this->autoLayout = false;        
            // Add headers to start of data array
            array_unshift($data,$headers);
            // Make the data available to the view (and the resulting CSV file)
            $this->set(compact('data'));
        } 
        
        function nouveau() {
		}

}

//some functions out of the class
function colorier($npersprevues,$npers){
	if(($npersprevues-$npers)>2) { //manquent au moins trois personnes
		$lacouleur="#FFC0CB"; //rouge clair
	} elseif(($npersprevues-$npers)>1) { //manquent au moins trois personnes
		$lacouleur="#FFE2AE"; //orange clair
	} elseif(($npersprevues-$npers)>0) { //manquent au moins trois personnes
		$lacouleur="#D9FBD9"; //vert clair
	} else {
		$lacouleur=""; //ok, pas de couleur
	}
	echo $lacouleur;#C9FFC9
}#D9FBD9
?>
