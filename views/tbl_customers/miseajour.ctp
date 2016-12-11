<?php
echo "Demander à Fred";
exit;
		#todo before miseajour PDD http://129.194.18.217/cocagne/cake/jos_pdds/miseajour todo corriger serveur
#preparation des donnees
$sql="
ALTER TABLE `PERSPersonne` CHANGE `PersLogin` `PersLogin` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
";
$sql=mysql_query($sql);
if(!$sql) {
	echo "Erreur MySQL:<br>" .mysql_error(); exit;
}

/*
UPDATE `lesjardinsdecocagnech`.`PERSPersonne` SET `PersLogin` = 'ClaudeTest' WHERE `PERSPersonne`.`PersNo` =118 AND `PERSPersonne`.`PersPDDDistrNo` =1 AND `PERSPersonne`.`PersLogin` = 'Claude' AND `PERSPersonne`.`PersPasswd` = '654321' AND `PERSPersonne`.`PersNom` = 'Mudry' AND `PERSPersonne`.`PersPrenom` = '' AND `PERSPersonne`.`PersAdresse` = '' AND `PERSPersonne`.`PersTelephone` = '' AND `PERSPersonne`.`PersNPA` = '' AND `PERSPersonne`.`PersLocalite` = '' AND `PERSPersonne`.`PersAdresseEmail` = 'claude.mudry@wanadoo.fr' LIMIT 1 ;

bcp trop long, à abandonner!!! trouver une autre solution pour la gestion des doublons des cocagnards //todo

$sql="
ALTER TABLE `PERSPersonne` ADD UNIQUE (
`PersLogin`
)
";
$sql=mysql_query($sql);
if(!$sql) {
	echo "Erreur MySQL:<br>" .mysql_error(); exit;
}


#donnes a importer sont normalisees, index = PersLogin: ABANDONNE
*/
$sql="SELECT *
FROM `PERSPersonne` 
ORDER BY PersNom, PersPrenom";
$sql=mysql_query($sql);
if(!$sql) {
	echo "Erreur MySQL:<br>" .mysql_error(); exit;
}
$i=0; $ok=$mezzo=$ko=0; $total=mysql_num_rows($sql);
while($i<mysql_num_rows($sql)){
	echo "<hr>" .mysql_result($sql,$i,'id');
#	$PDDINo=mysql_result($sql,$i,'PDDINo');
	$PersLogin=mysql_result($sql,$i,'PersLogin');
	$nom=mysql_result($sql,$i,'PersNom');
	$prenom=mysql_result($sql,$i,'PersPrenom');
	$ssql="
	SELECT * FROM jos_users,tbl_customers 
	WHERE 
	jos_users.username LIKE '" .$PersLogin ."' 
	AND jos_users.id=`tbl_customers`.`jos_user_id`
	";
	#echo $ssql."<br>"; //tests
	$ssql=mysql_query($ssql);
		if(!$ssql) {
			echo "Erreur MySQL:<br>" .mysql_error(); exit;
		}
		if(mysql_num_rows($ssql)==1) { //exact match
		$ok++;
			echo "<div style=\"background-color: #90EE90\">OK<br>";
		} else {
				$ssql="
	SELECT * FROM jos_users
	WHERE 
	jos_users.username LIKE '%" .$PersLogin ."%' OR 
	jos_users.name LIKE '%" .$PersLogin ."%' OR	
	jos_users.email LIKE '%" .$PersLogin ."%' OR 
	jos_users.username LIKE '%" .$nom ."%' OR 
	jos_users.username LIKE '%" .$prenom ."%'
	";
	#echo $ssql."<br>"; //tests
	$ssql=mysql_query($ssql);
					if(mysql_num_rows($ssql)==1) { //exact match
					$ok++;
								echo "<div style=\"background-color: #FFF3B1\">OK now todo check clients<br>";

					} elseif(mysql_num_rows($ssql)>1) { //exact match not really
					$mezzo++;
								echo "<div style=\"background-color: ##FFA500\">more than 1 rec, todo identify and check clients<br>";

					} else {
						 $ko++;
			echo "<div>";
		}
		}
			echo $PersLogin ."<br>";
		echo mysql_num_rows($ssql);
echo "</div>";
		#exit;
	/*
	if(mysql_num_rows($ssql)!=1) {
			echo "<br><span style=\"color: red\">ADD " .mysql_result($sql,$i,'PDDTexte') ." ?</span><br>";
			#echo "<br>Ori: " .mysql_result($ssql,0,'PDDTexte') ."<br>";
			echo "<br>New pdd: " .mysql_result($sql,$i,'PDDINo') ."<br>";
			echo $html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id')));

			$insere=mysql_query("INSERT INTO `jos_pdds` (SELECT * FROM PDDDistr WHERE PDDINo=".$PDDINo.")");
			if(!$insere) {
					echo "<br>Erreur MySQL:<br>" .mysql_error();

			}

	} else {
		#PDDTexte 
		#if(mysql_result($sql,$i,'PDDTexte')!=mysql_result($ssql,0,'PDDTexte')) {
		#if(mysql_result($sql,$i,'PDDTexte')!=utf8_encode(mysql_result($ssql,0,'PDDTexte'))) {
		if(mysql_result($sql,$i,'PDDTexte')!=utf8_decode(mysql_result($ssql,0,'PDDTexte'))) {
						echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

		#if(utf8_encode(mysql_result($sql,$i,'PDDTexte'))!=mysql_result($ssql,0,'PDDTexte')) {
		#if(utf8_encode(mysql_result($sql,$i,'PDDTexte'))!=utf8_encode(mysql_result($ssql,0,'PDDTexte'))) {
		#if(utf8_encode(mysql_result($sql,$i,'PDDTexte'))!=utf8_decode(mysql_result($ssql,0,'PDDTexte'))) {
		#if(utf8_decode(mysql_result($sql,$i,'PDDTexte'))!=mysql_result($ssql,0,'PDDTexte')) {
		#if(utf8_decode(mysql_result($sql,$i,'PDDTexte'))!=utf8_encode(mysql_result($ssql,0,'PDDTexte'))) {
		#if(utf8_decode(mysql_result($sql,$i,'PDDTexte'))!=utf8_decode(mysql_result($ssql,0,'PDDTexte'))) {
			echo "PDDTEXTE: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDTexte')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDTexte')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDTexte='".utf8_encode(mysql_result($sql,$i,'PDDTexte')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDNom 
		if(mysql_result($sql,$i,'PDDNom')!=utf8_decode(mysql_result($ssql,0,'PDDNom'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDNom: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDNom')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDNom')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDNom='".utf8_encode(mysql_result($sql,$i,'PDDNom')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDAdr 
		if(mysql_result($sql,$i,'PDDAdr')!=utf8_decode(mysql_result($ssql,0,'PDDAdr'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDAdr: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDAdr')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDAdr')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDAdr='".utf8_encode(mysql_result($sql,$i,'PDDAdr')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDNoRue 
		if(mysql_result($sql,$i,'PDDNoRue')!=mysql_result($ssql,0,'PDDNoRue')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDNoRue: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDNoRue')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDNoRue')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDNoRue='".utf8_encode(mysql_result($sql,$i,'PDDNoRue')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDTele 
		if(mysql_result($sql,$i,'PDDTele')!=mysql_result($ssql,0,'PDDTele')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDTele: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDTele')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDTele')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDTele='".utf8_encode(mysql_result($sql,$i,'PDDTele')) ."' WHERE PDDINo=".$PDDINo);
		}
		#PDDLieu 
		if(mysql_result($sql,$i,'PDDLieu')!=utf8_decode(mysql_result($ssql,0,'PDDLieu'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDLieu: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDLieu')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDLieu')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDLieu='".utf8_encode(mysql_result($sql,$i,'PDDLieu')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDEmail 
		if(mysql_result($sql,$i,'PDDEmail')!=mysql_result($ssql,0,'PDDEmail')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDEmail: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDEmail')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDEmail')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDEmail='".utf8_encode(mysql_result($sql,$i,'PDDEmail')) ."' WHERE PDDINo=".$PDDINo);
		}
		#PDDRem 
		if(mysql_result($sql,$i,'PDDRem')!=utf8_decode(mysql_result($ssql,0,'PDDRem'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDRem: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDRem')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDRem')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDRem='".utf8_encode(mysql_result($sql,$i,'PDDRem')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDGP 
		if(mysql_result($sql,$i,'PDDGP')!=mysql_result($ssql,0,'PDDGP')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDGP: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDGP')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDGP')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDGP='".utf8_encode(mysql_result($sql,$i,'PDDGP')) ."' WHERE PDDINo=".$PDDINo);
		}
		#PDDPP 
		if(mysql_result($sql,$i,'PDDPP')!=mysql_result($ssql,0,'PDDPP')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDPP: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDPP')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDPP')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDPP='".utf8_encode(mysql_result($sql,$i,'PDDPP')) ."' WHERE PDDINo=".$PDDINo);
		}
	}


		*/
		
	$i++;
	}

