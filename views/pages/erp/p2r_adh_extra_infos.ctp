<?php
echo "fixme"; exit;

$this->pageTitle="Mise à jour infos Adhérents";

App::import('Lib', 'functions'); //imports app/libs/functions
echo "<em><b>Note : tous les liens de cette page s'ouvrent dans une nouvelle fenêtre</b></em><br /><br />";
//**************************************************************************************************************//
echo "<h2>Mise à jour des infos 'extras' des fiches Adhérents : </h2>";

/*
 * nombre de jours avant l'échéance d'un service pour afficher les adhérents dont le statut est actif et tous les services (panier ou abo oeufs) fermés , à changer dans les valeurs défaut
 */
$njag="SELECT * FROM cocagne_defaults WHERE lib = 'nb_jours_avant_echeance_service'";
$njag=mysql_query($njag);
if(!$njag) { echo mysql_error(); exit;}
$njag=mysql_result($njag,0,'n');

$dateavantecheance=mktime(date("H"), date("i"), 0, date("m"), date("d")+$njag, date("Y"));//date augmentée du nb  de jours indiqués en val. par déf.
$dateavantecheance=strftime("%G-%m-%d",$dateavantecheance);//date au format souhaité
$aujourdhui=date("Y-m-d");
$sql='';
$query  = "SELECT DISTINCT s.rowid AS id, a.rowid AS idADH, a.lastname as nom, a.firstname as prenom, s.email, extra.TaillePanier AS TaillePanier, p.ref, cd.qty, extra.Oeufs AS Oeufs, p.label, ca.fk_frequencerepetition AS FreqPMT, extra.paiements AS paiements, extra.Categorie_point_distrib AS PDL, extra.fromage AS Fromage
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut =1
AND cd.statut <5
AND p.ref <> 'DJ'
";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

