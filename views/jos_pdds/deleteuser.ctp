<?php 
/*
 * supprimer un coopérateur d'un PDD
*/
//echo phpinfo(); exit;

$user=$_REQUEST["url"];
$user=preg_replace("/^(.*)\//","",$user);
$sql="
DELETE FROM jos_users_pdds
WHERE 
user_id=".$user;

//echo "<br>" .$sql; exit; //tests

$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error DJ: " .mysql_error();
}

header("Location: ".$_SERVER["HTTP_REFERER"]);
?>