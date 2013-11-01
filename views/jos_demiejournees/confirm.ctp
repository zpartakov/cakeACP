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
echo "<br><br><a href=\"http://" .$_SERVER["HTTP_HOST"] ."/cms/static/demijournees/index.php?utilisateur=" .$utilisateur ."\">Retour aux inscriptions</a>";
exit;
}
	echo "
	  Si vous êtes plusieurs personnes à venir travailler, merci de spécifier combien.
      <br><br>

       Si vous vous êtes trompé ou si vous voulez annuler une inscription, vous
devez cliquer une nouvelle fois sur la case ou votre nom apparaît.
       
       <br><br><em>Dans le champs \"remarques\", vous pouvez dire à quelle heure vous venez et vos éventuels commentaires</em></br>";
	$date=$ladate; $mesheures="";
		if(preg_match("/ 08:00:00$/",$date))	{
		$heure="matin";
	}elseif(preg_match("/ 14:00:00$/",$date))	{
		$heure="après-midi";
	}	elseif(preg_match("/ 17:00:00$/",$date))	{
		$heure="soir";
		
	}elseif(preg_match("/ 18:00:00$/",$date))	{
				$heure="livraison";
		$mesheures="Merci de préciser dans les remarques quelle tranche horaire pour votre livraison:<br>
		12h30 -13h30, 13h30-14h30, 14h30-15h30<br>";
	}else {
		$heure="";
	}
	

	echo "<br>Je réserve pour le <strong>" .datefr($ladate) .", " .$heure."</strong><br>";
	echo $mesheures;
	echo "<form id=\"form1\" name=\"form1\" method=\"post\"
     action=\"insert\">";
	echo "<input type=\"hidden\" name=\"ladate\" value=\"" .$ladate ."\">";
	#todo: change date format for a human readable
	echo "<table><tr><th>Nombre de personnes</th><th>Remarques</th></tr>";
	echo "<tr><td>
<select name=\"np\" size=\"7\" style=\"width: 70px\">
<option selected>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
</select>
</td><td>
<textarea name=\"remarques\" style=\"width: 370px; height: 100px\"></textarea>
</td></tr>
<tr><td>
<input type=\"reset\">
</td><td>
<input type=\"submit\">
</td></tr>
</table>
</FORM>";
	
	?>
