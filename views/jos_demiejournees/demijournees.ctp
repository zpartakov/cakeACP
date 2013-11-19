<style>
p {
padding: 3px;
margin-bottom: 2px;
}
/* css for displaying tooltip - infobulles, see functions.php */
a.tooltip em {
    display:none;
}
a.tooltip:hover {
    border: 0;
    position: relative;
    text-decoration:none;
}
a.tooltip:hover em {
    z-index: 500;
    font-style: normal;
    display: block;
    position: absolute;
    top: 20px;
    left: 10px;
    padding: 15px;
    color: #000;
    border: 1px solid #bbb;
    background: #ADD8E6;
    width: 300px;
    -moz-border-radius : 2em 1em; -webkit-border-radius : 2em 1em;
}
a.tooltip:hover em span {
    position: absolute;
    top: -7px;
    left: 15px;
    height: 7px;
    width: 11px;
    margin:0;
    padding: 0;
    border: 0;
}
</style>
<?php 
/*
 * registration to demi-journees init (display list)
*/

$this->pageTitle="Mes demi-journées";

App::import('Lib', 'functions'); //imports app/libs/functions

$def_new="3"; //valeur défaut pour le nombre de mois ajoutés
$nbplacesDef="6"; //valeur par défaut pour le nombre maximum de places

# jours et heures#
$aujourdhui=date("Y-m-d 08:00"); //calcule la date courante
$aujourdhuipm=date("Y-m-d 14:00"); //calcule la date courante
$aujourdhuisoir=date("Y-m-d 17:00"); //calcule la date courante
$def_jours_affiches=60; //nombre de jours à venir affichés dans les réservations
//heures
$heures=array(
		"08",
		"14",
		"17"
);
$heures_libelle=array(
		"9h - 13h",
		"16h à 20h",
		"18h à 22h"
);
$size=count($heures);

//jours interdits
$jours_no="Monday;Tuesday;Wednesday;Friday;Sunday;";

?>
<div style="font-size: 2em"><?php echo $this->pageTitle;?></div>
<p style="margin-top: 1em; margin-bottom: 1em">
<?php echo $html->link(__('-> Je veux m\'inscrire en liste d\'attente', true), array('controller'=>'listeattentes','action'=>'ajout')); 
natel_admin();
?>
</p>
<?php 
/* Output a list of entries the user can choose (onclick=js submit) = default */
$aujourdhui=date("Y-m-d"); $aujourdhuinix=date("U");

njoursaffiches(); //nombre de jour affichés, définis dans les configurations par défaut
delaiinscription(); //nombre de jours minimum pour s'inscrire
delaiinscriptionlivraison(); //nombre de jours minimum pour s'inscrire

#maintenance
$sqlmaintenance="SELECT * FROM dj_maintenances ORDER BY id desc";
$sqlmaintenance=mysql_query($sqlmaintenance);
if(!$sqlmaintenance) {
	echo "SQL error: " .mysql_error(); exit;
}

$date_stop=mysql_result($sqlmaintenance,0,'stop');
$actif=mysql_result($sqlmaintenance,0,'actif');
//echo "actif?: " .$actif; exit; //tests
//on est en mode maintenance
if($actif=="1") {
	$query  = "
	SELECT * FROM jos_demiejournees
	WHERE jos_demiejournees.date >'" .$aujourdhui ." 18:00:00'
	AND jos_demiejournees.date < '" .$date_stop ."'
	AND statut=1
	ORDER BY jos_demiejournees.date LIMIT 0," .($def_jours_affiches*4); //on multiplie le nbre de jours par 4 (am-pm-soir-livr), changer cette constante dans les defaults
	//normal
} else {
	//requete principale: le plus grand (>) et 18h pour obliger à chercher à partir du lendemain
	$query  = "
	SELECT * FROM jos_demiejournees
	WHERE jos_demiejournees.date >'" .$aujourdhui ." 18:00:00'
	AND statut=1
	ORDER BY jos_demiejournees.date LIMIT 0," .($def_jours_affiches*4); //on multiplie le nbre de jours par 4 (am-pm-soir-livr), changer cette constante dans les defaults

}
//echo $query; exit; //tests
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}
$numberOfRows = mysql_num_rows($result);
$letexte="
<b>Cliquez avec votre souris sur la petite case blanche qui vous intéresse</b>, puis suivez les indications.
Vous aurez un message de confirmation dans votre boîte aux lettres.<br>
<table border=\"0\">
<tr>
<td>        <em>S'il n'y a pas de petite case à cocher, il n'est pas ou plus possible de s'inscrire</em>
</td>
<td>       <div style=\"" .$mesinscriptions ."\">
<form id=\"form2\" name=\"form2\" method=\"post\" action=\"http://".SERVEUR .CHEMIN."jos_demiejournees/mesinscriptions\"><input type=\"submit\" value=\"Mes inscriptions\" style=\"" .$mesinscriptions ."\"></form></div>
</td>
</tr>
</table>

 
<strong>Je m'inscris pour le...</strong>
<br>
<form id=\"form1\" action=\"http://".$_SERVER['HTTP_HOST'] .CHEMIN."jos_demiejournees/confirm\" name=\"form1\" method=\"post\">
";
echo $letexte;

//now loop on dates

