<?php
/**
* @version        $Id: changer.ctp v1.0 27.05.2010 06:41:50 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* 
* Ce script modifie la base des demie-journées et retourne à l'administration des DJ (liste)
*/

echo "yo"; exit;
$date=stripslashes($_GET['id']);
$val=$_GET['val'];
$rem=stripslashes($_GET['rem']);
$rem=preg_replace("/^.(.*).$/","$1",$rem);
$rem=addslashes($rem);
echo "remarques: $rem<br>";
$sql="SELECT * FROM jos_demiejournees WHERE date LIKE " .$date;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {	echo "SQL error: " .mysql_error(); exit;}


if($val==mysql_result($sql,$i,'nplaces')) { //augmenter le nombre de places
		$nplaces=$val+1;
	} else { //ajuster le nombre de places
		$nplaces=$val;
}

if(strlen($rem)>0) { //modif remarques
		$sqlo="UPDATE jos_demiejournees 
		SET REMARQUES = \"" .$rem ."\"
		WHERE date LIKE " .$date;
		
	} else { //modif places
	
		$sqlo="UPDATE jos_demiejournees 
		SET nplaces = '" .$nplaces ."'
		WHERE date LIKE " .$date;
}

#echo "<br>".$sqlo; exit;
$sql=mysql_query($sqlo);

if(!$sql) { 
	echo "SQL error with query: " .$sqlo ."<br>".mysql_error(); //sql problem
} else {
	header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
	exit();
}

?>

