<?php
/*1st install then comment!!!*/
$jourL=date("D");
$jour=date("d");
$mois=date("m");
$moisL=date("m");
$annee=date("Y");

$tab_jour = array(1 => 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');


echo "Nous sommes le : " .$jourL .", ".$jour ." " .$mois ." " .$moisL ." " .$annee;
$datel=date("l jS \of F Y h:i:s A",mktime(0,0,0,$mois,$jour,$annee));

$num_jour = date('N');
$nom_jour = $tab_jour[$num_jour];

echo "<br>Soit le :" .$datel ." qui est le jour de semaine : " .$nom_jour ."<br>";

$lastDate="SELECT * FROM `jos_reservations` ORDER BY 'date'";
echo $lastDate;
$lastDate=mysql_query($lastDate);
$lastDateN=mysql_num_rows($lastDate);
if(!$lastDate){
	echo "SQL error: " .mysql_error();
	exit;
}
echo "<br>#hits: " .$lastDateN;
if($lastDateN<1){
$aujourdhui=date("U");
$startday=$aujourdhui+(24*3600);
$test=1;
}else {
	$startday=mysql_result($lastDate,($lastDateN-1),'date');
	
	  $la_date    = explode(' ', $startday); // on decompose la date SQL
  
	  $heure_sql= explode(':',$la_date[1]); // On prend la partie heure
    $heure = $heure_sql[0]; // La variable de l'heure
  $minutes = $heure_sql[1]; // La variable des minutes
  $secondes = $heure_sql[2]; // la variable des secondes
  
  $date_sql    = explode('-',$la_date[0]); // On prend la partie date
    $annee = $date_sql[0]; // La variable des annees
  $num_mois = $date_sql[1]; // La variable du numero du mois
  $num_jour = $date_sql[2]; // Le numero du jour
   #mktime  ($hour, $minute, $second, $month, $day, $year)
	$startday= date("U", mktime($heure, $minutes, $secondes, $num_mois,$num_jour,$annee ));
  
	#$startday=strftime("U",$startday);
	$startday=$startday+(12*3600); //on ajoute 12h à 18h->lendemain à 8h
	$test=0;
}
#echo "<br>Startdate: " .$startday ."<br>test: " .$test; exit; //tests

echo "<br>On commence le : " .date("l jS \of F Y h:i:s A",$startday);
#exit;

/*
####### TEST TO KILL todo TODO later ######

$vide=mysql_query("TRUNCATE TABLE `jos_reservations`");
if(!$vide) {
	echo "Error on sql query: TRUNCATE TABLE `jos_reservations` <br>" .mysql_error();
	}
*/
	$i=0;
while($i<270){
	#on chome le lundi, le mardi, le dimanche: statut=0
	
	######### MATIN ###########
	$ladate=date("Y-m-d"." 08:00:00",$startday); //matin

	#calcul du jour et du statut
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="dimanche"){
		$statut=0;
	} else {
		$statut=1;
	}	
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_reservations` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate ."', '', '3', '$statut', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
	
	######### APRES-MIDI ###########
$ladate=date("Y-m-d"." 14:00:00",$startday); //après-midi
	#calcul du jour et du statut
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="dimanche"){
		$statut=0;
	} else {
		$statut=1;
	}	
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_reservations` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate ."', '', '3', '$statut', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
	
######### SOIR ###########
$ladate=date("Y-m-d"." 17:00:00",$startday);
	#calcul du jour et du statut
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="dimanche"){
		$statut=0;
	} else {
		$statut=1;
	}	
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_reservations` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate ."', '', '3', '$statut', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
######### LIVRAISON ###########
$ladate=date("Y-m-d"." 18:00:00",$startday);
	#calcul du jour et du statut
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="dimanche"){
		$statut=0;
	} else {
		$statut=1;
	}	
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_reservations` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate ."', '', '3', '$statut', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
	$i++; //on increment le compteur
	$startday=$startday+(24*3600); //on ajoute un jour
}
?>
OK pour l'importation: voir avec Claude si c'est OK pour les variables
