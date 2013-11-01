<?php
/*
 * functions out of php core
 * 
 * */
function note($note){
	//echo $note;
	$prioritecolor=array("white","#FFD5D5","#FAB1B1","#F87676","#CDF3CD","#A5F9A5","#71F871");
		$bgcolor= $prioritecolor[$note];
		return ($bgcolor); 
		//print_r($prioritecolor);
	}
function titre_recette($id) {
	$sql="SELECT titre FROM recettes WHERE id=".$id;
	$sql=mysql_query($sql);
	echo mysql_result($sql,0,'titre');
}

/*
 * display n randomized recipes
 */
function random_recipes($nb,$role) {
	
	$offset_result = mysql_query( "
			SELECT FLOOR(RAND() * COUNT(*)) AS `offset` FROM `recettes` ");
	
	
	$offset_row = mysql_fetch_object( $offset_result );
	$offset = $offset_row->offset;
	
	//echo "role: " .$role;
	
	if($role=="") {
		$condition =" WHERE private=0 ";
	} else {
		$condition ="";
		
	}
	
	$sql=" SELECT * FROM `recettes` " .$condition ."LIMIT $offset, ".$nb;
	//echo $sql; exit;
	$resultran = mysql_query($sql);
	
	
	$i=0;
	if(mysql_num_rows($resultran)<$nb) {
		random_recipes($nb);
	}
	echo "<table>";
	while($i<mysql_num_rows($resultran)) {
		recette_link(mysql_result($resultran, $i, 'id'));
		$i++;
	}
	echo "</table>";

}
/*
 * for a given recipe, make a table with a link on view recipe
 */
function recette_link($id){
	$query="SELECT * FROM recettes WHERE id=".$id;
	$result=mysql_query($query);
	$titre_recette=mysql_result($result, 0, 'titre');
	echo "<tr>";
	echo "<td>";
	echo "<a href=\"/recettes2/recettes/view/" .mysql_result($result, 0, 'id') ."\">";
	echo $titre_recette;
	echo "</a>";

	echo "</td><td>";
	echo "<a href=\"/recettes2/recettes/view/" .mysql_result($result, 0, 'id') ."\">";

	echo "<img style=\"width: 100px\" class=\"rounded\" src=\"/recettes2/img/pics/";
	echo mysql_result($result,0,'pict');
	echo "\"/>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
}
/*
 * fonction to find children linked recipes
 * */

function recettes_liees($id) {
	$sql="
	SELECT * FROM recettes AS r, linked_recettes AS lr 
	WHERE (lr.recette_id=".$id ." AND r.id=lr.recettes_id) 
	GROUP BY r.titre
	ORDER BY r.titre";
	
	//echo $sql;
	$sql=mysql_query($sql);
	if(mysql_num_rows($sql)>0) {
	echo "<h2>Recettes liées</h2>";	
	$i=0;
	while($i<mysql_num_rows($sql)) {
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,$i,'r.id')."\">".mysql_result($sql,$i,'r.titre')."</a></li>";
	$i++;
	}	
	}
}

function recettes_parentes($id) {
$sql="
SELECT * FROM recettes AS r WHERE id = (SELECT lr.recette_id FROM linked_recettes AS lr
WHERE (lr.recettes_id=".$id ."))
GROUP BY r.titre
ORDER BY r.titre";
$sql=mysql_query($sql);
	if(mysql_num_rows($sql)>0) {
		echo "<h2>Recette parente</h2>";
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,0,'r.id')."\">".mysql_result($sql,$i,'r.titre')."</a></li>";
	}
}
/*
 * reverse fonction to find parents linked recipes
 * */
function recettes_liees2($id) {
	$sql="
	SELECT * FROM linked_recettes AS lr,  recettes AS r
	WHERE lr.recettes_id=".$id ." AND r.id=lr.recettes_id";
	$sql=mysql_query($sql);
	if(mysql_result($sql,0,'r.id')!=$id) {
		echo "<li><a href=\"/recettes2/recettes/view/".mysql_result($sql,0,'r.id')."\">".mysql_result($sql,0,'r.titre')."</a></li>";
	}
recettes_liees(mysql_result($sql,0,'lr.recette_id'),$id);

}

