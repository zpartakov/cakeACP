<?php

App::Import('ConnectionManager');
	$ds = ConnectionManager::getDataSource('dolibarr');
	$dsc = $ds->config;

//	echo $dsc['host'];
//	echo $dsc['login'];
//	echo $dsc['password'];
//	echo $dsc['database'];

//$fields = get_class_vars('DATABASE_CONFIG');


echo "fixme"; exit;

$this->pageTitle="Abonnement(s) manquant(s)";

echo "<div style='float:right;'><em><b>Notes :</b></em><ul><li>cliquer sur le n° du contrat pour accéder à la fiche Dolibarr du contrat ;</li><li>tous les liens de cette page s'ouvrent dans une nouvelle fenêtre ;</li></ul></div>";
//**************************************************************************************************************//
$texte="";$l=0;

$query  = "SELECT cd.rowid, cd.fk_contrat
FROM llx_contratdet AS cd
WHERE cd.statut <5
AND fk_product <>1
AND date_fin_validite IS NULL
ORDER BY cd.fk_contrat ASC
";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

 while($row = mysql_fetch_row($result)){
$id_detail_du_contrat = $row[0];//echo '$id : '.$id.'<br>';
$id_contrat = $row[1];//echo '$id_contrat : '.$id_contrat.'<br>';
$sql="SELECT ctabo.rowid, ctabo.fk_contratdet, ctaboterm.fk_contratabonnement, ctaboterm.facture
FROM llx_contratabonnement AS ctabo
LEFT JOIN llx_contratabonnement_term AS ctaboterm ON ( ctaboterm.fk_contratabonnement = ctabo.rowid )
WHERE ctabo.fk_contratdet =$id_detail_du_contrat
AND ctaboterm.facture=0
AND ctabo.statut =1
";
$result2=mysql_query($sql);
$variablevide=0;
 while($ligne = mysql_fetch_row($result2)){
$variablevide++;
}
if($variablevide==0) {$texte.= '<li><a href="/gestion/contrat/card.php?id='.$id_contrat.'" target="_blank">Le contrat '.$id_contrat.'</a></li>';$l++;}
}
if ($l>1) {$s="les $l Contrats suivants";} else {$s="le Contrat suivant";}
if ($texte<>"") {echo "<h2>Il manque au moins 1 abonnement pour $s :</h2><ul>".$texte."</ul>";} else {echo '<p>Tous les contrats ouverts ont un abonnement, Bravo!</p>';}/*
requête pour la 1ère phase :
SELECT cd.rowid, cd.fk_contrat
FROM llx_contratdet AS cd
WHERE cd.statut <5
AND fk_product <>1
AND date_fin_validite IS NULL
ORDER BY cd.fk_contrat ASC

à partir du n° de ct_det on cherche un abo et s'il y en a 1, on cherche si une ligne est ouverte (facture mais égalemnet date ?)

requête pour la 2ème phase :
SELECT ctabo.rowid, ctabo.fk_contratdet, ctaboterm.fk_contratabonnement, ctaboterm.facture
FROM llx_contratabonnement AS ctabo
LEFT JOIN llx_contratabonnement_term AS ctaboterm ON ( ctaboterm.fk_contratabonnement = ctabo.rowid )
WHERE ctabo.fk_contratdet =$row[0]
AND ctaboterm.facture=0



requête de base + complète :
SELECT cd.rowid, cd.fk_contrat, ctabo.fk_contratdet, ctaboterm.fk_contratabonnement, ctaboterm.facture
FROM llx_contratdet AS cd
LEFT JOIN llx_contratabonnement AS ctabo ON ( ctabo.fk_contratdet = cd.rowid )
LEFT JOIN llx_contratabonnement_term AS ctaboterm ON ( ctaboterm.fk_contratabonnement = ctabo.rowid )
WHERE  cd.statut<5
AND fk_product<>1
AND date_fin_validite IS NULL
ORDER BY cd.fk_contrat ASC*/
echo "<br /><br /><p>Ancien test, à ôter si plus besoin :</p>";
$texte="";$l=0;

$query  = "SELECT cd.rowid, cd.fk_contrat
FROM llx_contratdet AS cd
LEFT JOIN llx_contratabonnement AS ctabo ON ( ctabo.fk_contratdet = cd.rowid )
WHERE ctabo.fk_contratdet IS NULL
AND cd.statut<5
AND fk_product<>1
ORDER BY cd.fk_contrat ASC
";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

 while($row = mysql_fetch_row($result)){
$id = $row[0];//echo '$id : '.$id.'<br>';
$id_contrat = $row[1];//echo '$id_contrat : '.$id_contrat.'<br>';
$texte.= '<li><a href="/gestion/contrat/card.php?id='.$id_contrat.'" target="_blank">Le contrat '.$id_contrat.'</a></li>';$l++;
}
if ($l>1) {$s="les $l Contrats suivants";} else {$s="le Contrat suivant";}
echo "<h2>Il manque au moins 1 abonnement pour $s :</h2><ul>".$texte."</ul>";
