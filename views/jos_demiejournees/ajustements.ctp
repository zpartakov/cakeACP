<?php
/**
* @version        $Id: ajustements.ctp v1.0 22.10.2010 06:30:47 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/*un script pour corriger massivement les demie-journées*/

$lesjours=array(
'lundiam',
'lundipm',
'mercrediam',
'mercredipm',
'jeudiam',
'jeudipm',
'jeudilivr',
'vendrediam',
'vendredipm',
'samediam',
'samedipm',
);
$lesjourslib=array(
'lundi matin',
'lundi après-midi',
'mercredi matin',
'mercredi après-midi',
'jeudi matin',
'jeudi après-midi',
'jeudi livraison',
'vendredi  matin',
'vendredi après-midi',
'samedi matin',
'samedi après-midi',
);
$size=count($lesjours);
#echo phpinfo();
//l'intervalle a été défini
if($_GET["debut"]){
	#echo "<hr><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a>"; //return to previous page

	#echo "<h1>Correction des donn&eacute;es</h1>";
	$debut=$_GET["debut"];
	$fin=$_GET["fin"];
	$nbp=$_GET["nbp"];
	
#echo "<br>debut " .$debut ." fin " .$fin."<br>"; //tests
	$debutt=ladatefr2mysql($debut);
	$fint=ladatefr2mysql($fin);
	if($fint<$debutt) {
		echo "Erreur: la date de fin (" .$fin .") est ant&eacute;rieure &agrave; la date de d&eacute;but (" .$debut .") !"; exit;
	}
	#echo "debut " .$debutt ." fin " .$fint; exit; //tests

	$jours=$_GET["jours"]; 
	$lundiam=$_GET["lundiam"]; 
	$lundipm=$_GET["lundipm"]; 
	$mercrediam=$_GET["mercrediam"]; 
	$mercredipm=$_GET["mercredipm"]; 
	$jeudiam=$_GET["jeudiam"];
	$jeudipm=$_GET["jeudipm"];
	$jeudilivr=$_GET["jeudilivr"];
	$vendrediam=$_GET["vendrediam"];
	$vendredipm=$_GET["vendredipm"];
	$samediam=$_GET["samediam"];
	$samedipm=$_GET["samedipm"];
	//extraire les donnees correspondant à l'intervalle de temps
	
		$sql="
		SELECT * FROM jos_demiejournees 
		WHERE 
		(date >= '" .$debutt." 08:00:00' 
		 AND 
		 date <= '" .$fint ." 08:00:00'
		)";
		
	#echo nl2br($sql);	
		
	#do and check sql
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	
	$i=0;
	while($i<mysql_num_rows($sql)){
		#echo "<br>" .mysql_result($sql,$i,'id') ." ";
			if($jours=="all") { //tous
			$sqldo="UPDATE jos_demiejournees 
					SET nplaces = " .$nbp ." 
					WHERE id=" .mysql_result($sql,$i,'id');
					$sqldo=mysql_query($sqldo);
					if(!$sqldo) {
						echo "SQL error: " .mysql_error(); exit;
					}
			} else { //certains jours
			#echo mysql_result($sql,$i,'date')."<br>";
			$lejour=zejour(mysql_result($sql,$i,'date'));
			#echo " <b>" .$lejour ."</b> ";
			//lundis debut
			if($lejour=="Lundi"){
						//mer am
						if($lundiam=="lundiam" && preg_match("/08:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
						//mer pm
						if($lundipm=="lundipm" && preg_match("/14:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
		
			}//fin mercredis
			
			//mercredis debut
			if($lejour=="Mercredi"){
						//mer am
						if($mercrediam=="mercrediam" && preg_match("/08:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
						//mer pm
						if($mercredipm=="mercredipm" && preg_match("/14:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
		
			}//fin mercredis
			
			//jeudis debut
			if($lejour=="Jeudi"){
						//jeu am
						if($jeudiam=="jeudiam" && preg_match("/08:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
						//jeu pm
						if($jeudipm=="jeudipm" && preg_match("/14:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
						//jeu livraison
						if($jeudilivr=="jeudilivr" && preg_match("/18:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
		
			}//fin jeudis
			//vendredis debut
			if($lejour=="Vendredi"){
						//vendredi am
						if($vendrediam=="vendrediam" && preg_match("/08:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
						//vendredi pm
						if($vendredipm=="vendredipm" && preg_match("/14:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}

		
			}//fin vendredis
			
			//samedis debut
			if($lejour=="Samedi"){
						//samedi am
						if($samediam=="samediam" && preg_match("/08:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}
						//samedi pm
						if($samedipm=="samedipm" && preg_match("/14:00:00$/",mysql_result($sql,$i,'date'))) {
								#echo " <font color=green>change</font>";
								$sqldo="UPDATE jos_demiejournees 
								SET nplaces = " .$nbp ." 
								WHERE id=" .mysql_result($sql,$i,'id');
								$sqldo=mysql_query($sqldo);
								if(!$sqldo) {
									echo "SQL error: " .mysql_error(); exit;
								}
						}

		
			}//fin samedis£
			
			
			
			
			}//fin certains jours

		
		
		$i++;
		}
	#echo "<hr><a href=\"" .$_SERVER["HTTP_REFERER"] ."\">Retour</a>"; //return to previous page
#header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
echo '<meta http-equiv="refresh" content="0;URL=' .$_SERVER["HTTP_REFERER"] .'">';

} else {
######################################################
//pas d'intervale défini on affiche le formulaire de départ
?>

<form method="GET">




Nombre de personnes:<input type="text" name="nbp" value="5" style="width: 15px; text-align: right">

<div class="date">
<p>Date du début de l'ajustement: <input name="debut" id="debut" type="text" value="<? echo date("d/m/Y");?>" style="width: 100px; text-align: center">
</div>
<script type="text/javascript">
datepick('debut','01/01/1990','31/12/2030');
</script>
</p>
<? $timestamp=strtotime("+30 day");
    $date2= date('d/m/Y', $timestamp);
    ?>
    <div class="date">
<p>Date de la fin de l'ajustement: <input name="fin" id="fin" type="text" value="<? echo $date2;?>" style="width: 100px; text-align: center">
</div>
<script type="text/javascript">
datepick('fin','01/01/1990','31/12/2030');
</script>
</p>
    <?

?>
<!--Date fin ajustement:<input type="text" name="fin" value="<? echo $date2;?>">-->

Jours: 
<table>
	<tr>
		<td><input type="radio" name="jours" value="all" checked  onclick="showhide('div1');">tous</input></td>
		<td><input type="radio" name="jours" value="certains" onclick="showhide('div1');">certains</input></td>
			</tr>
</table>
<!-- a cool ajax style effect, very easy; see cocagne.js 
var state = 'none';
function showhide(layer_ref) {...
 -->

<div id="div1" style="display: none;">
<table>
	<tr>
	
	<?
	for ($i=0; $i < $size; $i++) {
	echo '<td><input type="checkbox" name="' .$lesjours[$i] .'" value="'.$lesjours[$i] .'">' .$lesjourslib[$i] .'</input></td>';
}
	?>
	</tr>
</table>
</div> 
<input type="submit">
</form>

<?
}?>