/* ############# HTML ############## */
/* function to extract urls from variables */
function urlize($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = preg_replace("/(https:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	$chaine=preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	//now replace emails
	if(!preg_match("/[a-zA-Z0-9]*\.[a-zA-Z0-9]*@/",$chaine)){
	#$chaine = ereg_replace('[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_/-])*','<a href="mailto:\\0">\\0</a>',$chaine);
	#$chaine = preg_replace('/[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);
	}else {
	$chaine = preg_replace('/[-a-zA-Z0-9]*\.?[-a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);	
	}

	echo nl2br($chaine);
}
function melto($chaine) { 
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = "<a href=\"mailto:" .$chaine ."\">".$chaine ."</a>";
	echo $chaine;
}
/*
function generate_password($length){
     // A List of vowels and vowel sounds that we can insert in
     // the password string
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
     return substr($pass,  0,  $length);
 
}
*/
function lignes_vides($txt,$id) {
	/*
	 * une fonction pour supprimer les espaces blancs à l'affichage,
	 * et mettre un saut de ligne HTML à la place des retours chariots restants
	 */
	$txt=preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $txt);
	/*
	 * si majuscule, ajouter un saut de ligne avant
	 */
	$txt=preg_replace("/\n([A-Z])/", "\n\n$1", $txt);
/*
 * put a new line only for "old" recipes before wysiwig editor
 */	
	if($id<12343) {
		$txt=nl2br($txt);
	}
	$txt=stripslashes(stripslashes($txt));
	
	return $txt;
}

/*
 * fonctions for demi-journees
 */
//calcule le nombre de jours à afficher; à modifier dans cake si nécessaire
function njoursaffiches() {
	$njoursaffiches="SELECT n FROM cocagne_defaults WHERE lib LIKE 'def_jours_affiches'";
	$njoursaffiches=mysql_query($njoursaffiches);
	$def_jours_affiches=mysql_result($njoursaffiches,0,'n');
	define("def_jours_affiches", $def_jours_affiches); //on definit une constante globale
}

//calcule le nombre de jours minimum pour s'inscrire; à modifier dans cake si nécessaire
function delaiinscription() {
	$njoursaffiches="SELECT n FROM cocagne_defaults WHERE lib LIKE 'DJ_delai_minimum_inscription'";
	$njoursaffiches=mysql_query($njoursaffiches);
	$def_jours_affiches=mysql_result($njoursaffiches,0,'n');
	define("DJ_delai_minimum_inscription", $def_jours_affiches); //on definit une constante globale
}
//calcule le nombre de jours minimum pour s'inscrire; à modifier dans cake si nécessaire
function delaiinscriptionlivraison() {
	$njoursaffiches="SELECT n FROM cocagne_defaults WHERE lib LIKE 'DJ_delai_minimum_inscription_livraison'";
	$njoursaffiches=mysql_query($njoursaffiches);
	$def_jours_affiches=mysql_result($njoursaffiches,0,'n');
	define("DJ_delai_minimum_inscription_livraison", $def_jours_affiches); //on definit une constante globale
}



#convertir date française DD-MM-YYYY au format MySQL YYYY-MM-DD
function datefr2mySQL($date) {
	$split = explode(".",$date);
	$annee = $split[2];
	$mois = $split[1];
	$jour = $split[0];
	return "$annee"."-"."$mois"."-"."$jour";
}

#convertir date MySQL YYYY-MM-DD  au format français DD-MM-YYYY
function datemySQL2fr($date) {
	$split = explode("-",$date);
	$annee = $split[0];
	$mois = $split[1];
	$jour = $split[2];
	return "$jour"."-"."$mois"."-"."$annee";
}

function date_mysql_to_timestamp($date) {
	#if (!preg_match('/(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)/',$date,$r)){
	#return false;
	#}
	$ladate=explode("-",$date);
	return mktime(0, 0,0,$ladate[2],$ladate[3],$ladate[1] );
}
function verifieDate($date) {
	#2007-06-22
	#checkdate(m-d-y);
	#note: for a strange reason you need firstly to reconstruct the format of date var
	$ladate1=explode("-",$date);
	$month=preg_replace("/^0/","",$ladate1[1]);
	$day=preg_replace("/^0/","",$ladate1[2]);
	$year=$ladate1[0];
	return checkdate($month, $day, $year);
}


/* VARIOUS SQL QUERIES
 */
function execute_sql($sql){
	$result=mysql_query($sql);
	if(!$result) {
		echo "erreur mysql: " .mysql_error(); exit;
	}

	return ($result);
}

function probleme() {
	echo 	"<br><input type=\"button\" name=\"cancel\" value=\"Retour\" onClick=\"javascript:history.back();\">";
	exit;
}

/****
 * Titre: Date format MySQL en date Francaise
* Auteur: FreeCreator
* Email: freecreator59@hotmail.com
* Url:
* Description: Cette fonction permet de convertir une date au format MySQL en date Francaise.

Elle retourne la date en francais avec heures et minutes
****/
function datefr($date_sql){
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


	if (substr($date_sql[1],0,1) == '0' ) // On verifie si le 1er caractere est 0 dans le numero du mois
	{
		// si oui alors on supprime le 1er caractere
		$date_sql[1] = substr($date_sql[1],1,strlen($date_sql[1]) -1);
	}

	$heure = $heure_sql[0]; // La variable de l'heure
	$minutes = $heure_sql[1]; // La variable des minutes
	$secondes = $heure_sql[2]; // la variable des secondes

	$annee = $date_sql[0]; // La variable des annees
	$num_mois = $date_sql[1]; // La variable du numero du mois
	$nom_mois = $m_fr[$num_mois]; // La variable du mois en francais
	$num_jour = $date_sql[2]; // Le numero du jour
	$nom_jour = $j_fr[date("l", mktime(0,0,0,$num_mois,$num_jour,$annee))]; // Le nom du jour en francais

	#  $date = "Le $nom_jour $num_jour $nom_mois $annee"; // On forme la date
	$date = "$nom_jour $num_jour $nom_mois $annee"; // On forme la date
	$heure = "$heure:$minutes:$secondes"; // On forme l'heure

	#$date_fr= $date.' à '.$heure;
	$date_fr= $date;

	//retour de cette variable
	return $date_fr;
}

/* ######### AJOUTS fradeff www.akademia.ch lundi 11 juin 2007, 21:09:59 (UTC+0200) ###### */

	#renvoyer la date complète mais pas les heures et minutes
	function datefr_short($date_sql){
	// Declaration du tableau des noms de jours en Francais
		//-------- ici
	$j_fr[Sunday]     = "dimanche";
		$j_fr[Monday]     = "lundi";
		$j_fr[Tuesday]     = "mardi";
		$j_fr[Wednesday]    = "mercredi";
		$j_fr[Thursday]    = "jeudi";
		$j_fr[Friday]     = "vendredi";
		$j_fr[Saturday]     = "samedi";

		// Declaration du tableau des noms de jours en Francais
		$m_fr[1]    = "janvier";
		$m_fr[2]    = "février";
		$m_fr[3]    = "mars";
		$m_fr[4]    = "avril";
		$m_fr[5]    = "mai";
		$m_fr[6]    = "juin";
		$m_fr[7]    = "juillet";
		$m_fr[8]    = "août";
		$m_fr[9]    = "septembre";
		$m_fr[10] = "octobre";
		$m_fr[11] = "novembre";
		$m_fr[12] = "décembre";

		$la_date    = explode(' ', $date_sql); // on decompose la date SQL
		$heure_sql= explode(':',$la_date[1]); // On prend la partie heure
		$date_sql    = explode('-',$la_date[0]); // On prend la partie date


		if (substr($date_sql[1],0,1) == '0' ) // On verifie si le 1er caractere est 0 dans le numero du mois
		{
				// si oui alors on supprime le 1er caractere
			$date_sql[1] = substr($date_sql[1],1,strlen($date_sql[1]) -1);
		}

		$heure = $heure_sql[0]; // La variable de l'heure
		$minutes = $heure_sql[1]; // La variable des minutes
		$secondes = $heure_sql[2]; // la variable des secondes

		$annee = $date_sql[0]; // La variable des annees
		$num_mois = $date_sql[1]; // La variable du numero du mois
		$nom_mois = $m_fr[$num_mois]; // La variable du mois en francais
		$num_jour = $date_sql[2]; // Le numero du jour
		$nom_jour = $j_fr[date("l", mktime(0,0,0,$num_mois,$num_jour,$annee))]; // Le nom du jour en francais

		#  $date = "Le $nom_jour $num_jour $nom_mois $annee"; // On forme la date
		$date = "$nom_jour $num_jour $nom_mois $annee"; // On forme la date
		$date_fr= $date;

		//retour de cette variable
		return $date_fr;
	}

	#renvoyer le nom du jour
	function jourfr_short($date_sql){
	// Declaration du tableau des noms de jours en Francais
		//-------- ici
	$j_fr[Sunday]     = "Dimanche";
	$j_fr[Monday]     = "Lundi";
	$j_fr[Tuesday]     = "Mardi";
	$j_fr[Wednesday]    = "Mercredi";
	$j_fr[Thursday]    = "Jeudi";
	$j_fr[Friday]     = "Vendredi";
	$j_fr[Saturday]     = "Samedi";

	#$la_date    = explode(' ', $date_sql); // on decompose la date SQL
	$date_sql    = explode('-',$date_sql); // On prend la partie date
	$annee = $date_sql[0]; // La variable des annees
	$num_mois = $date_sql[1]; // La variable du numero du mois

	$num_jour = $date_sql[2]; // Le numero du jour
	$nom_jour = $j_fr[date("l", mktime(0,0,0,$num_mois,$num_jour,$annee))]; // Le nom du jour en francais

	//retour de cette variable
	return $nom_jour;
	}


	#renvoyer l'heure seulement
	function datefr_hour($date_sql){
	$la_date    = explode(' ', $date_sql); // on decompose la date SQL
	$heure_sql= explode(':',$la_date[1]); // On prend la partie heure
	$heure = $heure_sql[0]; // La variable de l'heure
	$minutes = $heure_sql[1]; // La variable des minutes
	$heure = "$heure:$minutes"; // On forme l'heure<
	//retour de cette variable
	return $heure;
	}
	
	/*
	 * Points de distribution
	 */
	
	function pdd_user($userpdd) {
		
		$sql="
		SELECT * FROM jos_users_pdds AS jup
		WHERE
		jup.user_id=".$userpdd;
		//echo $sql; exit;
		$sql=mysql_query($sql);
		
		if(!$sql) {
			echo "SQL error DJ: " .mysql_error();
		}
		
		$pdd=mysql_result($sql,0,'jos_pdd_id');
		//echo "PDD: " .$pdd;
		return $pdd;
		
	}
	
	function pdd($pdd){
	$sql="SELECT * FROM jos_pdds ORDER BY PDDTexte";
	$sql=mysql_query($sql); 
	if(!$sql) {
		echo "SQL error DJ: " .mysql_error();
	}
	$i=0;
	echo "Point de distribution&nbsp;<select name=\"pdd\">";
	while ($i<mysql_num_rows($sql)) {
		echo "<option value=\"" .mysql_result($sql, $i,'id') ."\"";
		if($pdd==mysql_result($sql, $i,'id')) {
			echo " selected";
		}
		echo ">";
		
		echo mysql_result($sql, $i,'PDDTexte');
		echo "</option>";
		$i++;
	}
	echo "</select>";
	}
	
	function pdd_show($pdd){
		$sql="SELECT * FROM jos_pdds WHERE id=".$pdd;
		$sql=mysql_query($sql);
		if(!$sql) {
			echo "SQL error DJ: " .mysql_error();
		}
			echo "<a href=\"http://".SERVEUR. CHEMIN ."jos_pdds/view/" 
			.mysql_result($sql, 0,'id')
			."\">"
			.mysql_result($sql, 0,'PDDTexte')
			."</a>";
	}
	
	
	
	function oeufs($user){
	$sql="SELECT * FROM oeufs WHERE user_id=".$user;
	$sql=mysql_query($sql); 
	if(!$sql) {
		echo "SQL error DJ: " .mysql_error();
	}
	$oeufs=mysql_result($sql,0,'oeufs');
	//echo "oeufs: " .$oeufs; exit;
	$i=0;
	echo "Oeufs&nbsp;<select name=\"oeufs\">";
	while ($i<3) {
		echo "<option";
		if($oeufs==$i) {
			echo " selected";
		}
		echo ">";
		echo $i;
		echo "</option>";
		$i++;
	}
	echo "</select>";
	}
	
	function oeufs_show($user){
		$sql="SELECT * FROM oeufs WHERE user_id=".$user;
		$sql=mysql_query($sql);
		if(!$sql) {
			echo "SQL error DJ: " .mysql_error();
		}
		$oeufs=mysql_result($sql,0,'oeufs');
		echo $oeufs;
	}
?>
