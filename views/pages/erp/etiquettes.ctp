<style>
/* sources:
https://boulderinformationservices.wordpress.com/2011/08/25/print-avery-labels-using-css-and-html/
1in=2.54cm
http://www.codeproject.com/Articles/90577/Building-a-Label-Printing-Software-using-HTML-CSS
*/
body {
		width: 21cm;
		height: 29.7cm;
		margin-left: 1cm;
		margin-right: 1cm;
		margin-top: 1cm;
		margin-bottom: 1cm;
		}
td {
		width: 6.14cm; /* plus .6 inches from padding */
		height: 3.22cm; /* plus .125 inches from padding */
		padding: .32cm .76cm 0;
		margin-right: .32cm; /* the gutter */

/*		float: left;
		text-align: center;
		overflow: hidden; */

		outline: 1px dotted; /* outline doesn't occupy space like border does */
		}
		.label {
			font-size: 9pt;
		}
		.ladate {
			font-size: 9pt;
			padding-left: 7em;
		}
.page-break  {
		clear: left;
		display:block;
		page-break-after:always;
		}

</style>
<meta charset="utf-8" />
<?php

/* les étiquettes autocollantes pour les produits sur commande
régulières des membres de la coopérative "Les Jardins de Cocagne", cocagne.ch */

/* print sticky labels for periodic products (eggs, breads etc)
for Cocagne's cooperative members */

//print settings for label pages
$col_nb=3; //how many columns?
$line_nb=8; //how many lines?
$separateur="<br/>";
$separateur_col="</td>\n<td>";

$this->layout = false; //do NOT use standard HTML layout as we want to print labels

	App::import('Lib', 'dolibarr'); //imports app/libs/functions
	erp_etiquettes(); //connexion db etc.
//functions
function putz_label($label) {
	$label=preg_replace("/, hebdo/","",$label);
	$label=preg_replace("/Abonnement fromage/","Fromage",$label);
	$label=preg_replace("/, tous les 15 jours/","",$label);
	$label=utf8_encode($label);
	echo "<span class=\"label\">".$label ."</span>";//product label
}
//retrieving datas
$sql="
SELECT * FROM
".MAIN_DB_PREFIX."contrat AS abo, ".MAIN_DB_PREFIX."societe AS u
WHERE abo.fk_soc=u.rowid
ORDER BY abo.date_contrat DESC";
//echo "<pre>$sql.</pre>"; //tests
$sql=mysql_query($sql);
if(!$sql ){
	echo "mysql_error:<br>".mysql_error(); exit;
}
//echo "<h1>étiquettes</h1>";//tests
$i=0;
 $cellnb=0;
 echo "<table>";

while($i<mysql_num_rows($sql)){
//recherche pdd
$pdd="SELECT ".MAIN_DB_PREFIX."adherent_extrafields.pdd AS pddid
FROM ".MAIN_DB_PREFIX."adherent, ".MAIN_DB_PREFIX."adherent_extrafields
WHERE email LIKE '".mysql_result($sql,$i,'u.email')."'
AND ".MAIN_DB_PREFIX."adherent_extrafields.fk_object=".MAIN_DB_PREFIX."adherent.rowid
";
//echo "<pre>".$pdd."</pre>"; //tests
$pdd=mysql_query($pdd);
//echo $separateur;//tests
//echo "PDD id: " .mysql_result($pdd,0,'pddid');//tests
$pdd="SELECT * FROM jos_pdds WHERE PDDINo = '".mysql_result($pdd,0,'pddid')."'";
//echo "<pre>".$pdd."</pre>"; //tests
$pdd=mysql_query($pdd);
//fin recherche pdd

//recherche libelle produit

$produit = "
SELECT cd.rowid, cd.statut, cd.label as label_det, cd.fk_product, cd.description, cd.price_ht, cd.qty,";
$produit.= " cd.tva_tx, cd.remise_percent, cd.info_bits, cd.subprice,";
$produit.= " cd.date_ouverture_prevue as date_debut, cd.date_ouverture as date_debut_reelle,";
$produit.= " cd.date_fin_validite as date_fin, cd.date_cloture as date_fin_reelle,";
$produit.= " cd.commentaire as comment, cd.fk_product_fournisseur_price as fk_fournprice, cd.buy_price_ht as pa_ht,";
$produit.= " cd.fk_unit,";
$produit.= " p.rowid as pid, p.ref as pref, p.label as label, p.fk_product_type as ptype, p.entity as pentity";
$produit.= "
FROM ".MAIN_DB_PREFIX."contratdet as cd";
$produit.= "
LEFT JOIN ".MAIN_DB_PREFIX."product as p ON cd.fk_product = p.rowid";
$produit.= " WHERE cd.rowid = ".mysql_result($sql,$i,'rowid');


/*
SELECT *
FROM `llx_contratdet`
WHERE `fk_contrat` =4

SELECT *
FROM `lesjardinsdecocagnech3`.`llx_product`
WHERE `rowid` =45
LIMIT 0 , 30
*/
$produit="
SELECT p.label AS label
FROM ".MAIN_DB_PREFIX."contratdet AS cd, ".MAIN_DB_PREFIX."product AS p
WHERE cd.fk_contrat =". mysql_result($sql,$i,'abo.rowid')
." AND p.rowid = cd.fk_product
AND p.label NOT LIKE '%journees%'
AND p.label NOT LIKE '%part %'
";
//echo "<pre>Produit:<br>$produit</pre>";
$produit=mysql_query($produit);
//fin recherche libelle produit


//affichage résultats
$j=0;
while($j<mysql_num_rows($produit)){

	$cellnb++;


	if($cellnb==1) { //new line for 1st record
		echo "\n\n<tr>";
		echo "\n<td>";
	}


//echo "#".$cellnb;
//echo "Contrat id: " .mysql_result($sql,$i,'abo.rowid');
//echo "#".$cellnb ."<br>"; //tests
echo mysql_result($sql,$i,'u.nom');//name of the contractant
echo $separateur;

putz_label(mysql_result($produit,$j,'label'));

echo $separateur;
echo "<span class=\"ladate\">" .date("d.m.Y") ."</span>";//Date

echo "<p style=\"text-align: right\">";
echo mysql_result($pdd,0,'PDDTexte');//PDD name
echo "</p>";

//echo mysql_result($sql,$i,'abo.fin_validite');
//  echo mysql_result($sql,$i,'abo.date_cloture');
//  echo "PDDNoRue: " .mysql_result($pdd,0,'PDDNoRue');
//  echo "PDDAdr: " .utf8_encode(mysql_result($pdd,0,'PDDAdr'));
//  echo "PDDLieu: " .utf8_encode(mysql_result($pdd,0,'PDDLieu'));


$j++;
//new line?
if(intval($cellnb/$col_nb)==($cellnb/$col_nb)&&$cellnb!=0) {
	echo "
	</td>
	</tr>
	\n\n
	<tr>
		<td>";
} else {
	echo "\n";
	echo $separateur_col;

}


}
$i++;
}
echo "</table>";

 ?>