echo "<p><b>Étape 1 :</b> adéquation entre les lignes de contrat et les champs 'extras' de la fiche adhérent</p><ul>";
 while($row = mysql_fetch_row($result)){

$id = $row[0];//echo '$id : '.$id.'<br>';
$idADH = $row[1];//echo '$idADH : '.$idADH.'<br>';
$nom = $row[2];//echo '$nom : '.$nom.'<br>';
$prenom = $row[3];//echo '$prenom : '.$prenom.'<br>';
$email = $row[4];//echo '$email : '.$email.'<br>';
$TaillePanier = $row[5];//echo '$TaillePanier : '.$TaillePanier.'<br>';
$ref = $row[6];//echo '$ref : '.$ref.'<br>';
$qty = $row[7];//echo '$qty : '.$qty.'<br>';
$Oeufs = $row[8];//echo '$Oeufs : '.$Oeufs.'<br>';
$label = $row[9];//echo '$label : '.$label.'<br>';
$FreqPMT = $row[10];//echo '$FreqPMT : '.$FreqPMT.'<br>';
$paiements = $row[11];//echo '$paiements : '.$paiements.'<br>';
$pdl = $row[12];
$fromage = $row[13];

// mise à jour fréquence de paiements
if($FreqPMT==5 AND $paiements<>3)
    { $sql = "UPDATE `llx_adherent_extrafields` SET `paiements`=3 WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
echo "<li>Paiement ($paiements) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";}//paiement tous les 3 mois
elseif($FreqPMT==4 AND $paiements<>1)
    { $sql = "UPDATE `llx_adherent_extrafields` SET `paiements`=1 WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
echo "<li>Paiement ($paiements) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";}//paiement annuel
// fin traitement du paiement

// mise à jour du type de panier
if($ref <> 'Oeufs' AND $ref <> 'Fromage' AND $ref<>$TaillePanier){
	$sql = "UPDATE `llx_adherent_extrafields` SET `TaillePanier`='".$ref."' WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
echo "<li>Taille du panier ($ref) mis à jour ($TaillePanier) pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
    }
// fin mise à jour panier

// mise à jour abo. oeufs
    $qty = $qty*4;// multiplication par 4 pour correspondre au nombre d'oeufs par boîte et au nombre du champ Oeufs de la table llx_adherent_extrafields
if($ref == 'Oeufs' AND $Oeufs=='Non') {
	$sql = "UPDATE `llx_adherent_extrafields` SET `Oeufs`=".$qty." WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
    echo "<li>Oeufs ($qty) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
}
elseif($ref == 'Oeufs' AND $qty <> $Oeufs)
    {
	$sql = "UPDATE `llx_adherent_extrafields` SET `Oeufs`=".$qty." WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
    echo "<li>Oeufs ($Oeufs -> $qty) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
    }
elseif($Oeufs<>'Non')//on gère encore celui qui n'a pas/plus d'oeufs mais dont la fiche Adhérent n'est pas à jour!
    {//on cherche, pour cet adhérent qui a autre chose que 'Non' sous 'Oeufs', s'il n'a effectivement plus de contrat Oeufs
    $query = "SELECT DISTINCT s.rowid AS id, a.rowid AS idADH, a.lastname AS nom, a.firstname AS prenom, s.email, extra.TaillePanier AS TaillePanier, p.ref, cd.qty, extra.Oeufs AS Oeufs, p.label, ca.fk_frequencerepetition AS FreqPMT, extra.paiements AS paiements, extra.Categorie_point_distrib AS PDL
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut =1
AND cd.statut <5
AND p.ref = 'Oeufs'
AND a.rowid =".$idADH;
$result2=mysql_query($query);
$row2 = mysql_num_rows($result2);
        if($row2<1){// si vide, on met à jour
        	$sql = "UPDATE `llx_adherent_extrafields` SET `Oeufs`='Non' WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
            echo "<li>Oeufs ($Oeufs -> 'Non') mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
        }//*/
    }
// fin mise à jour abo. oeufs

// mise à jour abo. fromage
if($ref == 'Fromage' AND $fromage<>'Oui') {
	$sql = "UPDATE `llx_adherent_extrafields` SET `fromage`='Oui' WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
    echo "<li>Fromage ($fromage) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
}
elseif($fromage<>'Non')//on gère encore celui qui n'a pas/plus de fromage mais dont la fiche Adhérent n'est pas à jour!
    {//on cherche, pour cet adhérent qui a autre chose que 'Non' sous 'Fromage', s'il n'a effectivement plus de contrat Fromage
    $query = "SELECT DISTINCT s.rowid AS id, a.rowid AS idADH, a.lastname AS nom, a.firstname AS prenom, s.email, extra.TaillePanier AS TaillePanier, p.ref, cd.qty, extra.Oeufs AS Oeufs, p.label, ca.fk_frequencerepetition AS FreqPMT, extra.paiements AS paiements, extra.Categorie_point_distrib AS PDL, extra.fromage AS Fromage
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut =1
AND cd.statut <5
AND p.ref = 'Fromage'
AND a.rowid =".$idADH;
$result2=mysql_query($query);
$row2 = mysql_num_rows($result2);
        if($row2<1){// si vide, on met à jour
        	$sql = "UPDATE `llx_adherent_extrafields` SET `fromage`='Non' WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
            echo "<li>Fromage ($fromage -> 'Non') mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
        }//*/
    }
// fin mise à jour abo. fromage
}
echo "</ul>";

echo "<br /><p><b>Étape 2 :</b> remise à jour en cas de service non encore fermé</p><ul>";

