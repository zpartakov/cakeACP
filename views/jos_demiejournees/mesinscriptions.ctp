<style>
th, td {
border: thin solid;
padding: 5px;
}
th {
background-color: lightyellow;
}
</style>
<?php
/*
 * list user registrations
 */
//Configure::write('debug', 2);
App::import('Lib', 'functions'); //imports app/libs/functions

$utilisateur=$session->read('Auth.User.username');

$sql="SELECT *
FROM `users`
WHERE `username` LIKE '" .$utilisateur ."'";

//echo $sql;
$checkUser=mysql_query($sql);
if(!$checkUser) {
	echo "Sorry, this user is not allowed or doesn't exist!";
	exit;
}
$utilisateurName=mysql_result($checkUser,0,'name');
#ok l'utilisateur est bien enregistré, on peut continuer
echo "Bonjour " .utf8_encode($utilisateurName) ."<br>";

/* demi-journées à venir */
echo "<h2>Vos demi-journées prévues</h2>";
echo "<em>Pas de désinscription dans les 24h précédant l'inscription</em><br>";

natel_admin();

$aujourdhui=date("Y-m-d");	
$sqlUser="SELECT *
FROM `jos_demiejournees_details`
WHERE `date` >= '" .$aujourdhui ."'
AND `user` LIKE '".$utilisateur ."'
 ORDER BY `date`";
//	echo $sqlUser ."<br>"; #tests
	# exit;
	$sqlUser=mysql_query($sqlUser);
	$sqlUserN=mysql_num_rows($sqlUser);
//echo "#reservations: " .$sqlUserN;#tests
# exit;
echo "<p style=\"margin-top: 10px;\"><a href=\"http://" .$_SERVER["HTTP_HOST"] .CHEMIN ."demijournees/\">Retour aux inscriptions</a> | <A href=\"javascript:window.print()\">Imprimer mes inscriptions</A></p><br>";
	
if($sqlUserN>0) {
	echo "<table><tr><th>Date</th><th>Quand?</th><th>Remarques</th><th>Voiture?</th><th>Désinscription</th></tr>";
	$j=0;
	
	while($j<$sqlUserN){

		echo "<tr>";
		$date = mysql_result($sqlUser,$j,"date");
		$voiture = mysql_result($sqlUser,$j,"voiture");
		if($voiture==1){
			$voiture="oui";
		}else{
			$voiture="non";
		}
		$rem = mysql_result($sqlUser,$j,"rem");
		if(preg_match("/ 08:00:00$/",$date))	{
			$heure="9h - 13h";
		} elseif(preg_match("/ 14:00:00$/",$date))	{
			$heure="après-midi";
		}	elseif(preg_match("/ 17:00:00$/",$date))	{
			$heure="16h à 20h";
		} elseif(preg_match("/ 18:00:00$/",$date))	{
			$heure="18h à 22h";
		} else {
			$heure="";
		}
		echo "<td>".datefr($date) ."</td><td>" .$heure ."</td><td>";
		if(strlen($rem)>1){
		echo "<em> (" .utf8_decode($rem) .")</em>";
		}
		echo "</td><td>";
		echo $voiture;
		echo "</td><td>";
		
	
			/* pas possible de se desinscrire moins de 24h à l'avance */
			$aujourdhuiUnix=date_long_mysql_to_timestamp(date("Y-m-d h:i:s"));
			$aujourdhuiUnix=$aujourdhuiUnix+(24*3600*100);			
			$dateUnix=date_long_mysql_to_timestamp($date);
/*
			echo "Date: " .$date; //tests
			echo "<br>aujourdhuiUnix: " .$aujourdhuiUnix; //tests
			echo "<br>dateUnix:       " .$dateUnix; //tests
			echo "<br>Ecart: " .($dateUnix-$aujourdhuiUnix) . " = heures: " .($dateUnix-$aujourdhuiUnix)/(24*3600);
			echo "<br>";		
	*/		
			if($dateUnix>$aujourdhuiUnix) {
				echo "<a href=\"desinscription?date=".$date."\">Désinscription</a>";
			} else {
				echo "&nbsp;";
			}
		echo "</td>";
		echo "</tr>";
		$j++;
	}
	echo "</table>";
}

/* demi-journées passées */
echo "<hr style=\"margin-top: 20px;margin-bottom: 20px;\" /><h2>Toutes vos demi-journées cette année</h2>";
$aujourdhui=date("Y-m-d");
$sqlUser="SELECT *
FROM `jos_demiejournees_details`
WHERE `date` >= '" .date("Y")."-01-01'
AND `user` LIKE '".$utilisateur ."'
ORDER BY `date`";
//	echo $sqlUser ."<br>"; #tests
# exit;
$sqlUser=mysql_query($sqlUser);
$sqlUserN=mysql_num_rows($sqlUser);
//echo $sqlUserN;#tests
# exit;

$totaldj=0;
if($sqlUserN>0) {
	echo "<table><tr><th>Date</th><th>Quand?</th><th>Réalisé?</th></tr>";
	$j=0;
	while($j<$sqlUserN){
		echo "<tr>";
		$date = mysql_result($sqlUser,$j,"date");
		$ok = mysql_result($sqlUser,$j,"ok");
		if(preg_match("/ 08:00:00$/",$date))	{
			$heure="matin";
		} elseif(preg_match("/ 14:00:00$/",$date))	{
			$heure="après-midi";
		}	elseif(preg_match("/ 17:00:00$/",$date))	{
			$heure="soir";
				
		} elseif(preg_match("/ 18:00:00$/",$date))	{
			$heure="livraison";
				
		} else {
			$heure="";
		}
		echo "<td>" .datefr($date) ."</td><td style=\"text-align: right\">" .$heure ."</td>";
		echo "<td style=\"text-align: right\">";
			echo $ok;
			$totaldj=$totaldj+$ok;
		echo "</td>";

		echo "</tr>";
		$j++;
	}
	echo "<tr><td><strong>Total</strong><td colspan=\"2\" style=\"text-align: right\">" .$totaldj ."</td></tr>";
	echo "</table>";
}



echo "<br><a href=\"../demijournees\">Retour aux inscriptions</a> | <A href=\"javascript:window.print()\">Imprimer mes inscriptions</A>";	
	?>
