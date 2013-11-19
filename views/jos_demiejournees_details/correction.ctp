<?php
$this->pageTitle = 'Correction des demi-journées'; 
App::import('Lib', 'functions'); //imports app/libs/functions

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
<h1>p2r - Gestion des demi-journées</h1>
<table cellpadding="0" cellspacing="0" border="1">
<tr>
<th>Date</th>
<th>Inscriptions</th>
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
			$username="SELECT * FROM users WHERE username LIKE '" 
			.mysql_result($sql2,$i2,'user') ."'";
			$usernameQ=mysql_query($username);
			if(!$usernameQ) {
				echo "<br>SQL error person:<br>" .mysql_error() ."<br>";
			} 	
			$username=mysql_result($usernameQ,0,'name');
			$useremail=mysql_result($usernameQ,0,'email');
			$ok=mysql_result($sql2,$i2,'ok');
			$qui.= "
			<table>
				<tr>
					<td>
					" .$username ." (" .mysql_result($sql2,$i2,'npers') .")";
			
			$voiture=utf8_decode(mysql_result($sql2,$i2,'voiture'));
			if($voiture==1) {
				$qui .="<img src=\"".CHEMIN."img/covoiturage.jpg\" style=\"padding: 5px; width: 25px\"><p>co-voiturage proposé</p>";
			}
				
			
					$rem=mysql_result($sql2,$i2,'rem');
					if(strlen($rem)>0) {
						$qui .="<ul><li><div style=\"font-size: smaller;\">" .$rem ."</div></li></ul>";
					}
				/*
				 * venu ou pas?
				 */
				$qui.= "
				</td>
				<td><input id=\"ok".mysql_result($sql2,$i2,'id')."\" onclick=\"okdj('".mysql_result($sql2,$i2,'id')."','".$ok."')\" type=\"checkbox\" value=\"1\"";
					if($ok=='1') {
						$qui .= " checked/>";
					} else {
						$qui.=" />";
					}					
				$qui.="
				&nbsp;<a href=\"".RACINEDIR ."/jos_demiejournees_details/edit/" 
					.mysql_result($sql2,$i2,'id') ."\">";
					$qui.= $html->image('b_edit.png', array("alt"=>"Modifier","title"=>"Modifier"));
					$qui.= "</a>";
					$qui.= "&nbsp;&nbsp;<a onclick=\"javascript:return confirm('Confirmer la suppression ?')\" href=\"" .RACINEDIR ."/jos_demiejournees_details/delete/" .mysql_result($sql2,$i2,'id') ."\">";
					$qui.= $html->image('b_drop.png', array("alt"=>"Effacer","title"=>"Effacer"));
					$qui.= "</a>
					</td>	
				</tr>
			</table>
					";
			$npers=$npers+mysql_result($sql2,$i2,'npers');
			$i2++;
			}
		//fin de la collecte des infos sur les personnes inscrites
		//on revient à l'impression des résultats 

	echo "<tr>";
	echo "<td>";
	echo datefr_short(mysql_result($sql,$i,'date'))  ."</td>";
			//calcul place
			echo "<td style=\"background-color: ";
			colorier($npersprevues, $npers);
			echo "\">";
			placesprevues($idjour,$npersprevues);//nb places avec lien sur édition app_controller.php
			echo "<div class=\"inscrits\">" .$qui ."</div>"; //on affiche le/s Cocagnard/e/s inscrit/e/s
			if($npers>0) {
			echo "<strong>Total: " .$npers ."</strong>";
		}
				echo "&nbsp;&nbsp;<a href=\"".RACINEDIR ."/jos_demiejournees_details/nouveau?date=" .mysql_result($sql,$i,'date') ."\">";
							echo $html->image('b_insrow.png', array("alt"=>"Ajouter une inscription","title"=>"Ajouter une inscription"));
							echo "</a>";
			echo "</td>";
	echo "<tr>";

	$i++;
	}

?>
</table>

