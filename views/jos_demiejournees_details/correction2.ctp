<?php
/**
* @version        $Id: correction.ctp v1.0 28.05.2010 04:53:58 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
$this->pageTitle = 'Correction des demi-journées'; 
?>
<style>
.inscrits {
/*padding: 2px;
padding-top: 9px;
border: solid thin;
margin-bottom: 5px;*/
margin-top: 5px;
font-size: smaller;
}</style>
<?
//constants
$aujourdhui=date("Y-m-d h:i");

/* extraction des données 
 * */
$sql="
SELECT * FROM jos_demiejournees AS dj
WHERE 
dj.date >= '" .$aujourdhui ."' 
AND statut LIKE '1' 
ORDER BY dj.date 
LIMIT 0,1000 
";
#echo "<br>" .$sql; echo "<hr>"; exit; //tests

$sql=mysql_query($sql);
if(!$sql) { echo "SQL error DJ: " .mysql_error(); }

/*print results
 * */
?>
<h1>Jardin de Cocagne - Gestion des demi-journées</h1>
<table cellpadding="0" cellspacing="0" border="1">
<tr>
<th>Date</th>
<th>Matin</th>
<th>Après-midi</th>
<th>Livraison</th>
</tr>
<?
/*make a loop on results
 * */
 $i=0;
while($i<mysql_num_rows($sql)){
		//init vars for the current loop
		$qui=""; $npers=0;
		//sousrequete: calcul du nombre de personnes inscrites
		$ladatecourante=mysql_result($sql,$i,'date');
		$npersprevues=mysql_result($sql,$i,'nplaces');
		$idjour=mysql_result($sql,$i,'id');
		
		$sql2="
		SELECT * FROM jos_demiejournees_details AS jdd 
		WHERE jdd.date LIKE '" .$ladatecourante ."'";
		#echo "<br>$sql2<br>"; //tests
		#do and check sql
		$sql2=mysql_query($sql2);
		if(!$sql2) {
			echo "SQL error: DJDetail " .mysql_error(); exit;
		}	
		#qui est inscrit?	
		$i2=0;
		while($i2<mysql_num_rows($sql2)){
			$username="SELECT * FROM jos_users WHERE username LIKE '" .mysql_result($sql2,$i2,'user') ."'";
			$usernameQ=mysql_query($username);
			if(!$usernameQ) {
				echo "<br>SQL error person:<br>" .mysql_error() ."<br>";
			} 	
			$username=mysql_result($usernameQ,0,'name');
			$useremail=mysql_result($usernameQ,0,'email');

/*			$qui.= "<li><a title=\"envoyer un email\" href=\"mailto:" .$useremail ."\">" .$username ."</a> - " .mysql_result($sql2,$i2,'npers') ." - ".mysql_result($sql2,$i2,'rem') ."</li>";*/

			$qui.= "<table>
						<tr>
							<td>
							" .$username ." (" .mysql_result($sql2,$i2,'npers') .")";
							$rem=utf8_decode(mysql_result($sql2,$i2,'rem'));
							if(strlen($rem)>0) {
								$qui .="<ul><li><div style=\"font-size: smaller;\">" .$rem ."</div></li></ul>";
							}
							$qui.= "
							</td>
							<td>
							<a href=\"".RACINEDIR ."/jos_demiejournees_details/edit/" .mysql_result($sql2,$i2,'id') ."\">";
							$qui.= $html->image('b_edit.png', array("alt"=>"Modifier","title"=>"Modifier"));
							$qui.= "</a>";
							$qui.= "&nbsp;&nbsp;<a onclick=\"javascript:return confirm('Confirmer la suppression ?')\" href=\"" .RACINEDIR ."/jos_demiejournees_details/delete/" .mysql_result($sql2,$i2,'id') ."\">";
							$qui.= $html->image('b_drop.png', array("alt"=>"Effacer","title"=>"Effacer"));
							$qui.= "</a></td>	
					</tr>
				</table>
						";
$npers=$npers+mysql_result($sql2,$i2,'npers');
			$i2++;
			}
		//fin de la collecte des infos sur les personnes inscrites
		//on revient à l'impression des résultats 

//debut de ligne (c'est le matin, 8h)
if(preg_match("/08:00:00$/" ,lheure(mysql_result($sql,$i,'date')))) {
	echo "<tr>";
		echo "<td>" .lejour(mysql_result($sql,$i,'date')) ." " .ladate(mysql_result($sql,$i,'date')) ."</td>";
			//calcul place
			echo "<td style=\"background-color: ";
			colorier($npersprevues, $npers);
			echo "\">";
			placesprevues($idjour,$npersprevues);//nb places avec lien sur édition app_controller.php
#			if($npersprevues>0&&$npers>0) {
			if($npersprevues>0&&$npers>0) {
				echo "<div class=\"inscrits\">" .$qui ."</div>"; //on affiche le/s Cocagnard/e/s inscrit/e/s
			}
			if($npers>0) {
			echo "<strong>Total: " .$npers ."</strong>";
		}
				echo "&nbsp;&nbsp;<a href=\"".RACINEDIR ."/jos_demiejournees_details/nouveau?date=" .mysql_result($sql,$i,'date') ."\">";
							echo $html->image('b_insrow.png', array("alt"=>"Ajouter une inscription","title"=>"Ajouter une inscription"));
							echo "</a>";
			echo "</td>";
//colonne normale
} elseif(preg_match("/14:00:00/" ,lheure(mysql_result($sql,$i,'date')))) {
#	echo "<br>new col";
			//calcul place
			//calcul place
			echo "<td style=\"background-color: ";
			colorier($npersprevues, $npers);
			echo "\">";			//nb places avec lien sur édition
			placesprevues($idjour,$npersprevues);
			if($npersprevues>0&&$npers>0) {
				echo "<div class=\"inscrits\">" .$qui ."</div>"; //on affiche le/s Cocagnard/e/s inscrit/e/s
			}
			if($npers>0) {
			echo "<strong>Total: " .$npers ."</strong>";
		}
		
		//ajout nouvel enregistrement//
		echo "&nbsp;&nbsp;<a href=\"".RACINEDIR ."/jos_demiejournees_details/nouveau?date=" .mysql_result($sql,$i,'date') ."\">";
							echo $html->image('b_insrow.png', array("alt"=>"Ajouter une inscription","title"=>"Ajouter une inscription"));
							echo "</a>";
			echo "</td>";

//fin de ligne
} elseif(preg_match("/18:00:00/" ,lheure(mysql_result($sql,$i,'date')))&&(lejour(mysql_result($sql,$i,'date'))=="Jeudi")) { // soir / livraison £
			//calcul place
			//calcul place
			echo "<td style=\"background-color: ";
			colorier($npersprevues, $npers);
			echo "\">";			//nb places avec lien sur édition
			placesprevues($idjour,$npersprevues);
			if($npersprevues>0) {
				echo "<div class=\"inscrits\">" .$qui ."</div>"; //on affiche le/s Cocagnard/e/s inscrit/e/s
			}
			if($npers>0) {
			echo "<strong>Total: " .$npers ."</strong>";
		}
				echo "&nbsp;&nbsp;<a href=\"".RACINEDIR ."/jos_demiejournees_details/nouveau?date=" .mysql_result($sql,$i,'date') ."\">";
							echo $html->image('b_insrow.png', array("alt"=>"Ajouter une inscription","title"=>"Ajouter une inscription"));
							echo "</a>";
			echo "</td>";


	echo "</tr>";
} else {
#	echo "<br>new col";
}

	$i++;
	}

?>
</table>

