<?php
echo "fixme"; exit;

if(isset($_POST["annee"])){$testmode=$_POST[modetest];if($testmode<>0){echo '<h1>mode test : aucune modification effectuée</h1>';}
	echo "<h1>OK, le choix est : ".$_POST[annee]."</h1>";
	echo "<h3>Première échéance : ".$_POST['jour1']." / ".$_POST['mois1']." / ".$_POST[annee]."</h3>";
	echo "<h3>Deuxième échéance : ".$_POST['jour2']." / ".$_POST['mois2']." / ".$_POST[annee]."</h3><h2>Création de 2 DJs pour :</h2>";
	$annee=$_POST[annee];$nbcol=$_POST[nombredecolonnes];$prixDJ=$_POST[prixinitialDJ];

// On récupère tous les contrats des Coopérateurs 'actifs' (statut = 1 dans llx_adherents) dont les DJs sont obligatoires (extra.DJ is NULL dans llx_adherent_extrafields)
$premiererequete  = "SELECT DISTINCT c.`rowid`
       FROM llx_societe AS s
       JOIN llx_adherent AS t ON s.`rowid` = t.fk_soc
       JOIN llx_contrat AS c ON s.`rowid` = c.fk_soc
       LEFT JOIN llx_societe_extrafields AS extra ON s.rowid = extra.fk_object
       LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
       WHERE t.`statut` = 1
       AND extra.DJ is NULL
       AND cd.date_ouverture_prevue >= '".$_POST['annee'].".01.01'
       AND cd.fk_product=1"; // ceux qui ont déjà au moins 1 DJ pour l'année sélectionnée
$premierresultat=mysql_query($premiererequete);
if(!$premierresultat ){
	echo "mysql_error:<br>".mysql_error(); exit;
}
$i=0;
while($row = mysql_fetch_row($premierresultat))//récupération de l'ID des contrats ayant au moins 1 DJ pour l'année sélectionnée
{$i++;$id_contrat_DJ[$i]=$row[0];}

$deuxiemerequete  = "SELECT DISTINCT c.`rowid`
       FROM (llx_societe AS s)
       JOIN llx_adherent AS t ON s.`rowid` = t.fk_soc
       JOIN llx_contrat AS c ON s.`rowid` = c.fk_soc
       LEFT JOIN llx_societe_extrafields AS extra ON s.rowid = extra.fk_object
       LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
       WHERE t.`statut` = 1
       AND extra.DJ is NULL";
$deuxiemeresultat=mysql_query($deuxiemerequete);
$i=0;
while($row = mysql_fetch_row($deuxiemeresultat))//comparaison de l'ID de tous les contrats avec les contrats ayant déjà au moins 1 DJ pour l'année sélectionnée
{
	if(in_array($row[0], $id_contrat_DJ)) {} else
	{
		$i++;$id_contrat_ajout[$i]=$row[0];//echo $row[0]." / ".$id_contrat_ajout[$i]."<br>"; // tests
	}
}
$j=0;
foreach ($id_contrat_ajout as $i => $value)
{
	$troisiemerequete  = "SELECT DISTINCT c.`rowid`, t.`firstname`, t.`lastname`
       FROM llx_societe AS s
       JOIN llx_adherent AS t ON s.`rowid` = t.fk_soc
       JOIN llx_contrat AS c ON s.`rowid` = c.fk_soc
       LEFT JOIN llx_societe_extrafields AS extra ON s.rowid = extra.fk_object
       LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
       WHERE c.`rowid`=".$value."
       AND cd.fk_product<>1
       AND cd.date_cloture is null";//echo $troisiemerequete."<br>";//tests
    $troisiemeresultat=mysql_query($troisiemerequete);
    while($row = mysql_fetch_row($troisiemeresultat))//création de chaque commande SQL pour les 2 DJ par coopérateurs.
        {
	$sql="INSERT INTO `p2rch2`.`llx_contratdet` (`fk_contrat`, `fk_product`, `statut`, `label`, `description`, `fk_remise_except`, `date_commande`, `date_ouverture_prevue`, `date_ouverture`, `date_fin_validite`, `date_cloture`, `tva_tx`, `localtax1_tx`, `localtax1_type`, `localtax2_tx`, `localtax2_type`, `qty`, `remise_percent`, `subprice`, `price_ht`, `remise`, `total_ht`, `total_tva`, `total_localtax1`, `total_localtax2`, `total_ttc`, `product_type`, `info_bits`, `fk_product_fournisseur_price`, `buy_price_ht`, `fk_user_author`, `fk_user_ouverture`, `fk_user_cloture`, `commentaire`) VALUES
	('".$row[0]."', '1', '4', NULL, NULL, NULL, NULL, '".$annee."-01-01 00:00:00', '".$annee."-01-01 00:00:00', '".$annee."-".$_POST['mois1']."-".$_POST['jour1']." 00:00:00', NULL, '0.000', '0.000', NULL, '0.000', NULL, '1', '0', '".$prixDJ.".00000000', ".$prixDJ.", '0', '".$prixDJ.".00000000', '0.00000000', '0.00000000', '0.00000000', '".$prixDJ.".00000000', '1', '0', NULL, NULL, '0', NULL, NULL, NULL);";
if($testmode<>0){echo $sql."<br>";}//tests
    else{$db=mysql_query($sql);}
	$sql="INSERT INTO `p2rch2`.`llx_contratdet` (`fk_contrat`, `fk_product`, `statut`, `label`, `description`, `fk_remise_except`, `date_commande`, `date_ouverture_prevue`, `date_ouverture`, `date_fin_validite`, `date_cloture`, `tva_tx`, `localtax1_tx`, `localtax1_type`, `localtax2_tx`, `localtax2_type`, `qty`, `remise_percent`, `subprice`, `price_ht`, `remise`, `total_ht`, `total_tva`, `total_localtax1`, `total_localtax2`, `total_ttc`, `product_type`, `info_bits`, `fk_product_fournisseur_price`, `buy_price_ht`, `fk_user_author`, `fk_user_ouverture`, `fk_user_cloture`, `commentaire`) VALUES
	('".$row[0]."', '1', '4', NULL, NULL, NULL, NULL, '".$annee."-01-01 00:00:00', '".$annee."-01-01 00:00:00', '".$annee."-".$_POST['mois2']."-".$_POST['jour2']." 00:00:00', NULL, '0.000', '0.000', NULL, '0.000', NULL, '1', '0', '".$prixDJ.".00000000', ".$prixDJ.", '0', '".$prixDJ.".00000000', '0.00000000', '0.00000000', '0.00000000', '".$prixDJ.".00000000', '1', '0', NULL, NULL, '0', NULL, NULL, NULL);";
if($testmode<>0){echo $sql."<br>";}//tests
    else{$db=mysql_query($sql);}
$tablo[$j++]=$j.'. '.$row[1].' '.$row[2].' (2 DJs)';
$tabloIDcontrat[$j-1]='<a href="http://www.p2r.ch/gestion/contrat/card.php?id='.$row[0].'" target="_blank">';
        }
}
if($testmode<>0){echo '<h1>mode test : aucune modification effectuée</h1>';}
// tableau de données
  echo '<table>';
  $nb=count($tablo);
  for($i=0;$i<$nb;$i++){

  //les valeurs à afficher
  $valeur1=$tabloIDcontrat[$i].$tablo[$i];

  if($i%$nbcol==0)
  echo '<tr>';
  echo '<td>'.$valeur1.'</a></td>';

  if($i%$nbcol==($nbcol-1))
  echo '</tr>';

  }
  echo '</table>';
// fin tableau données
$i=$i*2;//$k=$k+$i;
echo "<h1>".$i." DJs sont sous contrat.</h1>";if($testmode<>0){echo '<h1>mode test : aucune modification effectuée</h1>';}

//DÉBUT ajouter ID contrat avec 1 seule DJ pour l'année
$i=0;$id_contrat_ajout=$tablo=$tabloIDcontrat=array();
$quatriemerequete = "SELECT COUNT( * ) AS nbr_doublon, c.`rowid`
FROM llx_societe AS s
JOIN llx_adherent AS t ON s.`rowid` = t.fk_soc
JOIN llx_contrat AS c ON s.`rowid` = c.fk_soc
LEFT JOIN llx_societe_extrafields AS extra ON s.rowid = extra.fk_object
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
WHERE t.`statut` =1
AND extra.DJ IS NULL
AND cd.date_ouverture_prevue >= '".$_POST['annee'].".01.01'
AND cd.fk_product =1
GROUP BY rowid
HAVING COUNT( * ) =1";
$quatriemeresultat=mysql_query($quatriemerequete);

while($row = mysql_fetch_row($quatriemeresultat))//ajout de l'ID de tous les contrats ayant 1 seule DJ pour l'année sélectionnée
{
$i++;$id_contrat_ajout[$i]=$row[1];//echo $row[1]." / ".$id_contrat_ajout[$i]."<br>"; // tests
}
$j=0;
foreach ($id_contrat_ajout as $i => $value)
{
	$troisiemerequete  = "SELECT DISTINCT c.`rowid`, t.`firstname`, t.`lastname`
       FROM llx_societe AS s
       JOIN llx_adherent AS t ON s.`rowid` = t.fk_soc
       JOIN llx_contrat AS c ON s.`rowid` = c.fk_soc
       LEFT JOIN llx_societe_extrafields AS extra ON s.rowid = extra.fk_object
       LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
       WHERE c.`rowid`=".$value."
       AND cd.fk_product<>1
       AND cd.date_cloture is null";//echo $troisiemerequete."<br>";//tests
    $troisiemeresultat=mysql_query($troisiemerequete);
    while($row = mysql_fetch_row($troisiemeresultat))//création de chaque commande SQL pour les 2 DJ par coopérateurs.
        {
	$sql="INSERT INTO `p2rch2`.`llx_contratdet` (`fk_contrat`, `fk_product`, `statut`, `label`, `description`, `fk_remise_except`, `date_commande`, `date_ouverture_prevue`, `date_ouverture`, `date_fin_validite`, `date_cloture`, `tva_tx`, `localtax1_tx`, `localtax1_type`, `localtax2_tx`, `localtax2_type`, `qty`, `remise_percent`, `subprice`, `price_ht`, `remise`, `total_ht`, `total_tva`, `total_localtax1`, `total_localtax2`, `total_ttc`, `product_type`, `info_bits`, `fk_product_fournisseur_price`, `buy_price_ht`, `fk_user_author`, `fk_user_ouverture`, `fk_user_cloture`, `commentaire`) VALUES
	('".$row[0]."', '1', '4', NULL, NULL, NULL, NULL, '".$annee."-01-01 00:00:00', '".$annee."-01-01 00:00:00', '".$annee."-".$_POST['mois2']."-".$_POST['jour2']." 00:00:00', NULL, '0.000', '0.000', NULL, '0.000', NULL, '1', '0', '".$prixDJ.".00000000', ".$prixDJ.", '0', '".$prixDJ.".00000000', '0.00000000', '0.00000000', '0.00000000', '".$prixDJ.".00000000', '1', '0', NULL, NULL, '0', NULL, NULL, NULL);";
if($testmode<>0){echo $sql."<br>";}//tests
    else{$db=mysql_query($sql);}
$tablo[$j++]=$j.'. '.$row[1].' '.$row[2].' (1 DJ)';
$tabloIDcontrat[$j-1]='<a href="http://www.p2r.ch/gestion/contrat/card.php?id='.$row[0].'" target="_blank">';
        }
}
//FIN ajouter ID contrat avec 1 seule DJ pour l'année
// tableau de données
  echo '<table>';
  $nb=count($tablo);
  for($i=0;$i<$nb;$i++){

  //les valeurs à afficher
  $valeur1=$tabloIDcontrat[$i].$tablo[$i];

  if($i%$nbcol==0)
  echo '<tr>';
  echo '<td>'.$valeur1.'</a></td>';

  if($i%$nbcol==($nbcol-1))
  echo '</tr>';

  }
  echo '</table>';
// fin tableau données

echo "<h1>Opération terminée avec succès&nbsp;: ".$i." DJs sont sous contrat.</h1>";if($testmode<>0){echo '<h1>mode test : aucune modification effectuée</h1>';}
	}else{
$anneeencours = date("Y");//année en cours
$anneeencours++;
$anneefin = $anneeencours+5;
$annee = $anneeencours-3;
/*
 * calcul nbre de colonnes sur lesquelles afficher les noms des coop. pour lesquels 2 DJ ont été générées -> à changer dans les valeurs défaut
 */
$nbcol="SELECT * FROM cocagne_defaults WHERE lib = 'nb_col_DJ_generee'";
$nbcol=mysql_query($nbcol);
if(!$nbcol) { echo mysql_error(); exit;}
$nbcol=mysql_result($nbcol,0,'n');
/*
 * calcul nbre de colonnes sur lesquelles afficher les noms des coop. pour lesquels 2 DJ ont été générées -> à changer dans les valeurs défaut
 */
$prixDJ="SELECT * FROM cocagne_defaults WHERE lib = 'prix_initial_DJ'";
$prixDJ=mysql_query($prixDJ);
if(!$prixDJ) { echo mysql_error(); exit;}
$prixDJ=mysql_result($prixDJ,0,'n');

echo "<p>Sélectionner l'année et cliquer sur le bouton pour<br />
lancer le script de création des DJ pour tous les<br />
coopérateurs actifs et qui ne sont pas dispensés de DJ.</p>";
echo "<form action='dolibarr_creer_dj' method='POST' name='choixannee'>";
echo "<select name='annee'>>";

while($annee <= $anneefin) {
if($annee == $anneeencours){echo "<option selected value=".$annee.">".$annee++."</option>";}
else{echo  "<option value=".$annee.">".$annee++."</option>";}
};
echo  "</select><br />";
//sélection mois + jour échéance 1
echo  "Sélectionner le mois de la première échéance : <select name='mois1'>";
echo "<option value='01'>Janvier</option>";
echo "<option value='02'>Février</option>";
echo "<option value='03'>Mars</option>";
echo "<option value='04'>Avril</option>";
echo "<option value='05'>Mai</option>";
echo "<option value='06'>Juin</option>";
echo "<option value='07'>Juillet</option>";
echo "<option value='08'>Août</option>";
echo "<option value='09'>Septembre</option>";
echo "<option value='10'>Octobre</option>";
echo "<option value='11'>Novembre</option>";
echo "<option selected value='12'>Décembre</option>";
echo  "</select> et le jour : <select name='jour1'>";
$jour=1;
While ($jour < 32) {//boucle des jour
if ($jour == 31) {echo "<option selected value=".$jour.">".$jour++."</option>";}
else {echo "<option value=".$jour.">".$jour++."</option>";}
};
echo  "</select><br />";
//sélection mois + jour échéance 2
echo  "Sélectionner le mois de la deuxième échéance : <select name='mois2'>";
echo "<option value='01'>Janvier</option>";
echo "<option value='02'>Février</option>";
echo "<option value='03'>Mars</option>";
echo "<option value='04'>Avril</option>";
echo "<option value='05'>Mai</option>";
echo "<option value='06'>Juin</option>";
echo "<option value='07'>Juillet</option>";
echo "<option value='08'>Août</option>";
echo "<option value='09'>Septembre</option>";
echo "<option value='10'>Octobre</option>";
echo "<option value='11'>Novembre</option>";
echo "<option selected value='12'>Décembre</option>";
echo  "</select> et le jour : <select name='jour2'>";
$jour=1;
While ($jour < 32) {//boucle des jour
if ($jour == 31) {echo "<option selected value=".$jour.">".$jour++."</option>";}
else {echo "<option value=".$jour.">".$jour++."</option>";}
};
echo "</select><br /><br />";
echo 'Nombre de colonne à affiche pour le résultats de l\'opération&nbsp;: <input id="nombreDEcolonnes" type="text" value="'.$nbcol.'" name="nombredecolonnes" style="width:50px"><br />Prix unitaire d\'une DJ&nbsp;: <input id="prixDJ" type="text" value="'.$prixDJ.'" name="prixinitialDJ" style="width:100px"><br /><br />Mode test&nbsp;: <select name="modetest"><option value="0">Non</option><option selected value="1">Oui</option></select><br />';
//fin du formulaire
echo  "<br /><input type='submit' value='Lancer le script' /></form>
<p><b>A T T E N T I O N ! </b>une fois le bouton cliqué,<br />
le script de création des lignes de contrats<br />
s'exécute immédiatement.</p>";}
?>
