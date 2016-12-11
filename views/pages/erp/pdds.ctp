<style>
th, td {border: thin solid; padding: 8px}
th {background-color: lightyellow}
#tdm {
   width: 90%;
   -webkit-columns: 3 auto;
   -moz-columns: 3 auto;
   columns: 3 auto;
}
table {
padding-bottom: 1em;

}
div.dataTables_wrapper {
        margin-bottom: 3em;
    }
</style>

<?php
/* Copyright (C) 2016-2021 Fred Radeff / www.radeff.red  <fradeff@akademia.ch>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// Change this following line to use the correct relative path (../, ../../, etc)

//$this->layout = false; //do NOT use standard HTML layout as we want to print labels




App::import('Lib', 'dolibarr'); //imports app/libs/functions
erp_etiquettes(); //connecting to the database
$sql="SELECT * FROM llx_extrafields AS pdds WHERE pdds.name LIKE 'pdd'";
$resql=mysql_query($sql);
if ($resql)
{
	$pdds = mysql_result($resql,0,'param');
	$pdds=preg_replace("/a:1:{s:7:\"options\";a:43:{/","",$pdds);
  //	$pdds=preg_replace("/i:/","\r",$pdds); //tests to print
  	$pdds=preg_replace("/i:/","§§§",$pdds); //create 1st array delimitor
  	$pdds=preg_replace("/s:[0-9]*?:/","",$pdds);
  	$pdds=preg_replace("/}}/","",$pdds);
  //echo nl2br($pdds); //tests
}
$pdds = explode("§§§", $pdds);

//define vars
  $entete=""; $contenu="";
$entetetable="<tr><th>Nom</th><th>Pr&eacute;nom</th><th>GP/PP</th>";
$entetetable.="<th>Adresse</th><th>Code postal</th><th>Ville</th><th>email</th><th>Natel</th><th>Statut</th><th>Resp. point</th>";
//address zip town email phone_mobile statut resp_point
$entetetable.="</tr>";

//loop on pdds  


foreach ($pdds as $line) {
  //$pdd=$line[1];
  $pdd=$line;
  
  $pdd=preg_replace("/^:/","",$pdd);
  $pdd=preg_replace("/;$/","",$pdd);
  $pdd=explode(";",$pdd);
  
  $pdd_id=$pdd[0];
 
 //if($pdd_id==380) {  //tests only with pdd r. Gares begin

  $pdd_name=utf8_encode($pdd[1]);
//  $pdd_name=$pdd[1];
  //$pdd_name=$pdd[1];
  $pdd_name=preg_replace("/\"/","",$pdd_name);
  
  if(strlen($pdd_name)>0) { //print only if there is a name
  $entete=$entete."\n<li><a href=\"#".$pdd_id."\">".$pdd_name."</a></li>";
  $contenu.="\n\n<h2 id=\"".$pdd_id."\">".$pdd_name ." (#".$pdd_id .")"."</h2>";


//$contenu.= '<p><em>now loop on members of this pdd!!! ok with pdd r. Gares 380 </em></p>';
 $sqlpdd="
	SELECT * FROM llx_adherent_extrafields, llx_adherent
	WHERE llx_adherent_extrafields.fk_object=llx_adherent.rowid
	AND llx_adherent_extrafields.pdd=".$pdd_id ."
	ORDER BY llx_adherent.lastname, llx_adherent.firstname";
	
	//tests
    /*
    $contenu.= "<pre>";
	$contenu.= $sqlpdd;
	$contenu.= "</pre>";
	*/
 
  $ressqlpdd=mysql_query($sqlpdd);
  
  if ($ressqlpdd) {
  $contenu.= "<table class=\"display\"  id=\"".$pdd_id."\">";
  $contenu.=$entetetable;
  
	$num = mysql_num_rows($ressqlpdd);
	if ($num>0)
	{
		
		while ($row = mysql_fetch_object($ressqlpdd)) {

/* all fields
 * 
 *  rowid 	tms 	fk_object 	import_key 	ppgp 	pdd 	nom2 	nom3 	numeroadresse 	titre 	adresse2 	etage 	codeporteentree 	sexe 	langue 	siteweb 	pourfacturation 	nopoint 	responsablepoint 	notaillepart 	noclassepart 	remarquepart 	dateentree 	datesortie 	notes 	resp_point 	rowid 	entity 	ref_ext 	civility 	lastname Ascending 1 	firstname 	login 	pass 	pass_crypted 	fk_adherent_type 	morphy 	societe 	fk_soc 	address 	zip 	town 	state_id 	country 	email 	skype 	phone 	phone_perso 	phone_mobile 	birth 	photo 	statut 	public 	datefin 	note_private 	note_public 	datevalid 	datec 	tms 	fk_user_author 	fk_user_mod 	fk_user_valid 	canvas 	import_key 	
10390 	2016-12-05 22:52:22 	10460 	20160903074246 	NULL	135 	NULL	NULL	2986 	Madame 	NULL	0 	NULL	NULL	NULL	NULL	-1 	135 	0 	1 	21 	NULL	0000-00-00 	NULL	NULL	NULL	10460 	1 	NULL	NULL	Allémann 	Aline 	allémanna 	NULL	NULL	1 	phy 	NULL	NULL	2 chemin du Champ-Rond 	1232 	CONFIGNON 	NULL	0 	allémanna__xx@cocagne.ch 	NULL	077.457.04.62 	NULL	NULL	NULL	NULL	1 	0 	NULL	NULL	NULL	NULL	NULL	2016-09-03 07:43:00 	1 	NULL	NULL	NULL	20160903074246
8632 	2016-12-05 22:52:22 	8702 	20160903074246 	NULL	135 	NULL	NULL	86 	Madame 	NULL	0 	NULL	NULL	NULL	NULL	-1 	135 	0 	2 	16 	NULL	NULL	NULL	NULL	NULL	8702 	1 	NULL	NULL	Arnold 	Gertrud 	tahaarnold 	NULL	NULL	1 	phy 	NULL	NULL	77 rte de Loëx 	1232 	CONFIGNON 	NULL	0 	taha-arnold@bluewin.ch 	NULL	340.14.80 	NULL	NULL	NULL	NULL	1 	0 	NULL	NULL	NULL	NULL	NULL	2016-09-03 07:42:47 	1 	NULL	NULL	NULL	20160903074246


use fields
*  *  rowid 	tms 	fk_object 	import_key 	ppgp 	pdd 	nom2 	nom3 	numeroadresse 	titre 	adresse2 	etage 	codeporteentree 	sexe 	langue 	siteweb 	pourfacturation 	nopoint 	responsablepoint 	notaillepart 	noclassepart 	remarquepart 	dateentree 	datesortie 	notes 	resp_point 	rowid 	entity 	ref_ext 	civility 	lastname Ascending 1 	firstname 	login 	pass 	pass_crypted 	fk_adherent_type 	morphy 	societe 	fk_soc 	address 	zip 	town 	state_id 	country 	email 	skype 	phone 	phone_perso 	phone_mobile 	birth 	photo 	statut 	public 	datefin 	note_private 	note_public

*/
		
		
			
				if(intval($i/2)==($i/2)){
					$classline="pair";
				} else {
					$classline="impair";
				}
				
				if($row->resp_point==1) {        
					$style="font-weight: bold";
				} else {
					$style="font-weight: normal";
				}
				
				$contenu.="<tr style=\"".$style ."\" class=\"".$classline ."\">";
				// You can use here results
				//$contenu.= "#" .$row->rowid;
        $contenu.= "<td>";
        //$contenu.= " $classline ";
		$contenu.= $row->lastname;
        $contenu.= "</td><td>";
		$contenu.= $row->firstname;
        $contenu.= "</td><td style=\"text-align: right\">";
        $ppgp=$row->ppgp;
        if($ppgp==1) {
		$ppgplib="PP";
		}elseif($ppgp==2) {
		$ppgplib="GP";
		}
        $contenu.= $ppgplib;
		$contenu.="</td>";
		
		//      
        $contenu.= "<td>";
        $contenu.= $row->address;
		$contenu.="</td>";
		
		        $contenu.= "<td>";
        $contenu.= $row->zip;
		$contenu.="</td>";
		
		        $contenu.= "<td>";
        $contenu.= $row->town;
		$contenu.="</td>";
		
		        $contenu.= "<td>";
        $contenu.= "<a href=\"mailto:".$row->email."\">".$row->email."</a>";
        
		$contenu.="</td>";
		
		        $contenu.= "<td>";
        $contenu.= $row->phone_mobile;
		$contenu.="</td>";
		
		        $contenu.= "<td>";
        $contenu.= $row->statut;
		$contenu.="</td>";
		
		        $contenu.= "<td>";
		if($row->resp_point==1) {        
        $contenu.= "oui";
		}
		$contenu.="</td>";

		
		$contenu.="</tr>\n";
			
		}
		mysql_free_result($ressqlpdd);

	}
$contenu.="</table>\n\n";

}

}
  
 //}  //tests only with pdd r. Gares end
  
}

print("<h1>Points de distribution</h1>");
echo "<div id=\"tdm\"><ul>".$entete."</ul></div>";
echo "<hr style=\"margin: 1em\"/>";
echo utf8_encode($contenu);

?>

