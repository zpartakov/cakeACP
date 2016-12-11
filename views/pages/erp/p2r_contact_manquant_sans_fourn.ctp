<?php
echo "fixme"; exit;

$this->pageTitle="Contact(s) manquant(s)";

echo "<em><b>Note : tous les liens de cette page s'ouvrent dans une nouvelle fenêtre</b></em><br /><br />";
//**************************************************************************************************************//
echo "<h2>Il manque au moins 1 contact pour le(s) Tiers suivant(s) : </h2><br /><ul>";$l=0;

$query  = "SELECT s.rowid, s.nom
FROM llx_societe AS s
LEFT JOIN llx_socpeople AS c ON ( c.fk_soc = s.rowid )
WHERE c.fk_soc IS NULL AND s.fournisseur=0
ORDER BY `s`.`nom` ASC
";
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}

 while($row = mysql_fetch_row($result)){

$id = $row[0];//echo '$id : '.$id.'<br>';
$nom = $row[1];//echo '$nom : '.$nom.'<br>';

echo '<li>Le tiers <b>'.$nom.'</b> - cliquez ici pour :
<a href="/gestion/societe/soc.php?socid='.$id.'" target="_blank">voir la fiche du tiers</a></li>';$l++;
}
echo "</ul>";