$query  = "SELECT DISTINCT s.rowid AS id, a.rowid AS idADH, a.lastname as nom, a.firstname as prenom, s.email, extra.TaillePanier AS TaillePanier, p.ref, cd.qty, extra.Oeufs AS Oeufs, p.label, ca.fk_frequencerepetition AS FreqPMT, extra.paiements AS paiements, extra.Categorie_point_distrib AS PDL, extra.fromage AS Fromage
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut =1
AND cd.statut <5
AND p.ref <> 'DJ'
AND cd.date_fin_validite>='".$aujourdhui."'";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

 while($row = mysql_fetch_row($result)){

$id = $row[0];//echo '$id : '.$id.'<br>';
$idADH = $row[1];//echo '$idADH : '.$idADH.'<br>';
$nom = $row[2];//echo '$nom : '.$nom.'<br>';
$prenom = $row[3];//echo '$prenom : '.$prenom.'<br>';
$email = $row[4];//echo '$email : '.$email.'<br>';
$TaillePanier = $row[5];//echo '$TaillePanier : '.$TaillePanier.'<br>';
$ref = $row[6];//echo '$ref : '.$ref.'<br>';
$qty = $row[7];//echo '$qty : '.$qty.'<br>';
$Oeufs = $row[8];//echo '$Oeufs : '.$Oeufs.'<br>';
$label = $row[9];//echo '$label : '.$label.'<br>';
$FreqPMT = $row[10];//echo '$FreqPMT : '.$FreqPMT.'<br>';
$paiements = $row[11];//echo '$paiements : '.$paiements.'<br>';
$pdl = $row[12];
$fromage = $row[13];


// mise à jour fréquence de paiements
if($FreqPMT==5 AND $paiements<>3)
    { $sql = "UPDATE llx_adherent_extrafields SET paiements=3 WHERE fk_object` =".$idADH.";";$db=mysql_query($sql);
echo "<li>Paiement ($paiements) mis à jour ($FreqPMT) pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";}//paiement tous les 3 mois
elseif($FreqPMT==4 AND $paiements<>1)
    { $sql = "UPDATE `llx_adherent_extrafields` SET `paiements`=1 WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
echo "<li>Paiement ($paiements) mis à jour ($FreqPMT) pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";}//paiement annuel
// fin traitement du paiement

// mise à jour du type de panier
if($ref <> 'Oeufs' AND $ref <> 'Fromage' AND $ref<>$TaillePanier){
	$sql = "UPDATE `llx_adherent_extrafields` SET `TaillePanier`='".$ref."' WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
echo "<li>Taille du panier ($ref) mis à jour ($TaillePanier) pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
    }
// fin mise à jour panier

// mise à jour abo. oeufs
    $qty = $qty*4;// multiplication par 4 pour correspondre au nombre d'oeufs par boîte et au nombre du champ Oeufs de la table llx_adherent_extrafields
if($ref == 'Oeufs' AND $Oeufs=='Non') {
	$sql = "UPDATE `llx_adherent_extrafields` SET `Oeufs`=".$qty." WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
    echo "<li>Oeufs ($qty) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
}
elseif($ref == 'Oeufs' AND $qty <> $Oeufs)
    {
	$sql = "UPDATE `llx_adherent_extrafields` SET `Oeufs`=".$qty." WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
    echo "<li>Oeufs ($Oeufs -> $qty) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
    }
// fin mise à jour abo. oeufs

// mise à jour abo. fromage
if($ref == 'Fromage' AND $fromage=='Non') {
	$sql = "UPDATE `llx_adherent_extrafields` SET `fromage`=".$fromage." WHERE `fk_object` =".$idADH.";";$db=mysql_query($sql);
    echo "<li>Fromage ($fromage) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idADH."' target='_blank'>".$prenom." ".$nom."</a></li>";
}
// fin mise à jour abo. fromage
}
echo "</ul><br />";

