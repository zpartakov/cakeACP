<?php
/*
 * insert new registration after confirmation
*/

$this->pageTitle="Mes demi-journées";

App::import('Lib', 'functions'); //imports app/libs/functions

//datas
$ladate=$_POST['ladate'];
$np=$_POST['np'];
$voiture=$_POST['voiture'];
$remarques=$_POST['remarques'];
$remarques=addslashes($remarques);
$utilisateur=$session->read('Auth.User.username');

//mysql
$sql="SELECT *
FROM `users`
WHERE `username` LIKE '" .$utilisateur ."'";
//echo $sql; exit;  
$checkUser=mysql_query($sql);
if(!$checkUser) {
	echo "Sorry, this user is not allowed or doesn't exist!";
	exit;
}

###### on ecrit dans la db #########
$query= "
		INSERT INTO `jos_demiejournees_details`
		(`id`, `date`, `user`, `npers`, `voiture`, `rem`)
		VALUES
		(NULL, '$ladate', '$utilisateur', '$np', '$voiture', '$remarques')
		";
		#echo $query; exit;//tests 
		$db=mysql_query($query);
		if(!$db){
			echo "error mysql: <br>";
			echo "<br>" .$query ."<br>"; //test debug
			echo mysql_error();
		}
		
###### on envoie le mail au cocagnard #########
	$lemail=mysql_result($checkUser,0,'email');
	$lenom=mysql_result($checkUser,0,'name');
	$from=ADMINMAIL;
	$obj="Réservation demi-journée " .SITENAME;
	/*
	echo " pour ";
	if(preg_match("/18:00:00/",$ladate)) {
		$obj.= " une livraison " ;
	}
	*/

	if(preg_match("/ 08:00:00$/",$ladate))	{
		$heure="9h - 13h";
	} elseif(preg_match("/ 14:00:00$/",$ladate))	{
		$heure="après-midi";
	}	elseif(preg_match("/ 17:00:00$/",$ladate))	{
		$heure="16h à 20h";
	} elseif(preg_match("/ 18:00:00$/",$ladate))	{
		$heure="18h à 22h";
	} else {
		$heure="";
	}
	
	$obj.= " le " .datefr($ladate) .", " .$heure;
	$headers ='From: ' .$from ."\n";
	$headers .='Reply-To: ' .$from ."\n";
	$headers .= "Content-type: text/html; charset= UTF-8\n";

if($voiture==0) {
	$voiture="non";
} elseif($voiture==1) {
	$voiture="oui";
}
	
	$txt="
<img style=\"float: left\" src=\"http://p2r.ch/images/reminder.jpg\">
<p>
Bonjour, $lenom

Votre inscription pour une demi-journée à coller sur votre frigo:

<strong>Date: " .datefr($ladate) .", " .$heure ."</strong>
Nombre de personnes: $np
Je propose un co-voiturage: $voiture


Remarques: $remarques

A bientôt!
";
$txt=nl2br($txt);
		$couriel=mail($lemail, $obj , $txt, $headers);
 
		if(!$couriel) {
		echo "Il y a eu un probl&egrave;me lors de l'envoi du mail, merci de contacter <a href=\"mailto:" .$from ."?subject=" .$obj ."\">" .$from ."</a>";
		exit;
		}


##envoi mail notification admin demijournees@cocagne.ch
$txt="
<br>
Notification administration nouvelle DJ 
<br>
###################<br><br>
" .$txt ."

email: " .$lemail;
		$couriel=mail(ADMINMAIL, $obj ." - notification administration" , $txt, $headers);
		
		if(!$couriel) {
		echo "Il y a eu un probl&egrave;me lors de l'envoi du mail, merci de contacter <a href=\"mailto:" .$from ."?subject=" .$obj ."\">" .$from ."</a>";
		exit;
		}

	
#on redirige l'usager sur la liste des demi-journées	

	header("Location: ".CHEMIN .'demijournees/'');	
	?>
