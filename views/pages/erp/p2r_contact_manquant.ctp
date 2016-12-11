<?php
echo "fixme"; exit;

$this->pageTitle="Contact(s) manquant(s)";

echo "<div style='float:right;'><em><b>Notes :</b></em><ul><li>cliquer sur le nom pour accéder à la fiche Dolibarr ;</li><li>tous les liens de cette page s'ouvrent dans une nouvelle fenêtre ;</li><li style='color:red;'>en rouge : les coopérateurs qui ne sont pas des fournisseurs ;</li></ul></div>";
//**************************************************************************************************************//
echo "<h2>Il manque au moins 1 contact pour le(s) Tiers suivant(s) : </h2><ul>";$l=0;

$query  = "SELECT s.rowid, s.nom, s.fournisseur
FROM llx_societe AS s
LEFT JOIN llx_socpeople AS c ON ( c.fk_soc = s.rowid )
WHERE c.fk_soc IS NULL
ORDER BY `s`.`nom` ASC
";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

 while($row = mysql_fetch_row($result)){

$id = $row[0];//echo '$id : '.$id.'<br>';
$nom = $row[1];//echo '$nom : '.$nom.'<br>';
$idfourn = $row[2];//echo '$idfourn : '.$idfourn.'<br>';

    if ($idfourn == 0) {$ajoutstyle=' style="color:red;"';$tiers='tiers';} else {$ajoutstyle='';$tiers='fournisseur';}
echo '<li><a href="/gestion/societe/soc.php?socid='.$id.'" target="_blank"'.$ajoutstyle.'>Le '.$tiers.' <b>'.$nom.'</b></a></li>';$l++;
}
echo "</ul>";