//************************************************************************************************************** /
echo "<h2>Mise(s) à jour des PDL d'après la catégorie adhérents</h2>";$l=0;
$query  = "SELECT DISTINCT o.lastname, o.firstname, e.Categorie_point_distrib AS PDL, c.fk_categorie, o.rowid
FROM llx_categorie AS u, llx_categorie_member AS c, llx_adherent AS o
JOIN llx_adherent_type AS t ON o.fk_adherent_type = t.rowid
JOIN llx_adherent_extrafields AS e ON o.rowid = e.fk_object
WHERE c.fk_member = o.rowid
AND u.rowid = c.fk_categorie
AND u.fk_parent=1
";
$result=mysql_query($query);
while($row = mysql_fetch_row($result)){
$nom = $row[0];//echo $nom.'<br>';
$prenom = $row[1];//echo $prenom.'<br>';
$info_extra = $row[2];//echo $info_extra.'<br>';
$id_categorie = $row[3];//echo $id_categorie.'<br>';
$idAdh = $row[4];//echo $idAdh.'<br>';
if($info_extra <> $id_categorie){
$sql="UPDATE `p2rch2`.`llx_adherent_extrafields` SET `Categorie_point_distrib` = '".$id_categorie."' WHERE `llx_adherent_extrafields`.`fk_object` =".$idAdh.";";$db=mysql_query($sql);
//echo $sql."<br>";//tests
echo "<li>PDL ($info_extra -> $id_categorie) mis à jour pour <a href='/gestion/adherents/fiche.php?rowid=".$idAdh."' target='_blank'>".$prenom." ".$nom."</a></li>";$l++;
}}
if($l<1){echo "<p>Aucune mise à jour de PDL, tout est en ordre.</p>";}

//**************************************************************************************************************/
echo "<h2>Activation des lignes de contrats : </h2><em>(date prise en compte : ".$dateavantecheance.") <a href='http://www.p2r.ch/cake/cocagne_defaults/edit/8' target='_blank'>cliquez ici pour modifier le nombre de jour à prendre en compte à partir d'aujourd'hui (actuellement : ".$njag.")</a></em><br />";
$query  = "SELECT rowid, date_ouverture_prevue FROM `llx_contratdet` WHERE `statut`=0 AND `date_ouverture_prevue`<='".$dateavantecheance."';";//echo $aujourdhui.'<br>';
$result=mysql_query($query);
if(!$result ){
	echo "Aucune ligne à modifier.";
} else {
$i=0;
 while($row = mysql_fetch_row($result)){
	 $sql = "UPDATE `p2rch2`.`llx_contratdet` SET `statut` = '4', `date_ouverture` = '".$row[1]."'  WHERE `llx_contratdet`.`rowid` =".$row[0].";";$db=mysql_query($sql);
	 $i++;//echo $sql.'<br>';
	 }
echo "<p>$i ligne(s) mise(s) à jour</p>";}

echo "<h2>Clôture des lignes de contrats échues : </h2><em>(date prise en compte : ".$dateavantecheance.") <a href='http://www.p2r.ch/cake/cocagne_defaults/edit/8' target='_blank'>cliquez ici pour modifier le nombre de jour à prendre en compte à partir d'aujourd'hui (actuellement : ".$njag.")</a></em><br /><em><b>(DJ non prises en considération)</b></em><br />";
$query  = "SELECT rowid FROM `llx_contratdet` WHERE `statut` <5 AND `date_fin_validite` <'".$dateavantecheance."' AND `llx_contratdet`.`fk_product` <> 1;";
$result=mysql_query($query);
if(!$result ){
	echo "Aucune ligne à modifier.";
} else {
$i=0;
 while($row = mysql_fetch_row($result)){
	 $sql = "UPDATE `p2rch2`.`llx_contratdet` SET `statut` = '5' WHERE `llx_contratdet`.`rowid` =".$row[0].";";$db=mysql_query($sql);
	 $i++;
	 }
echo "<p>$i ligne(s) mise(s) à jour</p>";}

//**************************************************************************************************************//
// Date prévue fin de service : date_fin_validite
// Date effective fin de service : date_cloture

