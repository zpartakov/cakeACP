<?php
exit;

		/*
		 * a script to migrate joomla users to concrete5
		 * 
		 * */

	$sql="SELECT * FROM lesjardinsdecocagnech.jos_users ORDER BY id";
$sql=mysql_query($sql);
if(!$sql) {
	echo "Erreur MySQL:<br>" .mysql_error(); exit;
}

$i=0; 

while($i<mysql_num_rows($sql)){
	/*
		echo "<br>" .mysql_result($sql,$i,'username');	
		echo "," .mysql_result($sql,$i,'email');	 
		//add common password
		echo ",ByRjaeXf";
		echo ",cocagnards";
		//add name and concert commas to space
		echo "," .preg_replace("/,/"," ", mysql_result($sql,$i,'name'));
		* */ 
		$i++;
	}
	//exit;
?>	 
<h2>Fix user_ids</h2>
<?php

	$sql="SELECT * FROM lesjardinsdecocagnech4.Users ORDER BY uID";
$sql=mysql_query($sql);
if(!$sql) {
	echo "Erreur MySQL:<br>" .mysql_error(); exit;
}

$i=0; 

while($i<mysql_num_rows($sql)){
		//echo "<hr>" .mysql_result($sql,$i,'uID');
		//echo "<br>" .mysql_result($sql,$i,'uEmail');
		/*	SELECT * FROM lesjardinsdecocagnech.tbl_customers 
	WHERE 
	PersAdresseEmail LIKE '" .mysql_result($sql,$i,'uEmail') ."' 
	

		 * */
	$ssql="
	UPDATE lesjardinsdecocagnech.tbl_customers SET jos_user_id=".mysql_result($sql,$i,'uID')." WHERE PersAdresseEmail LIKE '" .mysql_result($sql,$i,'uEmail') ."' 
	";
	echo $ssql."<br/>"; //tests
	$sql2=mysql_query($ssql);
if(!$sql2) {
	echo "Erreur MySQL:<br>" .mysql_error();
}
	
		$i++;
	}
?>	 