echo "<hr>Total: " .$total ." OK: " .$ok ." mezzo: " .$mezzo ." ko: " .$ko;

exit;


















$sql="SELECT *
FROM `PDDDistr` ORDER BY id";
$sql=mysql_query($sql);
if(!$sql) {
	echo "Erreur MySQL:<br>" .mysql_error(); exit;
}
$i=0;
while($i<mysql_num_rows($sql)){
	echo "<hr>" .mysql_result($sql,$i,'id');
	$PDDINo=mysql_result($sql,$i,'PDDINo');
	$ssql="SELECT * FROM jos_pdds WHERE PDDINo='" .$PDDINo ."'";
	$ssql=mysql_query($ssql);
		if(!$ssql) {
			echo "Erreur MySQL:<br>" .mysql_error(); exit;
		}
	if(mysql_num_rows($ssql)!=1) {
			echo "<br><span style=\"color: red\">ADD " .mysql_result($sql,$i,'PDDTexte') ." ?</span><br>";
			#echo "<br>Ori: " .mysql_result($ssql,0,'PDDTexte') ."<br>";
			echo "<br>New pdd: " .mysql_result($sql,$i,'PDDINo') ."<br>";
			echo $html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id')));

			$insere=mysql_query("INSERT INTO `jos_pdds` (SELECT * FROM PDDDistr WHERE PDDINo=".$PDDINo.")");
			if(!$insere) {
					echo "<br>Erreur MySQL:<br>" .mysql_error();

			}

	} else {
		#PDDTexte 
		#if(mysql_result($sql,$i,'PDDTexte')!=mysql_result($ssql,0,'PDDTexte')) {
		#if(mysql_result($sql,$i,'PDDTexte')!=utf8_encode(mysql_result($ssql,0,'PDDTexte'))) {
		if(mysql_result($sql,$i,'PDDTexte')!=utf8_decode(mysql_result($ssql,0,'PDDTexte'))) {
						echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

		#if(utf8_encode(mysql_result($sql,$i,'PDDTexte'))!=mysql_result($ssql,0,'PDDTexte')) {
		#if(utf8_encode(mysql_result($sql,$i,'PDDTexte'))!=utf8_encode(mysql_result($ssql,0,'PDDTexte'))) {
		#if(utf8_encode(mysql_result($sql,$i,'PDDTexte'))!=utf8_decode(mysql_result($ssql,0,'PDDTexte'))) {
		#if(utf8_decode(mysql_result($sql,$i,'PDDTexte'))!=mysql_result($ssql,0,'PDDTexte')) {
		#if(utf8_decode(mysql_result($sql,$i,'PDDTexte'))!=utf8_encode(mysql_result($ssql,0,'PDDTexte'))) {
		#if(utf8_decode(mysql_result($sql,$i,'PDDTexte'))!=utf8_decode(mysql_result($ssql,0,'PDDTexte'))) {
			echo "PDDTEXTE: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDTexte')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDTexte')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDTexte='".utf8_encode(mysql_result($sql,$i,'PDDTexte')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDNom 
		if(mysql_result($sql,$i,'PDDNom')!=utf8_decode(mysql_result($ssql,0,'PDDNom'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDNom: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDNom')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDNom')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDNom='".utf8_encode(mysql_result($sql,$i,'PDDNom')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDAdr 
		if(mysql_result($sql,$i,'PDDAdr')!=utf8_decode(mysql_result($ssql,0,'PDDAdr'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDAdr: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDAdr')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDAdr')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDAdr='".utf8_encode(mysql_result($sql,$i,'PDDAdr')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDNoRue 
		if(mysql_result($sql,$i,'PDDNoRue')!=mysql_result($ssql,0,'PDDNoRue')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDNoRue: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDNoRue')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDNoRue')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDNoRue='".utf8_encode(mysql_result($sql,$i,'PDDNoRue')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDTele 
		if(mysql_result($sql,$i,'PDDTele')!=mysql_result($ssql,0,'PDDTele')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDTele: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDTele')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDTele')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDTele='".utf8_encode(mysql_result($sql,$i,'PDDTele')) ."' WHERE PDDINo=".$PDDINo);
		}
		#PDDLieu 
		if(mysql_result($sql,$i,'PDDLieu')!=utf8_decode(mysql_result($ssql,0,'PDDLieu'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDLieu: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDLieu')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDLieu')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDLieu='".utf8_encode(mysql_result($sql,$i,'PDDLieu')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDEmail 
		if(mysql_result($sql,$i,'PDDEmail')!=mysql_result($ssql,0,'PDDEmail')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDEmail: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDEmail')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDEmail')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDEmail='".utf8_encode(mysql_result($sql,$i,'PDDEmail')) ."' WHERE PDDINo=".$PDDINo);
		}
		#PDDRem 
		if(mysql_result($sql,$i,'PDDRem')!=utf8_decode(mysql_result($ssql,0,'PDDRem'))) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDRem: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDRem')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDRem')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDRem='".utf8_encode(mysql_result($sql,$i,'PDDRem')) ."' WHERE PDDINo=".$PDDINo);
		}
		
		#PDDGP 
		if(mysql_result($sql,$i,'PDDGP')!=mysql_result($ssql,0,'PDDGP')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDGP: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDGP')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDGP')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDGP='".utf8_encode(mysql_result($sql,$i,'PDDGP')) ."' WHERE PDDINo=".$PDDINo);
		}
		#PDDPP 
		if(mysql_result($sql,$i,'PDDPP')!=mysql_result($ssql,0,'PDDPP')) {
									echo "<br>" .$html->link(__('Edit', true), array('action'=>'edit', mysql_result($sql,$i,'id'))) ."<br>";

			echo "PDDPP: <ul><li><span color=\"#FFA500\">" .utf8_encode(mysql_result($sql,$i,'PDDPP')) ."</span> -> <span color=\"#00FF00\">".utf8_encode(mysql_result($ssql,0,'PDDPP')) ."</span></li></ul>";
			$update=mysql_query("UPDATE jos_pdds SET PDDPP='".utf8_encode(mysql_result($sql,$i,'PDDPP')) ."' WHERE PDDINo=".$PDDINo);
		}
	}


		
		
	$i++;
	}

?>
