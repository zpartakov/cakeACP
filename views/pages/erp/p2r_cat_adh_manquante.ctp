<?php
echo "fixme"; exit;

$this->pageTitle="Catégorie(s) PDL manquante(s)";

echo "<div style='float:right;'><em><b>Notes :</b></em><ul><li>cliquer sur le nom pour accéder à la fiche Dolibarr ;</li><li>tous les liens de cette page s'ouvrent dans une nouvelle fenêtre ;</li><li style='color:red;'>en rouge : les coopérateurs qui sont actifs ;</li></ul></div>";
//**************************************************************************************************************//
echo "<h2>Il manque au moins 1 catégorie pour le ou les Adhérents suivant(s) :</h2>";$l=0;
$type1=$type2=$type3=$type4=$type5=$titretypeAdh1=$titretypeAdh2=$titretypeAdh3=$titretypeAdh4=$titretypeAdh5='';
$query="SELECT a.rowid,a.firstname,a.lastname,ta.libelle,ta.rowid,a.datec,a.statut
FROM llx_adherent AS a
LEFT JOIN llx_categorie_member AS cp ON (cp.fk_member=a.rowid)
LEFT JOIN llx_adherent_type AS ta ON (ta.rowid=a.fk_adherent_type)
WHERE cp.fk_member IS NULL
ORDER BY a.datec DESC, a.lastname ASC
"; //AND  a.statut <> 0
$result=mysql_query($query);
if(!$result ){echo "mysql_error:<br>".mysql_error(); exit;}
while($row = mysql_fetch_row($result)){
$id = $row[0];//echo '$id : '.$id.'<br>';
$nom = $row[1].' '.$row[2];//echo '$nom : '.$nom.'<br>';
$typeAdh = $row[3];
$idtype = $row[4];
$dateInscription = $row[5];
if ($row[6]>0) {$ajoutstyle=' style="color:red;"';} else {$ajoutstyle='';}
$tempo= '<li><a href="/gestion/categories/categorie.php?id='.$id.'&type=3" target="_blank"'.$ajoutstyle.'>L\'adhérent <b>'.$nom.'</b></a> inscrit-e depuis le '.$dateInscription.'</li>';$l++;
if ($idtype==1) {$type1.=$tempo;$titretypeAdh1=$typeAdh;}
elseif ($idtype==2) {$type2.=$tempo;$titretypeAdh2=$typeAdh;}
elseif ($idtype==3) {$type3.=$tempo;$titretypeAdh3=$typeAdh;}
elseif ($idtype==4) {$type4.=$tempo;$titretypeAdh4=$typeAdh;}
elseif ($idtype==5) {$type5.=$tempo;$titretypeAdh5=$typeAdh;}
}
echo "<h3>".$titretypeAdh1."</h3>";
echo "<ul>".$type1."</ul><br />";
echo "<h3>".$titretypeAdh2."</h3>";
echo "<ul>".$type2."</ul><br />";
echo "<h3>".$titretypeAdh3."</h3>";
echo "<ul>".$type3."</ul><br />";
echo "<h3>".$titretypeAdh4."</h3>";
echo "<ul>".$type4."</ul><br />";
echo "<h3>".$titretypeAdh5."</h3>";
echo "<ul>".$type5."</ul>";
