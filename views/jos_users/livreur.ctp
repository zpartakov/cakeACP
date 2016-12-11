<?
/*ajout livreur*/
$id=$_GET['id'];
#echo "id: " .$id;
$sql="
INSERT INTO livreurs (
`id` ,
`jos_user_id` ,
`rem`
)
VALUES (
NULL , '" .$id ."', ''
);
";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
header("Location: ../livreurs/");
?>
