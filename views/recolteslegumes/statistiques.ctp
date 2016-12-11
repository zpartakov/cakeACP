<?php
Configure::write('debug', 0);
/* begin strange stuff I had to copy in order to make css and js work...*/

function dateSQLfr($date) {
	$date=explode("-",$date);
	$date=$date[2] ."-" .$date[1] ."-" .$date[0];
	echo $date;
}

function printlegume($legume, $dateDeb, $dateFin, $terrain) {
		//affichage détails légume
		$sqll="
	SELECT 
	nb_GP, 
	kg_pce_par_cornet_GP, 
	nb_PP, 
	kg_pce_par_cornet_PP, 
	prixminPER, 
	prixmaxPER, 
	prixminBIO,
	prixmaxBIO, 
	prixfracp,
	c.lib, 
	l.lib, 
	r.date,
	rl.id,
	u.lib,   
	rl.cornets_par_caisse_GP, 
	rl.cornets_par_caisse_PP 
	FROM recolteslegumes as rl, legumes as l, recoltes as r, classifications as c, unites AS u 
	WHERE r.date>= '".$dateDeb ."' 
	AND r.date <= '" .$dateFin ."'
	AND r.id=rl.recolte_id 
	AND rl.legume_id=l.id 
	AND rl.unite_id=u.id 
	AND c.id=l.classification_id ";

	if($terrain>0) {
		$sqll.="AND rl.terrain_id=" .$terrain ." ";
		
	}
		$sqll.="AND rl.legume_id=" .$legume ." ";
	
	
	//echo nl2br($sqll);
	
	$sqll=mysql_query($sqll);
	if(!$sqll) {
		echo "<br>SQL error: ".mysql_error() ."<br>"; exit;
	}
/*print only of # > 1 */
if(mysql_num_rows($sqll)>0){	
		echo "<h2>" .mysql_result($sqll,0,'l.lib') ."</h2>";

//debut tableau
		echo "<table>
	<tr><th>Date</th><th>Unité</th><th>QtéGP</th><th>QtéPP</th><th>Qté Total</th>
<th>prixminPER</th>
<th>prixmaxPER</th>
<th>prixminBIO</th>
<th>prixmaxBIO</th>
<th>Prix moyen</th>
<th>prix FRACP</th>
<th>Valeur</th></tr>";

//def variables
	$i=0; $i2=0; $prixtot=0; $qGP=0; $qPP=0; $qT=0; $qGPtot=0; $qPPtot=0; $qTot=0; $prixtot=0; $prixmoyenT=0; $prixtotACP=0;

	//begin loop
	while($i<mysql_num_rows($sqll)) {
		if(($i2/2)==(intval($i2/2))) {
			$class="altrow";
		} else {
			$class="";
		}
		
		//par kg ou par piece?
		if(mysql_result($sqll,$i,'u.lib')=="kg"){
				$diviseur=1000;
		 }elseif (mysql_result($sqll,$i,'u.lib')=="pièce"){
				$diviseur=1;
		} 
		
		//GP
		//cornet ou kg?		
		if(mysql_result($sqll,$i,'rl.kg_pce_par_cornet_GP')>0){
			$qGP=mysql_result($sqll,$i,'rl.kg_pce_par_cornet_GP');
		} elseif (mysql_result($sqll,$i,'rl.cornets_par_caisse_GP')>0){
			$qGP=mysql_result($sqll,$i,'rl.cornets_par_caisse_GP');
		} else {
			$qGP=0;
		}	
				
		//PP
		//cornet ou kg?		
		if(mysql_result($sqll,$i,'rl.kg_pce_par_cornet_PP')>0){
			$qPP=mysql_result($sqll,$i,'rl.kg_pce_par_cornet_PP');
		} elseif (mysql_result($sqll,$i,'rl.cornets_par_caisse_PP')>0){
			$qPP=mysql_result($sqll,$i,'rl.cornets_par_caisse_PP');
		} else {
			$qPP=0;
		}
		
		
		//calcul prix moyen
		$prixminPER=mysql_result($sqll,$i,'rl.prixminPER');
		$prixmaxPER=mysql_result($sqll,$i,'rl.prixmaxPER');
		$prixminBIO=mysql_result($sqll,$i,'rl.prixminBIO');
		$prixmaxBIO=mysql_result($sqll,$i,'rl.prixmaxBIO');
		$prixfracp=mysql_result($sqll,$i,'rl.prixfracp');
		$PER=($prixminPER+$prixmaxPER)/2;
		$BIO=($prixminBIO+$prixmaxBIO)/2;
		$pm=($PER+$BIO)/2;


		/*	<tr><th>Date</th><th>Unité</th><th>QtéGP</th><th>QtéPP</th><th>Qté Total (kg)</th><th>Prix moyen</th><th>Valeur</th></tr>";*/
	
	echo "<tr class=\"".$class ."\">";
		echo  "<td>"; //date
		dateSQLfr(mysql_result($sqll,$i,'r.date'));
		echo  "</td><td>";//unité
		echo mysql_result($sqll,$i,'u.lib');
		echo  "</td><td>";//QtéGP
		echo mysql_result($sqll,$i,'kg_pce_par_cornet_GP');
			$qGPtot=$qGPtot+mysql_result($sqll,$i,'kg_pce_par_cornet_GP');
		echo "</td><td>";//	QtéPP
		echo mysql_result($sqll,$i,'kg_pce_par_cornet_PP');
			$qPPtot=$qPPtot+mysql_result($sqll,$i,'kg_pce_par_cornet_PP');
		echo "</td><td>";
		$q=intval(((mysql_result($sqll,$i,'nb_GP')*$qGP)
				+(mysql_result($sqll,$i,'nb_PP')*$qPP))/$diviseur);
		#echo "<font color=red>xxxx</font>";
		echo $q;
		$qTot=$qTot+$q;
		echo "</td><td>";	//prixminPER 	prixmaxPER 	prixminBIO 	prixmaxBIO 		
		
		echo $prixminPER;
		echo "</td><td>";
		echo $prixmaxPER;
		echo "</td><td>";
		echo $prixminBIO;
		echo "</td><td>";
		echo $prixmaxBIO;
		
		echo "</td><td>"; //Prix moyen
		echo ($pm*100)/100;
		$prixmoyenT=$prixmoyenT+intval($pm*100)/100;

		echo "</td><td>"; //Prix moyen
		echo intval($prixfracp*100)/100;
	
	

		echo "</td><td>";//Valeur
		echo "<a href=\"/intranet/cultures/recolteslegumes/edit/"
		.mysql_result($sqll,$i,'rl.id') ."\">";
		echo intval($pm*$q);
		//echo ".-" ;
		echo "</a>";
		$prixtot=$prixtot+($pm*$q);
		$prixtotACP=$prixtotACP+$prixfracp;
			echo "</td></tr>";
	$i2++; $i++;
	}
//totaux
	echo "<tr>
	<td colspan=\"2\">
	<strong>Total</strong></td>
	<td>".$qGPtot."</td><td>".$qPPtot
	."</td><td>".$qTot."</td>
	<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td></td>
	<td>" .intval($prixmoyenT/mysql_num_rows($sqll)) 
	."</td>
	<td>".$prixtotACP."</td>
	<td><strong><u>" .intval($prixtot) ."</u>";
	//echo ".-";
	echo "</strong></td></tr>";
		echo "</table>";
						echo "<hr />";

}
}

