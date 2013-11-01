<?php
/**
* @version        $Id: archiver.ctp v1.0 28.05.2010 15:56:19 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* 
* script pour archiver les demie-journées
*/
$aujourdhui=date("Y-m-d h:i");

//archive demie-journnees
$sql="INSERT INTO jos_demiejournees_archives (SELECT * FROM jos_demiejournees WHERE date < '" .$aujourdhui ."')";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
} 

//delete demi-journees
$sql="DELETE FROM jos_demiejournees WHERE date < '" .$aujourdhui ."'";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
} 

//archive demie-journees detail
$sql="INSERT INTO jos_demiejournees_details_archives (SELECT * FROM jos_demiejournees_details WHERE date < '" .$aujourdhui ."')";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
} 

//delete demi-journees detail
$sql="DELETE FROM jos_demiejournees_details WHERE date < '" .$aujourdhui ."'";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
} 
	header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
	exit();
?>
