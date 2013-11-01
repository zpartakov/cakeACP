<?php 
/*
 * ajouter un coopérateur à un PDD
*/
//echo phpinfo(); exit;

$pdd=$_GET["pdd"];

$cooperateur=$_GET["cooperateur"];
$note=htmlentities($_GET["note"]);

if(strlen($cooperateur)>0) {
$sql="
INSERT INTO jos_users_pdds 
(`id`, `user_id`, `jos_pdd_id`, `note`) 
VALUES 
(NULL, '".$cooperateur ."', '".$pdd."', '".$note ."');"
;

//echo "<br>" .$sql; exit; //tests

$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error DJ: " .mysql_error();
}	?>
	<script type="text/javascript">
	<!--
	window.history.go(-2);
	//-->
	</script>
	
<?php 	
	
	
} else {

//echo $pdd;
$sql="
SELECT * FROM jos_pdds
WHERE
id=".$pdd;

//echo "<br>" .$sql; exit; //tests

$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error DJ: " .mysql_error();
}

echo "<h1>Ajouter un coopérateur au point de distribution: " .mysql_result($sql,0,'PDDTexte') ."</h1>";

$sql="
SELECT * FROM users 
ORDER BY Name";

//echo "<br>" .$sql; exit; //tests

$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error DJ: " .mysql_error();
}
$i=0;
echo "<form method=\"GET\">";
echo "<input type=\"hidden\" name=\"pdd\" value=\"".$pdd ."\">";
echo "<select name=\"cooperateur\" size=\"12\">";
while ($i<mysql_num_rows($sql)) {
	echo "<option value=\"".mysql_result($sql, $i,'id')."\">";
	echo mysql_result($sql, $i,'name');
	echo "</option>";
	$i++;
}
echo "</select><br/>Note:<br/>";
echo "<textarea name=\"note\"></textarea><br/>";
echo "<input type=\"submit\"></form>";
}


//header("Location: ".$_SERVER["HTTP_REFERER"]);
?>