$i=0; $icell=1; $iligne=1;
$lastrecord=mysql_num_rows($result)-1;
while($i<mysql_num_rows($result)){
	$juser="";
	
	$thisId = mysql_result($result,$i,"id");
	$thisDate = mysql_result($result,$i,"date");
	$dateCourt=datefr_short($thisDate);
	$thisDatenix=strtotime($thisDate); //date au format unix pour calculs sur les dates
	$thisREMARQUES = mysql_result($result,$i,"REMARQUES");
	$nplaces=mysql_result($result,$i,"nplaces");
	$statut=mysql_result($result,$i,"statut");
	$motif=str_replace("-",".",$thisDate);
	$motif=str_replace(":",".",$motif);
	$motif=str_replace(" ",".",$motif);
	if (($iligne%2)==0) {
		$bgColor = "lightyellow";
	} else { $bgColor = "#D4FF8F";
	}
	
	if($statut==1 && $nplaces>0){ //on affiche que si le flag statut = 1 & on demande plus d'une personne
		echo "<p style=\"padding: 13px; background-color: " .$bgColor ."\">";
		
		
		echo $dateCourt;

		if(preg_match("/jeudi/",$dateCourt)) {
			echo "&nbsp;<em>- préparation des paniers</em>&nbsp;";
		} elseif(preg_match("/samedi/",$dateCourt)) {
			echo "&nbsp;<em>- travail au champ</em>&nbsp;";
		}
		
		/*
		 * inscription
		*/
		

		
		#donnees cocagnard/e/s
		$cocagnardes=""; #initialisation de la variable
		$sqlUser="SELECT *
		FROM `jos_demiejournees_details`
		WHERE `date` = '".$thisDate ."' ORDER BY user";
		#$cocagnardes.= "<br>".$sqlUser."<br>"; #tests
		
		$sqlUser=mysql_query($sqlUser);
				
		#calcul du nombre de places
		$sqlUser2="SELECT SUM(npers) AS np, voiture, rem AS remarques 
		FROM `jos_demiejournees_details`
		WHERE `date` = '".$thisDate ."' ORDER BY user";
		#$cocagnardes.= "<br>".$sqlUser2."<br>"; #tests
		$sqlUser2=mysql_query($sqlUser2);
		$sqlUserN=mysql_result($sqlUser2,0,'np');
		


		
		$x="<input type=\"hidden\" name=\"utilisateur\" value=\"" .$session->read('Auth.User.username') ."\">";
		$x.="<input type=\"checkbox\" name=\"ladate\" value=\"" .$thisDate ."\" ";
		$x.= "title=\"Je m'inscris pour le " .datefr_short($thisDate) .", " .datemySQL2fr(preg_replace("/ .*/","",$thisDate)) ." ".preg_replace("/:/","h",preg_replace("/...$/","",preg_replace("/^.* /","",$thisDate))) ."\"";
		$x.= " onclick=\"document.form1.submit()\">";
		//$x.="<input type=\"submit\" value=\"s'inscrire\"><br>";
		$x.="<br>";
		
		if($sqlUserN>=$nplaces){ //le compte est bon ou plus
			$color="#00FF00";
			/*
			 * on affiche pas la possibilité de s'inscrire
			 */
			$x="";
			} elseif(($nplaces-$sqlUserN)==1){ //manque un
				$color="#99ff00";
			} elseif(($nplaces-$sqlUserN)==2){ //manque 2
				$color="3ff9900";
			} elseif(($nplaces-$sqlUserN)>=3){ //manque 2
				$color="orange";	//rouge
		}
		
		echo "&nbsp;&nbsp;&nbsp;" .$x;
		
		
		if($sqlUserN>0) {
			/*
			 * il y a des inscrits, on affiche lesquels
			*/
					
			$j=0;
				while($j<$sqlUserN){
					$thisUser = mysql_result($sqlUser,$j,"user");
					$voiture = mysql_result($sqlUser,$j,"voiture");
					$rem = mysql_result($sqlUser,$j,"rem");
						
					$username="SELECT * FROM users WHERE username LIKE '" .$thisUser ."'";
					$usernameQ=mysql_query($username);
					if(!$usernameQ) {
						echo "<br>SQL error:<br>" .mysql_error() ."<br>";
					}
					$username=mysql_result($usernameQ,0,'name');
					$useremail=mysql_result($usernameQ,0,'email');
			
					#$juser.=$thisUser;
					if($username=="Administrator") {
						$juser.=$thisNote;
					} else {
						$juser.="<a title=\"envoyer un email\" href=\"mailto:" .$useremail ."\" class=\"tooltip\">" .utf8_encode($username);			
				if(strlen($rem)>0) {
					$juser.='<em><span></span>'.$rem.'</em>';
				}
						if($voiture=="1") {
				$juser .="<img src=\"".CHEMIN."img/covoiturage.jpg\" style=\"padding: 5px; width: 25px\" alt=\"co-voiturage proposé\" title=\"co-voiturage proposé\">";
						
			
						}
					}
					
					$juser.="</a>&nbsp;|&nbsp;";
						
					
					$j++;
				}
				echo "<div style=\"margin-left: 20%; margin-right: 10%; padding: 5px; background-color: " .$color ."\">".$juser."</div>";
				
			}	
			
			
		echo "</p>";
		$iligne++;
	}
$i++;
}	
	

?>
<p style="margin-top: 1em">
<?php echo $html->link(__('-> Je veux m\'inscrire en liste d\'attente', true), array('controller'=>'listeattentes','action'=>'ajout')); 

natel_admin();
?>
</p>