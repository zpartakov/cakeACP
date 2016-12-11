<?php
/**
* @version        $Id: nouveau.ctp v1.0 30.05.2010 06:59:14 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
$this->pageTitle = 'Ajouter une inscription'; 

$date=$_GET['date'];
$user=$_GET['user'];
$npers=$_GET['data']['npers'];
$rem=$_GET['data']['rem'];

if($date&&$user&&$npers) {

$sql="
INSERT INTO `jos_demiejournees_details` 
(`id`, `date`, `user`, `npers`, `rem`) VALUES
('', '" .$date ."', '" .$user ."', " .$npers .", '".$rem ."');";
#echo $sql; exit;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
	header("Location: " .RACINEDIR ."/jos_demiejournees_details/correction"); //return to previous page
	exit();
}


?>
<div class="josDemiejourneesDetails form">
<form method="GET">

	<fieldset>
 		<legend><?php echo $this->pageTitle;?></legend>
	<?php
	echo '<label for="npers">Date: ';

		echo "<input type=\"hidden\" name=\"date\" value=\"" .$date ."\">" .ladateheure($date) ."</label>";
		
		$sql="SELECT * FROM jos_users ORDER BY name";
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}

echo '<br><label for="npers">Cocagnard/e</label>';
echo "<table>
		  <tr>
			  <td><select name=\"user\">";

$i=0;
while($i<mysql_num_rows($sql)){
	echo "<option value=\"" .mysql_result($sql,$i,'username') ."\">" .mysql_result($sql,$i,'name') ."</option>\n";
	$i++;
	}
echo "</select>";
		echo "<td><em>Pour entrer des personnes qui n'apparaissent pas dans la liste déroulante,<br>choisir le premier utilisateur (Administrator) et mettre le(s) nom(s) dans le champs Remarques</em>";
			echo "</td>
		  </tr>
	  </table>";
		echo $form->input('npers', array('label'=>"Nombre de personnes",'value'=>'1','style' => 'width: 50px;'));
		echo $form->input('rem', array('label'=>"Remarques"));
?>
	</fieldset>
<?php echo $form->end('Enregistrer','Submit');?>
</div>
<?
/*$sql="DELETE FROM `lesjardinsdecocagnech`.`jos_demiejournees_details` WHERE `jos_demiejournees_details`.`id` = " .$id;
#echo $sql; exit;
#do and check sql
$sql=mysql_query($sql);
if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
}
	header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
	exit();*/
?>
