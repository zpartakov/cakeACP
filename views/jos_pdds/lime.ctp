<?php
Configure::write('debug', 2);
$this->pageTitle="Limesurvey Points de distribution";
$sql="SELECT * FROM jos_pdds ORDER BY PDDTexte";
$sql=mysql_query($sql);
if(!$sql) {
	echo mysql_error(); exit;
}
$i = 0; $x="";
while($i<mysql_num_rows($sql)){
			$x.= mysql_result($sql,$i,'PDDINo') .";"; 
			$x.= mysql_result($sql,$i,'PDDTexte'); 
			$x.="<br/>";
			$i++;
}
echo $x;

		 ?>