$query  = "SELECT DISTINCT s.rowid AS id, a.rowid AS idADH, a.lastname as nom, a.firstname as prenom, s.email, extra.TaillePanier AS TaillePanier, p.ref, cd.qty, extra.Oeufs AS Oeufs, extra.fromage AS Fromage, p.label, c.rowid, cd.date_fin_validite
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut=1
AND cd.statut=5
AND p.ref <> 'DJ'
AND cd.date_fin_validite<='".$dateavantecheance."'
ORDER BY cd.date_fin_validite DESC
";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

echo "<h3>Adhérent(s) actif(s) (non résilié) n'ayant plus de service (panier et/ou abo. oeufs) ouvert dans un contrat :</h3><em>(date prise en compte : ".$dateavantecheance.") <a href='http://www.p2r.ch/cake/cocagne_defaults/edit/8' target='_blank'>cliquez ici pour modifier le nombre de jour à prendre en compte à partir d'aujourd'hui (actuellement : ".$njag.")</a></em><br /><ul>";$l=0;
 while($row = mysql_fetch_row($result)){

$idTiers = $row[0];//echo '$id : '.$id.'<br>';
$idADH = $row[1];//echo '$idADH : '.$idADH.'<br>';
$nom = $row[2];//echo '$nom : '.$nom.'<br>';
$prenom = $row[3];//echo '$prenom : '.$prenom.'<br>';
$email = $row[4];//echo '$email : '.$email.'<br>';
$TaillePanier = $row[5];//echo '$TaillePanier : '.$TaillePanier.'<br>';
$ref = $row[6];//echo '$ref : '.$ref.'<br>';
$qty = $row[7];//echo '$qty : '.$qty.'<br>';
$Oeufs = $row[8];//echo '$Oeufs : '.$Oeufs.'<br>';
$Fromage = $row[9];//echo '$Fromage : '.$Fromage.'<br>';
$label = $row[10];//echo '$label : '.$label.'<br>';
$idCT = $row[11];//echo '$idCT : '.$idCT.'<br>';
$fin_validite = $row[12];//echo '$fin_validite : '.$fin_validite.'<br>';
$sousrequete  = "SELECT DISTINCT s.rowid, cd.date_fin_validite
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut =1
AND cd.statut <5
AND cd.date_fin_validite IS NULL
AND s.rowid =".$idTiers;//à insérer ci-dessus entre a.statut et cd.statut : AND p.ref <> 'DJ'
$resultsousrequete=mysql_query($sousrequete);
if(mysql_num_rows($resultsousrequete)<1) {
//double (ou plutôt sous-) requête pour le Tiers dont un service VA ÊTRE fermé ET qui n'a pas d'autres services ouverts (p.ex. chgt de panier, etc.) donc qui va terminer son contrat
$sousrequete  = "SELECT DISTINCT s.rowid, cd.date_fin_validite
FROM (
llx_societe AS s, llx_adherent AS a, llx_contrat AS c
)
LEFT JOIN llx_contratdet AS cd ON c.rowid = cd.fk_contrat
LEFT JOIN llx_product AS p ON cd.fk_product = p.rowid
LEFT JOIN llx_contratabonnement AS ca ON cd.rowid = ca.fk_contratdet
LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object
WHERE s.rowid = c.fk_soc
AND s.rowid = a.fk_soc
AND a.statut =1
AND cd.statut <5
AND cd.date_fin_validite >='".$dateavantecheance."'
AND s.rowid =".$idTiers;//à insérer ci-dessus entre a.statut et cd.statut : AND p.ref <> 'DJ'
$resultsousrequete=mysql_query($sousrequete);
if(mysql_num_rows($resultsousrequete)<1) {
echo '<li>'.$prenom.' '.$nom.' :  '.$label.' ('.$ref.'), échu le '.$fin_validite.' / cliquez ici pour :
<a href="/gestion/societe/soc.php?socid='.$idTiers.'" target="_blank">voir la fiche du tiers</a> -
<a href="/gestion/adherents/fiche.php?rowid='.$idADH.'" target="_blank">voir la fiche de l\'adhérent</a> -
<a href="/gestion/contrat/fiche.php?id='.$idCT.'" target="_blank">voir le contrat</a></li>';$l++;
}}}
echo "</ul>";
if($l<1){echo "<p style='padding: 10px 0;'>Aucun coopérateur (ayant un contrat) n'est actif et n'a plus de service.</p>";}

