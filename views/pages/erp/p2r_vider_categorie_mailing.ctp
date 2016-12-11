<?php
echo "fixme"; exit;

echo "<h2>Retrait des coopérateurs (adhérents) de la catégorie 24 - Destinataires sélectionnés mailing</h2>";
$query  = "DELETE FROM `p2rch2`.`llx_categorie_member` WHERE `llx_categorie_member`.`fk_categorie` = 24";
$result=mysql_query($query);
echo "<h2>Retrait des coopérateurs (contacts) de la catégorie 35 - Destinataires sélectionnés mailing</h2>";
$query  = "DELETE FROM `p2rch2`.`llx_categorie_contact` WHERE `llx_categorie_contact`.`fk_categorie` = 35";
$result=mysql_query($query);
echo "<h2>Retrait des coopérateurs (tiers) de la catégorie 36 - Destinataires sélectionnés mailing</h2>";
$query  = "DELETE FROM `p2rch2`.`llx_categorie_societe` WHERE `llx_categorie_societe`.`fk_categorie` = 36";
$result=mysql_query($query);
?>
<p><A HREF="javascript:window.close()">Cliquer ici pour fermer l'onglet/fenêtre (et revenir à l'onglet/fenêtre Dolibarr, si appelé depuis Dolibarr)</A></p>
