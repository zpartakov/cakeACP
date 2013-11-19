<style>
td {
padding: 3px;
border: thin solid;
}
</style>
<script>
function goBack()
  {
  window.history.go(-1)
  }
</script>
<?php
/*
 * confirmation of registration step 1, display user a list of items
*/
$this->pageTitle="Mes demi-journées";

App::import('Lib', 'functions'); //imports app/libs/functions

//Configure::write('debug', 2);

$utilisateur=$session->read('Auth.User.username');
$ladate=$_POST['ladate'];

#get the user name
$sql="SELECT *
FROM `users`
WHERE `username` LIKE '" .$utilisateur ."'";

//echo $sql;
$utilisateurName=mysql_result($sql,0,'name');

#check if user is already registred
$sqlDoublon="
SELECT * FROM `jos_demiejournees_details` WHERE  
user LIKE '$utilisateur' AND 
date LIKE '$ladate'
";
$sqlDoublon=mysql_num_rows(mysql_query($sqlDoublon));
#echo "<hr>Recherche doublon: " .$sqlDoublon ."<hr>"; //tests
if($sqlDoublon>0){
echo "Vous êtes déjà inscrit pour cette demi-journée!<br>";
echo "<br><a href=\"desinscription?date='" .$ladate ."'\">Me désinscrire</a>";
echo "<br><br><a href=\"http://" .$_SERVER["HTTP_HOST"] .CHEMIN."\">Retour aux inscriptions</a>";
exit;
}
	echo "Si vous vous êtes trompé ou si vous voulez annuler une inscription, utilisez le bouton <button style=\"\" onclick=\"goBack()\">Retour</button>
       <br><em>Dans le champs \"remarques\", vous pouvez mettre vos éventuels commentaires</em></br>";
	$date=$ladate; $mesheures="";
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
	

	echo "<p style=\"margin-top: 1em; margin-bottom: 2em\">Je réserve pour le <strong>" .datefr_short($ladate) ."</strong></p>";
	echo "<form id=\"form1\" name=\"form1\" method=\"post\"
     action=\"insert\">";
	echo "<input type=\"hidden\" name=\"ladate\" value=\"" .$ladate ."\">";
	#todo: change date format for a human readable
	echo "<table><tr><th>Nombre de personnes</th><th>Co-voiturage</th><th>Remarques</th></tr>";
	echo "<tr><td>
<select name=\"np\" size=\"7\" style=\"width: 70px\">
<option selected>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
</select>
</td>
<td>Voiture à disposition pour le co-voiturage?<br/><br/>
<input name=\"voiture\" type=\"radio\" value=\"0\" checked> non
<input name=\"voiture\" type=\"radio\" value=\"1\"> oui
</td>
<td>
<textarea name=\"remarques\" style=\"width: 270px; height: 50px\"></textarea>
</td></tr>
<tr>
<td>
<input type=\"reset\">
</td>
<td colspan=\"2\">
<input type=\"submit\">
</td></tr>
</table>
</FORM>";
	
	?>