//************************************************************************************************************** /
echo "<h2>Mise(s) à jour de la liste d'attente (DJ)</h2>";
/*
SELECT u.id, a.rowid, a.login, u.username, a.pass, u.password, a.email, u.email
FROM `llx_adherent` AS a, users AS u
WHERE u.id = a.rowid
*/
$query  = "SELECT `fk_member` FROM `llx_categorie_member` WHERE `fk_categorie`=25";//récupération de l'ID des coopérateurs dans la cat. 25
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}
$i=0;
while($row = mysql_fetch_row($result))//id dans la catégorie liste d'attente (25)
{
    $i++;$idAdh_cat[$i]=$row[0];
//    echo $idAdh_cat[$i].'<br>';//tests
}
$query  = "SELECT `user_id` FROM `listeattentes`";//user_id en liste d'attente
$result=mysql_query($query);
$i=0;$j=0;$k=0;
while($row = mysql_fetch_row($result))//comparaison de l'ID associé à la cat. 25 avec l'ID enregsitré dans listeattentes
{//echo $row[0].'<br>';//tests
    $k++;$id_user[$k]=$row[0];//sera utile pour retirer les coop. de la cat. 25
	if(in_array($row[0], $idAdh_cat)) {$i++;} else
	{
		$i++;$id_listeattentes[$i]=$row[0];$j++;
        //echo $row[0]." / ".$id_listeattentes[$i]."<br>"; // tests
	}
}
/************************************************************************************************************** /
* ajout coop. dans la cat. 25
*/
if ($j>0){echo "<p>ID coopérateur ajouté à la catégorie liste d'attente :</p><ul>";} else {echo "<em>Aucun coop. à ajouter en liste d'attente.</em>";}
foreach ($id_listeattentes as $i => $value)
{
    $sql="INSERT INTO `llx_categorie_member` (`fk_categorie`, `fk_member`) VALUES (25, ".$value.");";$db=mysql_query($sql);
//    echo 'foreach : '.$sql.'<br>';//tests
    echo "<li> <a href='/gestion/adherents/fiche.php?rowid=".$value."' target='_blank'>".$value." (cliquer pour accéder à la fiche)</a></li>";
}
if ($j>0){echo "</ul>";}
/************************************************************************************************************** /
* retrait coop. de la cat. 25
*/
$i=1;$k=0;$coop_retires='';
foreach ($idAdh_cat as $i => $value)
{
	if(in_array($idAdh_cat[$i], $id_user)) {$i++;} else
    {//echo $id_user[$i]." / ".$idAdh_cat[$i]."<br>"; // tests
        $k++;
        $sql="DELETE FROM `p2rch2`.`llx_categorie_member` WHERE `llx_categorie_member`.`fk_categorie` = 25 AND `llx_categorie_member`.`fk_member` = ".$value;$db=mysql_query($sql);
        $coop_retires=$coop_retires."<li> <a href='/gestion/adherents/fiche.php?rowid=".$value."' target='_blank'>".$value." (cliquer pour accéder à la fiche)</a></li>";
    }
}
if ($k>0){echo "<br /><br /><p>ID coopérateur retiré de la catégorie liste d'attente :</p><ul>".$coop_retires."</ul>";} else {echo "<br /><br /><em>Aucun coop. à retirer de la liste d'attente.</em>";}
//************************************************************************************************************** /

echo "<h1>Op&eacute;ration(s) termin&eacute;e(s) avec succ&egrave;s!</h1>";
?>
