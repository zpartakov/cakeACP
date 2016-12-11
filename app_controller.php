<?php
class AppController extends Controller
{
// controller file
var $helpers = array('Html', 'Javascript', 'Ajax');
#var $helpers = array('Html', 'Javascript', 'Ajax', 'Fck');


}

############ functions ##########
/*
 * une fonction pour montrer le nom du PDD à partir de son ID
 * */
function pddshow($pdd) {
	$sql="SELECT PDDTexte FROM jos_pdds WHERE id=".$pdd;
	#echo $sql;
	#do and check sql
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
		echo mysql_result($sql,0,'PDDTexte');
	}
	
//date
#fonction pour afficher les dates mysql format humain
function ladate($date){
$date0    = explode(' ',$date);
$date1    = explode('-',$date0[0]);
$ladate=strftime ("%d-%m-%y", mktime(0,0,0,$date1[1], $date1[2],$date1[0]));
  return ($ladate);
}

function ladateheure($date){
$date0    = explode(' ',$date);
$date1    = explode('-',$date0[0]);
$ladate=lejour($date) ." " .strftime ("%d-%m-%y", mktime(0,0,0,$date1[1], $date1[2],$date1[0])).", " .$date0[1];
  return ($ladate);
}

function zejour($date){
	#echo "<font color=purple>".$date ."</font> ";
$date1    = explode(' ',$date);
$date0=$date1[1];
$date0=explode(":",$date0);
$date1    = explode('-',$date1[0]);
#mktime(h,min,s,month,day,y)
$today1=strftime ("%a", mktime($date0[0],$date0[1],$date0[2],$date1[1], $date1[2],$date1[0]));
#echo "<br>h,min,s,month,day,y: <font color=red>" .$date0[0] ."," .$date0[1] ."," .$date0[2] ."," .$date1[1] ."," .$date1[2] ."," .$date1[0] ." - ".$today1."</font><br>";
#jour en français
$today1 = str_replace("Mon", "Lundi", $today1);
$today1 = str_replace("Tue", "Mardi", $today1);
$today1 = str_replace("Wed", "Mercredi", $today1);
$today1 = str_replace("Thu", "Jeudi", $today1);
$today1 = str_replace("Fri", "Vendredi", $today1);
$today1 = str_replace("Sat", "Samedi", $today1);
$today1 = str_replace("Sun", "Dimanche", $today1);
#echo $today1;
  return ($today1);
}

function lejour($date){
$date0    = explode(' ',$date);
$date1    = explode('-',$date0[0]);
$today1=strftime ("%a", mktime(0,0,0,$date1[1], $date1[2],$date1[0]));

#jour en français
$today1 = str_replace("Mon", "Lundi", $today1);
$today1 = str_replace("Tue", "Mardi", $today1);
$today1 = str_replace("Wed", "Mercredi", $today1);
$today1 = str_replace("Thu", "Jeudi", $today1);
$today1 = str_replace("Fri", "Vendredi", $today1);
$today1 = str_replace("Sat", "Samedi", $today1);
$today1 = str_replace("Sun", "Dimanche", $today1);

  return ($today1);
}

function lheure($date){
$date0    = explode(' ',$date);
$heure = $date0[1];
  return ($heure);
}

//pour convertir une date francaise dd-mm-yy en mysql yy-mm-dd
function ladatefr2mysql($date){
if(preg_match("/-/",$date)) {	
$date1  = explode('-',$date);
}elseif(preg_match("/\//",$date)) {	
$date1  = explode('/',$date);
}
$ladate=$date1[2] ."-" .$date1[1] ."-" .$date1[0];
  return ($ladate);
}
/*DJ*/

	
/*detail*/
//pour afficher+modifier les places prévues
function placesprevues($idjour,$npersprevues) {
	echo "<form>Places prévues: <input type=\"text\" id=\"placeprevues" .$idjour ."\" name=\"placeprevues\" onchange=\"metajourplacesajax($idjour,this.value);\" value=\"" .$npersprevues ."\" class=\"numeric\"></form>";
}
function placesprevues2($idjour,$npersprevues) {
	echo "<form>Places prévues: <input type=\"text\" id=\"placeprevues" .$idjour ."\" name=\"placeprevues\" onchange=\"metajourplaces2($idjour);\" value=\"" .$npersprevues ."\" class=\"numeric\"></form>";
}
function changestatutDJ($idjour,$npersprevues) {
	echo "<form><input type=\"checkbox\" id=\"changestatutDJ" .$idjour ."\" name=\"changestatutDJ\" onchange=\"metajourstatut($idjour);\" value=\"" .$npersprevues ."\" class=\"numeric\"";
	if($npersprevues==1){
		echo " checked";
	}
	echo "></form>";
}


//pour afficher+modifier les places prévues
function npersparjour($idjour,$npersprevues) {
	echo "<form><input type=\"text\" id=\"placeprevues" .$idjour ."\" name=\"placeprevues\" onchange=\"metajourplaces($idjour);\" value=\"" .$npersprevues ."\" class=\"numeric\"></form>";
}

/*
 * email notification
 * */
	function notification($to,$table,$id,$url,$action) {

			$from="cocagne@cocagne.ch";
			$obj="Notification de changement (" .$action .") sur l'intranet cake Cocagne pour la table: " .$table;
			$txt="Bonjour,\n\n".$obj."\n";
			$txt .= "\nVoir le changement: <a href=\"".$url."\">".$url."</a>";
			$txt .= "\n\nAu plaisir,\n\nLes Jardiniers";
			$headers ='From: ' .$from ."\n";
			$headers .='Reply-To: ' .$from ."\n";
			$headers .='Content-Type: text/html; charset=UTF-8';
			$txt=nl2br($txt);
			$couriel=mail($to, $obj , $txt, $headers); 
			if(!$couriel) {
			echo "Il y a eu un probl&egrave;me lors de l'envoi du mail, merci de contacter <a href=\"mailto:" .$from ."?subject=" .$obj ."\">" .$to ."</a>";
			}
			
	}
?>