/* ######### END FUNCTIONS ##########
 * */
?>
<link rel="stylesheet" type="text/css" href="/cocagne/intranet/cultures/alaxos/css/alaxos.css" />
	<script type="text/javascript" src="/cocagne/intranet/cultures/alaxos/js/datepicker/js/datepicker.js"></script>
	<script type="text/javascript" src="/cocagne/intranet/cultures/alaxos/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="/cocagne/intranet/cultures/alaxos/js/jquery/jquery_no_conflict.js"></script>

	<script type="text/javascript">
//<![CDATA[
var date_format = "d.m.y";
//]]>
</script>
	<script type="text/javascript">
//<![CDATA[
var application_root = "/intranet/cultures/";
//]]>
</script>
	<script type="text/javascript" src="/cocagne/intranet/cultures/alaxos/js/alaxos/alaxos.js"></script>
	<link rel="stylesheet" type="text/css" href="/cocagne/intranet/cultures/alaxos/css/datepicker.css" /><script type="text/javascript" src="/cocagne/intranet/cultures/js/jquery-1.5.1.js"></script><script type="text/javascript" src="/cocagne/intranet/cultures/js/scrolltopcontrol.js"></script><script type="text/javascript" src="/cocagne/intranet/cultures/js/cultures.js"></script>
