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

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=export.csv");
header("Pragma: no-cache");
header("Expires: 0");


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
$entetetable="Nom;Prénom;GP/PP;";
$entetetable.="Adresse;Code postal;Ville;email;Natel;Statut;Resp. point;";
//address zip town email phone_mobile statut resp_point
$entetetable.="";

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
  //$contenu.=$entetetable;
  
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
		
		

				
				$contenu.="";
				// You can use here results
				//$contenu.= "#" .$row->rowid;
        $contenu.= "";
         $contenu.=$pdd_id.";".utf8_decode($pdd_name) .";";

        //$contenu.= " $classline ";
		$contenu.= $row->lastname;
        $contenu.= ";";
		$contenu.= $row->firstname;
        $contenu.= ";";
        $ppgp=$row->ppgp;
        if($ppgp==1) {
		$ppgplib="PP";
		}elseif($ppgp==2) {
		$ppgplib="GP";
		}
        $contenu.= $ppgplib;
		$contenu.=";";
		
		//      
        $contenu.= "";
        $contenu.= $row->address;
		$contenu.=";";
		
		        $contenu.= "";
        $contenu.= $row->zip;
		$contenu.=";";
		
		        $contenu.= "";
        $contenu.= $row->town;
		$contenu.=";";
		
		        $contenu.= "";
        $contenu.= $row->email;
        
		$contenu.=";";
		
		        $contenu.= "";
        $contenu.= $row->phone_mobile;
		$contenu.=";";
		
		        $contenu.= "";
        $contenu.= $row->statut;
		$contenu.=";";
		
		        $contenu.= "";
		if($row->resp_point==1) {        
        $contenu.= "oui";
		}
		$contenu.=";";

		
		$contenu.="\n";
		//$contenu.="\r";
			
		}
		mysql_free_result($ressqlpdd);

	}
$contenu.="";

}

}
  
 //}  //tests only with pdd r. Gares end
  
}

echo "Points de distribution\n";
echo $entetetable."\n";
$contenu= utf8_encode($contenu);
$contenu = '"' . preg_replace('/"/','""',$contenu) . '"';

$contenu = preg_replace('/^\"/','',$contenu);
$contenu = preg_replace('/_x000D_\n/','',$contenu);


echo $contenu;
echo "\r";
echo "quelques enregistrements a nettoyer a la main";
?>
