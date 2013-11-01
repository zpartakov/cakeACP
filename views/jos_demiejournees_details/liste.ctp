<?php
/**
* @version        $Id: liste.ctp v1.0 27.05.2010 05:35:00 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
$this->pageTitle = 'Programmation des demi-journées'; 

//constants
$aujourdhui=date("Y-m-d h:i");
//db
//LEFT JOIN jos_demiejournees_details AS djd ON dj.date=djd.date 

$sql="
SELECT * FROM jos_demiejournees AS dj
WHERE 
dj.date >= '" .$aujourdhui ."' 
AND statut LIKE '1' 
ORDER BY dj.date";
#echo "<br>" .$sql; echo "<hr>"; //tests
$sql=mysql_query($sql);
if(!$sql) { echo "SQL error: " .mysql_error(); }

//now print
?>
<h1><? echo $this->pageTitle;?></h1>
<table cellpadding="0" cellspacing="0" border="1">
<tr>
<th>Date</th>
<th>Jour</th>
<th>Matin</th>
<th>Après-midi</th>
<th>Soir</th>
<th>Livraison</th>
<th>Commentaire</th>
</tr>
<?
$i=0;
while($i<mysql_num_rows($sql)){
	
		//sousrequete: calcul du nombre de personnes inscrites
		$ladatecourante=mysql_result($sql,$i,'date');
		$sql2="SELECT SUM(npers) AS np FROM jos_demiejournees_details WHERE date LIKE '" .$ladatecourante ."'";
		//echo "<br>$sql2<br>"; //tests
		#do and check sql
		$sql2=mysql_query($sql2);
		if(!$sql2) {
			echo "SQL error: " .mysql_error(); exit;
		}	
		$npers=mysql_result($sql2,0,'np');
		if($npers<1) {
			$npers=0;
		}

	//debut de ligne
	if(preg_match("/08:00:00/" ,lheure(mysql_result($sql,$i,'date')))) {

	echo "<tr>";
		echo "<td>" .ladate(mysql_result($sql,$i,'date')) ."</td>";
		echo "<td>" .lejour(mysql_result($sql,$i,'date')) ."</td>";
			//calcul place
			echo "<td>";
			echo  '<input type="checkbox" id="'.mysql_result($sql,$i,'date').'"';
			if($npers==mysql_result($sql,$i,'dj.nplaces')) {
				echo ' checked';
			} 
			echo ' onClick="changedj(\''.mysql_result($sql,$i,'date').'\','.$npers.')">';
			echo "</td>";
//colonne normale
} elseif(preg_match("/1[4-7]:00:00/" ,lheure(mysql_result($sql,$i,'date')))) {
#	echo "<br>new col";
			//calcul place
			echo "<td>";
			echo  '<input type="checkbox" id="'.mysql_result($sql,$i,'date').'"';
			if($npers==mysql_result($sql,$i,'dj.nplaces')) {
				echo ' checked';
			} 
			echo ' onClick="changedj(\''.mysql_result($sql,$i,'date').'\','.$npers.')">';
			echo "</td>";

//fin de ligne
} elseif(preg_match("/18:00:00/" ,lheure(mysql_result($sql,$i,'date')))) {
			//calcul place
			echo "<td>";
			echo  '<input type="checkbox" id="'.mysql_result($sql,$i,'date').'"';
			if($npers==mysql_result($sql,$i,'dj.nplaces')) {
				echo ' checked';
			} 
			echo ' onClick="changedj(\''.mysql_result($sql,$i,'date').'\','.$npers.')">';
			echo "</td>";

			echo "<td>";
				echo '<input type="text" id="rem' .mysql_result($sql,$i,'date') .'" value="' .mysql_result($sql,$i,'dj.REMARQUES') .'" onChange="changerem(\'rem'.mysql_result($sql,$i,'date').'\',\''.mysql_result($sql,$i,'date').'\')">';
			echo "</td>";
	echo "</tr>";
} else {
#	echo "<br>new col";
}

	$i++;
	}
?>
</table>