<?php
/* end strange stuff I had to copy in order to make css and js work...*/
?>
<style>
td {text-align: right;}
</style>	
<?php
//Configure::write('debug', 0);
//debug($legumes);
$dateDeb=$_POST['data']['dateDeb'];
$dateFin=$_POST['data']['dateFin'];
$terrain=$_POST['terrain'];
$legume=$_POST['legume'];
#echo phpinfo();
?>
<div class="recolteslegumes index">
<?php
/* ################ BEGIN: PRINT FORM ############### */
if(!isset($dateDeb)) {
	?>
	<h2><?php ___('Statistiques légumières');?></h2>
	<table>
	<form id="statistiquesStatistiquesForm" method="post" action="" accept-charset="utf-8">
	<tr>
		<td>Date début</td>
		<td>
		<?php 
		echo $this->AlaxosForm->input('dateDeb', array('label' => false,'value'=>'01.01.'.date("Y"),'class'=>'inputDate format-d-m-y divider-dot')); 
		?>
		</td>
	</tr>
	<tr>
		<td>Date fin</td>
		<td><?php
			echo $this->AlaxosForm->input('dateFin', array('label' => false,'value'=>date("d.m.Y"),'class'=>'inputDate format-d-m-y divider-dot')); 		
			?>
		</td>
	</tr>
	<tr>
	<td>Terrain</td>
		<td>
		<select name="terrain">
		<option value="" selected>*** Tous ***</option>
		<?php
			foreach ($terrains as $key => $value) {
				  echo "<option value=\"" .$key ."\">" .$value ."</option>\n";
			}
		?>
		</select>
		</td>
	</tr>
	<tr>
	<td>Légumes</td>
		<td>
		<select name="legume">
		<option value="" selected>*** Tous ***</option>
		<?php
			foreach ($legumes as $key => $value) {
				  echo "<option value=\"" .$key ."\">" .$value ."</option>\n";
			}
		?>
		</select>
		</td>

	</tr>
	<tr>
		<td colspan="2">
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?>
		</td>
	</tr>
	</table>
	<?php
	/* ################ END: PRINT FORM ############### */

} else {
	/* ################## form has been filled up, print results of the query ################################
	 *  */
	echo "<h2>Résultats</h2>";
	echo "Données du " .$dateDeb ." au " .$dateFin ."<br/>";
		if($terrain>0) {
			$zeterrain=mysql_query("SELECT lib FROM terrains WHERE id=".$terrain);
			echo "<br /><h3>Terrain: " .mysql_result($zeterrain,0,'lib') ."</h3>";
		}
	$dateDeb=explode(".",$dateDeb);
	$dateDeb=$dateDeb[2] ."-" .$dateDeb[1] ."-" .$dateDeb[0];
	$dateFin=explode(".",$dateFin);
	$dateFin=$dateFin[2] ."-" .$dateFin[1] ."-" .$dateFin[0];
	 #echo "<div class=\"debug\">".nl2br($sql)."</div>"; 
		if($legume>0) {
			/* begin specific vegetable correct £*/
			printlegume($legume, $dateDeb, $dateFin, $terrain);
		} else {
			$legumes="SELECT * FROM legumes ORDER BY lib";
			$legumes=mysql_query($legumes);
			$i=0; 
			while($i<mysql_num_rows($legumes)) {
				printlegume(mysql_result($legumes,$i,'id'),$dateDeb, $dateFin, $terrain);
#echo mysql_result($legumes,$i,'id') ."<br>";
				$i++;
			}
		}

	?>
				<p><?php echo $html->link('Retour Statistiques légumes', '/recolteslegumes/statistiques', array('title'=>'Retour Statistiques légumes')); ?></p>

		
		
	<?	
}
?>
</div>
