<?php
/* desinscription d'un cocagnard à une demi-journée
 * */
function yo($date_sql){
// Declaration du tableau des noms de jours en Francais 
  //-------- ici 
  $j_fr[Sunday]     = "Dimanche"; 
  $j_fr[Monday]     = "Lundi"; 
  $j_fr[Tuesday]     = "Mardi"; 
  $j_fr[Wednesday]    = "Mercredi"; 
  $j_fr[Thursday]    = "Jeudi"; 
  $j_fr[Friday]     = "Vendredi"; 
  $j_fr[Saturday]     = "Samedi"; 
  
  // Declaration du tableau des noms de jours en Francais 
  $m_fr[1]    = "Janvier"; 
  $m_fr[2]    = "Fevrier"; 
  $m_fr[3]    = "Mars"; 
  $m_fr[4]    = "Avril"; 
  $m_fr[5]    = "Mai"; 
  $m_fr[6]    = "Juin"; 
  $m_fr[7]    = "Juillet"; 
  $m_fr[8]    = "Aout"; 
  $m_fr[9]    = "Septembre"; 
  $m_fr[10] = "Octobre"; 
  $m_fr[11] = "Novembre"; 
  $m_fr[12] = "Decembre"; 
  $la_date    = explode(' ', $date_sql); // on decompose la date SQL
  $heure_sql= explode(':',$la_date[1]); // On prend la partie heure
  $date_sql    = explode('-',$la_date[0]); // On prend la partie date
  echo "Mise à jour: " .$date_sql;
}
$utilisateur=$session->read('Auth.User.username');
$ladate=$_GET['date'];
$ladate=preg_replace("/'/","",$ladate);
$ladate=stripslashes($ladate);

//yo($ladate);

//echo $ladate; exit;

#checkutilisateur($utilisateur);
$query="
DELETE FROM `jos_demiejournees_details` WHERE  
user LIKE '$utilisateur' AND 
date LIKE '$ladate'
";
#echo $query; exit;
$db=mysql_query($query);
		if(!$db){
			echo "error mysql: <br>";
			echo "<br>" .$query ."<br>"; //test debug
			echo mysql_error();
		} else {
			
			$ladatefr=date("D, d-m-Y H:i:s", strtotime($ladate));
			$ladatefr=preg_replace("/Mon,/", "Lundi, ", $ladatefr);
			$ladatefr=preg_replace("/Tue,/", "Mardi, ", $ladatefr);
			$ladatefr=preg_replace("/Wed,/", "Mercredi, ", $ladatefr);
			$ladatefr=preg_replace("/Thu,/", "Jeudi, ", $ladatefr);
			$ladatefr=preg_replace("/Fri,/", "Vendredi, ", $ladatefr);
			$ladatefr=preg_replace("/Sat,/", "Samedi, ", $ladatefr);
			$ladatefr=preg_replace("/Sun,/", "Dimanche, ", $ladatefr);
			
			if(preg_match("/08:00:00$/",$ladatefr))	{
				$ladatefr=preg_replace("/08:00:00/", "matin", $ladatefr);
			}
			if(preg_match("/14:00:00$/",$ladatefr))	{
				$ladatefr=preg_replace("/14:00:00/", "après-midi", $ladatefr);
			}
			if(preg_match("/18:00:00$/",$ladatefr))	{
				$ladatefr=preg_replace("/18:00:00/", "livraison", $ladatefr);
			}



					###### on envoie le mail de notification à l'administrateur #########
			$from=ADMINMAIL;
			//$from="fradeff@akademia.ch"; //tests
		$obj="Désinscription demi-journée pour " .$utilisateur ." - date: " .$ladate;
		//	$obj=utf8_decode($obj);
			$headers ='From: ' .$from ."\n";
			$headers .='Reply-To: ' .$from ."\n";
			#$headers .='Content-Type: text/plain; charset=UTF-8';
			//$headers .='Content-Type: text/plain; charset=iso-8859-1\n';
			$headers .='Content-Type: text/plain; charset=UTF-8\n';
			$lenom=utf8_encode($lenom);
			$txt="
		Bonjour, " .$utilisateur ." ###

		S'est désinscrit pour la demi-journée: 

		Date: $ladatefr
		";
//		$txt=utf8_decode($txt);
		$referent=$_SERVER["HTTP_HOST"];
			
				$couriel=mail($from, $obj , $txt, $headers);
		 
				if(!$couriel) {
				echo "Il y a eu un probl&egrave;me lors de l'envoi du mail, merci de contacter <a href=\"mailto:" .$from ."?subject=" .$obj ."\">" .$from ."</a>";
				exit;
				}
		
	
			
			echo "Votre d&eacute;sinscription a bien &eacute;t&eacute; enregistr&eacute;e";
			echo "<br><br><a href=\"http://" .$_SERVER["HTTP_HOST"] .CHEMIN ."demijournees\">Retour aux inscriptions</a>";
}
?>
