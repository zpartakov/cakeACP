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
echo "Voici vos demi-journées prévues<br>";
###############################################################
/* Output a list of entries the user can choose (onclick=js submit) = default */
 

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
//echo $sqlUserN;#tests
# exit;
echo "<br><a href=\"http://" .$_SERVER["HTTP_HOST"] .CHEMIN ."demijournees/\">Retour aux inscriptions</a> | <A href=\"javascript:window.print()\">Imprimer mes inscriptions</A><br>";
	
if($sqlUserN>0) {
	echo "<table><tr><th>Date</th><th>Quand?</th><th>Remarques</th></tr>";
	$j=0;
	while($j<$sqlUserN){
		echo "<tr>";
		$date = mysql_result($sqlUser,$j,"date");
		$rem = mysql_result($sqlUser,$j,"rem");
$rem=utf8_encode($rem);


	if(preg_match("/ 08:00:00$/",$date))	{
		$heure="matin";
	}elseif(preg_match("/ 14:00:00$/",$date))	{
		$heure="après-midi";
	}	elseif(preg_match("/ 17:00:00$/",$date))	{
		$heure="soir";
		
	}elseif(preg_match("/ 18:00:00$/",$date))	{
				$heure="livraison";
		
	}else {
		$heure="";
	}

		echo "<td>" .datefr($date) ."</td><td>" .$heure ."</td><td>";
if(strlen($rem)>1){
echo "<em> (" .utf8_decode($rem) .")</em>";
}
echo "</td><td><a href=\"desinscription?date=".$date."\">Désinscription</a></td>";
echo "</td></tr>";
		$j++;
	}
	echo "</table>";
}

echo "<br><a href=\"../demijournees\">Retour aux inscriptions</a> | <A href=\"javascript:window.print()\">Imprimer mes inscriptions</A>";	
	?>
