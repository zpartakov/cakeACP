<?php
#http://book.cakephp.org/view/1250/Authentication
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter','Auth');
	
	var $paginate = array(
        'limit' => 300,
        'order' => array(
            'User.username' => 'asc'
        )
    );

  function beforeFilter() {
		$this->Auth->allow('login','login_adherent','logout', 'passwordreminder', 
				'renvoiemail', 'confirmation');
		
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
	 }

	function index()
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		$this->User->recursive = 0;
		$this->set('users', $this->paginate($this->User, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		$this->_set_user($id);
	}

	function add()
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		if (!empty($this->data))
		{
			$this->User->create();
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
	}

	function edit($id = null)
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid user', true), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
//			print_r($this->data); exit;

			/*
			 * modify PDD
			 */
			$sql="UPDATE jos_users_pdds SET jos_pdd_id=".$_POST['pdd'] ." WHERE user_id=" .$this->data['User']['id'];
			$sql=mysql_query($sql); 
			if(!$sql) {
				echo "SQL error DJ: " .mysql_error();
			}
			
			/*
			 * modify oeufs
			 */
			$sql="UPDATE oeufs SET oeufs=".$_POST['oeufs'] ." WHERE user_id=" .$this->data['User']['id'];
			$sql=mysql_query($sql); 
			if(!$sql) {
				echo "SQL error DJ: " .mysql_error();
			}
						//echo ; exit;

			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_user($id);
		
	}

	function delete($id = null)
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for user', true), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->User->delete($id))
		{
			$this->Session->setFlash(___('user deleted', true), 'flash_message');
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('user was not deleted', true), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl) && $this->Acl->check($this->Auth->user(), 'Users/' . $this->data['_Tech']['action']))
	        {
	            $this->setAction($this->data['_Tech']['action']);
	        }
	        elseif(!isset($this->Acl))
	        {
                $this->setAction($this->data['_Tech']['action']);
	        }
	        else
	        {
	        	if(isset($this->Auth))
	        	{
	            	$this->Session->setFlash($this->Auth->authError, $this->Auth->flashElement, array(), 'auth');
	            }
	            else
	            {
	            	$this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error');
	            }
	            
	            $this->redirect($this->referer());
	        }
	    }
	    else
	    {
	        $this->Session->setFlash(___d('alaxos', 'the action to perform is not defined', true), 'flash_error');
	        $this->redirect($this->referer());
	    }
	}
	
	function deleteAll()
	{
	eject_non_admin(); //on autorise pas les non-administrateurs
		
	    $ids = Set :: extract('/User/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->User->deleteAll(array('User.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(__('Users deleted', true), 'flash_message');
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__('Users were not deleted', true), 'flash_error');
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(__('No user to delete was found', true), 'flash_error');
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	function _set_user($id)
	{
		//eject_non_admin(); //on autorise pas les non-administrateurs
		
		if(empty($this->data))
	    {
    	    $this->data = $this->User->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for User', true), 'flash_error');
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('user', $this->data);
	}
		
	function login() {
		//$this->Session->setFlash("Vous êtes maintenant connecté.");
		//$this->redirect(array('page'=>'home'));
		//$this->redirect(RACINEDIR."/jos_demiejournees/demijournees");
		if (!empty($this->data) &&
				!empty($this->Auth->data['User']['username']) &&
				!empty($this->Auth->data['User']['password'])) {
			$this->redirect(array('controller'=>'jos_demiejournees', 'action' => 'demijournees'));
			}
	}
	function login_adherent() {
		/*
		 * a special login with dolibarr
		 */
	}
	

    function logout()
    {
	$this->Session->setFlash("Vous êtes maintenant déconnecté.");
	$this->redirect($this->Auth->logout());
    } 
	
    function coordonnees($id = null) {
    	$id=$_GET['idx'];
    	/*$idx=$_POST['idx'];*/

    	if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid user', true), 'flash_error');
			//$this->redirect(array('action' => 'index'));
							$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
			
		}
		
		if (!empty($this->data))
		{

			if ($this->User->save($this->data))
			{
				$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
							//$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));

				$from  = "From: ".$this->data['User']['email']."\n";
				$from .= "MIME-version: 1.0\n";
				$from .= "Content-type: text/html; charset= UTF-8\n";
				
				$message="
				Attention, 
				l'utilisateur <strong>" .$this->data['User']['name'] ."</strong> a changé ses coordonnées.
				
				Pour voir les changements: 
				<a href=\"http://".SERVEUR.CHEMIN."users/view/".$this->data['User']['id']."\">http://".SERVEUR.CHEMIN."users/view/".$this->data['User']['id']."</a>";
				
				$message=nl2br($message);
				
				mail(ADMINMAIL,'changement de données pour un utilisateur',$message,$from);
				$this->redirect($this->Auth->logout());
				
			}
			else
			{
				$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
			}
		}
		
		$this->_set_user($id);
    }
    
	function passwordreminder() {
		/*
		 * form to fill before sending back a new password to the registred user
		 */
	}
	
	function renvoiemail() {
		/*
		 * resent password
		*/
		$email=$_GET['email'];
		
		if(!$email) {
			echo "<h1>Merci de fournir votre email!";
			echo '<br /><a href="javascript:history.go(-1)">Retour</a></h1>';
			exit;
		}
		$confirm="SELECT * FROM users WHERE email LIKE '" .$email ."'";
		
		//echo "<br>" .$confirm ."<br>"; exit; //tests
	
		//compte demo
		if($email=="demo@".SERVEURMAIL) {
			error_reporting(0);
			echo "Vous ne pouvez pas vous faire renvoyer un mot de passe pour le compte démo!";
			exit;
		}
	
		$confirm=mysql_query($confirm);
		if(!$confirm) {
			echo "SQL error: " .mysql_error(); exit;
		}
		if(mysql_num_rows($confirm)=="1") { //user email ok
			$login=mysql_result($confirm,0,'username');
			#génère password
			$pass=""; $length=8;
			$vowels = array("a",  "e",  "i",  "o",  "u",  "ae",  "ou",  "io",
					"ea",  "ou",  "ia",  "ai");
			// A List of Consonants and Consonant sounds that we can insert
			// into the password string
			$consonants = array("b",  "c",  "d",  "g",  "h",  "j",  "k",  "l",  "m",
					"n",  "p",  "r",  "s",  "t",  "u",  "v",  "w",
					"tr",  "cr",  "fr",  "dr",  "wr",  "pr",  "th",
					"ch",  "ph",  "st",  "sl",  "cl");
			// For the call to rand(), saves a call to the count() function
			// on each iteration of the for loop
			$vowel_count = count($vowels);
			$consonant_count = count($consonants);
			// From $i .. $length, fill the string with alternating consonant
			// vowel pairs.
			for ($i = 0; $i < $length; ++$i) {
				$pass .= $consonants[rand(0,  $consonant_count - 1)] .
				$vowels[rand(0,  $vowel_count - 1)];
			}
				
			// Since some of our consonants and vowels are more than one
			// character, our string can be longer than $length, use substr()
			// to truncate the string
			$password=substr($pass,  0,  $length);
			/*
			 * read the local salt for hashing the password
			 */
			$hash=Configure::read('Security.salt');
			$hpassword=sha1($hash.$password);
			#echo $hpassword; exit;
	
			$confirm="UPDATE users SET password = '" .$hpassword ."' WHERE email LIKE '" .$email ."'";
			//echo "<br>".$confirm."<br>"; //tests
	
			$confirm=mysql_query($confirm);
			if(!$confirm) {
				echo "SQL error: " .mysql_error(); exit;
			}
			$textemail="
			Vous - ou quelqu'un se faisant passer pour vous - a demandé à se faire renvoyer à cet email un mot de passe;
	
			Votre identifiant: " .$login ."
	
			Votre nouveau mot de passe: " .$password;
			$textemail.='
	
			Se connecter à '.SERVEUR.': <a href="http://'.SERVEUR.CHEMIN.'users/login">http://'.SERVEUR.CHEMIN.'users/login</a>
	
			----
			Message automatique généré par un script
			';
			$textemail=nl2br($textemail);
			$Destinataire = $email;
			$Sujet = "Nouveau mot de passe \"".SERVEUR."\"";
	
			$From  = "From: ".ADMINMAIL."\n";
			$From .= "MIME-version: 1.0\n";
			$From .= "Content-type: text/html; charset= UTF-8\n";
	
			$Message = $textemail;
	
			$envoie=mail($Destinataire,$Sujet,$Message,$From);
			if(!$envoie) {
				echo "Problem sending email!";
			}
	
			//echo '<meta http-equiv="refresh" content="0;URL='.CHEMIN .'/users/confirmation">';
			header("Location: ".CHEMIN ."/users/confirmation");
	
		} else { //user email not registered, potential hack
			// de-activate error reporting
			error_reporting(0);
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
			echo "L'email " .$email ." n'est pas enregistr&eacute; dans notre base de données, votre adresse IP " .$_SERVER["REMOTE_ADDR"] ." a été enregistrée";
			/*
			 * bidon...
			 */
			exit;
		}
	}
	
	function confirmation() {
		/*
		 * page displayed to user after password reset
		 */
	}
	
	function export() {
		/*
		 * export users in csv
		 */
		$this->layout = '';
				eject_non_admin(); //on autorise pas les non-administrateurs
		$this->User->recursive = 0;
		$this->set('users', $this->paginate($this->User, $this->AlaxosFilter->get_filter()));
		
	}
	
	function tiers_adherent()
	{
	
	}

}
?>
