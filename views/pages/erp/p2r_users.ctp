<?php
echo "fixme"; exit;

/******************************
Mise à jour des infos Adhérents à partir des infos User de Cake :
=================================================================
1. récupérer les mots de passe de la table users et mettre à jour llx_adherent (au cas où des utilisateurs ont modifié et gardé leur mot de passe, ils n'ont pas besoin de le réinitialiser à chaque fois)
2. Suppression de tous les utilisateurs avec l'ID inférieur à 997 pour garder les admins (gérés uniquement par Cake, pas de lien avec Dolibarr)
3. On récupère tous les Coopérateurs 'actifs' (statut = 1 dans llx_adherents)
4. création de chaque commande SQL pour insérer les données récupérées de la table llx_adherents dans la table users de Cake
5. on vérifie que les coopérateurs inactifs ne sont plus en liste d'attente afin de ne plus les contacter

Autres :
========
6. suppression de données de la table des contacts "llx_socpeople"
7. mise à jour du n° de cat. dans la table Cake "llx_pdls"
******************************/
//ouverture BDD
try
{
    $bdd = new PDO('mysql:host=XXXXXXXXXXXXXXXXXXXXXXXX');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
// 1. récupérer les mots de passe de la table users et mettre à jour llx_adherent (au cas où des utilisateurs ont modifié et gardé leur mot de passe, ils n'ont pas besoin de le réinitialiser à chaque fois)
echo "</ul><h1>1. Mots de passe mis à jour :</h1>";
$i=0;$sql='';
$reponse = $bdd->query("SELECT `id`, `username`, `password`, `email` FROM `users`");
while ($resultat = $reponse->fetch())
{
// comparaison du login et du username :
//	$sql = "UPDATE `llx_adherent` SET `pass`='".$resultat["password"]."', `email`='".$resultat["email"]."' WHERE `login` ='".$resultat["username"]."';";
// comparaison du rowid et de l'id :
	$sql = "UPDATE `llx_adherent` SET `pass`='".$resultat["password"]."' WHERE `rowid` =".$resultat["id"].";";// ne met pas à jour l'adresse électronique
//	$sql = "UPDATE `llx_adherent` SET `pass`='".$resultat["password"]."', `email`='".$resultat["email"]."' WHERE `rowid` =".$resultat["id"].";";
$i++;
$db=mysql_query($sql);//exécution des requêtes SQL
}
$reponse->closeCursor(); // Termine le traitement de la requête
$bdd = null;//fermeture BDD
echo "<p>".$i." coopérateurs mis à jour</p>";

// 2. Suppression de tous les utilisateurs avec l'ID inférieur à 997 pour garder les admins (gérés uniquement par Cake, pas de lien avec Dolibarr)
$bdd = new PDO('mysql:host=XXXXXXXXXXXXXXXXXXXXXXXX');
$sql= "DELETE FROM .`users` WHERE `users`.`id` < 997;";//RETIRER LA CONDITION where
$count = $bdd->exec($sql);//exécution des requêtes SQL
$bdd = null;//fermeture BDD
echo "<h1>2. Coopérateurs effacés de Cake</h1>";

// 3. On récupère tous les Coopérateurs 'actifs' (statut = 1 dans llx_adherents)
$bdd = new PDO('mysql:host=XXXXXXXXXXXXXXXXXXXXXXXX');

//$reponse = $bdd->query("SELECT DISTINCT a.rowid as a_rowid, a.lastname as a_lastname, a.firstname as a_firstname, a.login as a_login, a.pass as a_pass, a.email as a_email FROM llx_adherent as a WHERE statut=1");
$reponse = $bdd->query("SELECT DISTINCT a.rowid as a_rowid, a.lastname as a_lastname, a.firstname as a_firstname, a.login as a_login, a.pass as a_pass, a.email as a_email, extra.adminDJ AS extra_adminDJ FROM llx_societe AS s JOIN llx_adherent AS a ON s.`rowid` = a.fk_soc LEFT JOIN llx_societe_extrafields AS extra ON s.rowid = extra.fk_object WHERE a.statut=1");
echo "<h1>3. Coopérateurs actifs exportés de Dolibarr</h1>";

// 4. création de chaque commande SQL pour insérer les données récupérées de la table llx_adherents dans la table users de Cake
echo "<h1>4. Coopérateurs actifs importés dans Cake :</h1>";
$i=0;$sql='';
while ($resultat = $reponse->fetch())
{
	if($resultat["extra_adminDJ"] == 1){$usertype="administrator";}else{$usertype="user";}//vérifie si admin ou user

	$sql = utf8_encode("INSERT INTO .`users` (`id`, `name`, `username`, `email`, `password`, `role`) VALUES
	('".$resultat["a_rowid"]."', \"".$resultat["a_firstname"]." ".$resultat["a_lastname"]."\", \"".$resultat["a_login"]."\", '".$resultat["a_email"]."', \"".$resultat["a_pass"]."\", '".$usertype."');");
    $i++;
    $db=mysql_query($sql);//exécution des requêtes SQL

}
$reponse->closeCursor(); // Termine le traitement de la requête

//$count = $bdd->exec($sql);//exécution des requêtes SQL
$bdd = null;//fermeture BDD
echo "<p>".$i." coopérateurs importés</p>";

// 5. on vérifie que les coopérateurs inactifs ne sont plus en liste d'attente afin de ne plus les contacter
echo "<h1>5. Liste d'attente mise à jour (suppression des éventuels coopérateurs inactifs en liste d'attente)</h1>";
$query  = "SELECT `id` FROM `users`";//récupération de l'ID des coopérateurs actifs
$result=mysql_query($query);
if(!$result ){
	echo "mysql_error:<br>".mysql_error(); exit;
}
$i=0;
while($row = mysql_fetch_row($result))
{
    $i++;$id_user[$i]=$row[0];
//    echo $id_user[$i].'<br>';//tests
}

$query  = "SELECT `user_id` FROM `listeattentes`";//user_id en liste d'attente
$result=mysql_query($query);
$i=0;//$j=0;$k=0;
while($row = mysql_fetch_row($result))//comparaison de l'ID associé à la cat. 25 avec l'ID enregsitré dans listeattentes
{//echo $row[0].'<br>';//tests
	if(in_array($row[0], $id_user)) {$i++;} else
	{
		$i++;$id_listeattentes[$i]=$row[0];//$j++;
        $sql = "DELETE FROM .`listeattentes` WHERE `listeattentes`.`user_id` =".$row[0].";";$sql=mysql_query($sql);
	}
}
/**** 6. suppression de données de la table des contacts "llx_socpeople" ****/
$query  = "UPDATE `p2rch2`.`llx_socpeople` SET `address` = NULL, `zip` = NULL, `town` = NULL, `phone` = NULL, `phone_perso` = NULL, `phone_mobile` = NULL;";//vider champs inutilisés des Contacts
$result=mysql_query($query);

/**** 7. mise à jour du n° de cat. dans la table Cake "llx_pdls" ****/
echo "<h1>6. Nouveau PDL ajouté : mise à jour de son 'rowid'</h1>";
$query  = "SELECT label, rowid
FROM `llx_categorie`
WHERE fk_parent =1
";
$result=mysql_query($query);
while($row = mysql_fetch_row($result)){
$nomPDL = $row[0];//echo $nomPDL.'<br>';
$idPDL = $row[1];//echo $idPDL.'<br>';
$sql='UPDATE `p2rch2`.`llx_pdls` SET `rowid` = "'.$idPDL.'" WHERE `llx_pdls`.`Lieu_dit` ="'.$nomPDL.'";';$db=mysql_query($sql);
if (!empty($nomPDLsql)) echo '<p>Le PDL '.$nomPDLsql.' a été mis à jour</p>';
}

if (empty($nomPDLsql)) echo '<p>Aucun PDL à mettre à jour.</p>';
/**** 8. essai d'automatisation : ajout d'un adhérent dans la cat. PDL selon son choix initial **** /
echo "<h1>7. essai d'automatisation : ajout d'un adhérent dans la cat. PDL selon son choix initial<br>(aucune donnée n'est modifiée)</h1>";
$recup_id_adh  = "SELECT `id` FROM `users` WHERE `users`.`id` < 997";//récupération de l'ID des coopérateurs actifs
$result_recup_id_adh=mysql_query($recup_id_adh);
if(!$result_recup_id_adh){
	echo "mysql_error:result_recup_id_adh<br>".mysql_error(); exit;
}
$i=0;
//boucle 1 : user (adh.) cake
while($row = mysql_fetch_row($result_recup_id_adh))
{//récupération de l'ID du PDL du coopérateur actif
$j=0;$k=0;$l=0;
$i++;$id_user[$i]=$row[0];echo '************************************************************************************************************************************************<br>id adh./user = '.$id_user[$i].'<br>';//tests

$recup_id_PDL  = "SELECT DISTINCT extra.Categorie_point_distrib AS PDL, CONCAT( a.firstname,' ',a.lastname) AS name FROM llx_adherent AS a LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object WHERE a.rowid=".$id_user[$i];echo $recup_id_PDL;//tests
$result_recup_id_PDL=mysql_query($recup_id_PDL);//echo $result_recup_id_PDL;//tests => Resource id #
//boucle 2 : n° PDL de la fiche adhérent
while($row_id_PDL = mysql_fetch_row($result_recup_id_PDL))
{if($row_id_PDL[0]>0) {$numero_PDL=$row_id_PDL[0];$nom_adh=$row_id_PDL[1];$l++;$numero_adh=$id_user[$i];}echo '<br>boucle 2 : '.$numero_adh.' / '.$id_user[$i].'///';}//récupération du n° de PDL du coop. pour comparaison avec n° cat.
//    $recup_id_adh_cat  = "SELECT fk_categorie, fk_member FROM `llx_categorie_member` WHERE `fk_member` = ".$id_user[$i];
    $recup_id_adh_cat  = "SELECT fk_categorie, fk_member FROM `llx_categorie_member` AS cm LEFT JOIN llx_categorie AS c ON cm.fk_categorie = c.rowid WHERE c.fk_parent=1 AND `fk_member` = ".$id_user[$i];//récup n° cat. des PDLs seul. (fk_parent=1)
    $result_recup_id_adh_cat=mysql_query($recup_id_adh_cat);
//boucle 3 : n° cat. associé au USER pour comparaison
while($row_id_adh_cat = mysql_fetch_row($result_recup_id_adh_cat)){print_r($row_id_adh_cat);
$j++;$fk_categorie[$j]=$row_id_adh_cat[0];$fk_member[$j]=$row_id_adh_cat[1];
if ($fk_categorie[$j]==$numero_PDL) {$k++;echo '<br>cat. '.$fk_categorie[$j].' & PDL '.$numero_PDL.' OK';}//tests
else {echo 'fetch';print_r($row_id_adh_cat);echo '<br>cat. '.$fk_categorie[$j].' & PDL '.$numero_PDL.' pas OK pour adh. '.$id_user[$i].' ('.$numero_adh.')<br>DELETE FROM `p2rch2`.`llx_categorie_member` WHERE `llx_categorie_member`.`fk_categorie` = '.$fk_categorie[$j].' AND `llx_categorie_member`.`fk_member` = '.$numero_adh.'<br>';}echo ' / '.$fk_categorie[$j].'<br>';//tests
// VÉRIFIER SI VARIABLE $numero_adh CORRESPOND BIEN À $id_user[$i] !!!!!!!
//else {$adh_different_de_cat=array{$fk_categorie[$j] =>$numero_PDL};}//faut-il stocker l'info pour supprimer l'adh. de la cat. "automatiquement" s'il a changé de PDL ?
// si oui, utiliser la variable $l pour incrémenter un tableau
    //echo 'dans cat. '.$fk_categorie[$j].'<br>';//tests
}
if ($k==0 && $l<>0) {echo 'INSERT INTO `p2rch2`.`llx_categorie_member` (`fk_categorie` , `fk_member`) VALUES ('.$numero_PDL.', '.$numero_adh.');';
//$sql='INSERT INTO `p2rch2`.`llx_categorie_member` (`fk_categorie` , `fk_member`) VALUES ('.$numero_PDL.', '.$numero_adh.');';$db=mysql_query($sql);
}//comment ou faut-il tenir compte du type de coop. et quel type est sensé être abonné? tous sauf type 3 (Coopérateur-producteur)? Après tests, il semble qu'il n'y ait pas besoin car la requête basée sur User plutôt que llx_adh semble ne prendre que les "bonnes" personnes concernées........
//echo '-'.$l.'<br>';
}
/*
// SELECT `id` FROM `users`
// SELECT * FROM `llx_categorie_member` WHERE `fk_member` = (id de users)
// SELECT DISTINCT extra.Categorie_point_distrib AS PDL FROM llx_adherent AS a LEFT JOIN llx_adherent_extrafields AS extra ON a.rowid = extra.fk_object WHERE a.rowid= (id de users)
// comparaison des résultats des 2 requêtes ci-dessus
/* et si besoin, ajouter la cat. et l'adhérent :
INSERT INTO `p2rch2`.`llx_categorie_member` (`fk_categorie` , `fk_member`) VALUES ('37', '525');
*/
echo "<h1>Op&eacute;rations termin&eacute;es avec succès!</h1>";
?>
