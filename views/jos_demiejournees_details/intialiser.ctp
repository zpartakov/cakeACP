<?php
/*
 * calcul nbre de jours à générer, à changer dans les valeurs défaut
 */
$njag="SELECT * FROM cocagne_defaults WHERE lib = 'DJ_def_n_jours_initialiser'";
$njag=mysql_query($njag);
if(!$njag) { echo mysql_error(); exit;}
$njag=mysql_result($njag,0,'n');

/*
 * calcul du nombre d'heures pour chaque jour de la semaine, 4 tranches horaires
 */

$nhj="SELECT * FROM jos_demiejournees_default_schedules ORDER BY id";
$nhj=mysql_query($nhj);
if(!$nhj) { echo mysql_error(); exit;}
$i=0;
while($i<mysql_num_rows($nhj)) {
	//lundis
	if(mysql_result($nhj,$i,'jourheure')=="LundiMatin") {
		$LundiMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="LundiApresMidi") {
		$LundiApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="LundiSoir") {
		$LundiSoir=mysql_result($nhj,$i,'LundiSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="LundiLivraison") {
		$LundiLivraison=mysql_result($nhj,$i,'npers');
	//mardis	
	} elseif(mysql_result($nhj,$i,'jourheure')=="MardiMatin") {
		$MardiMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="MardiApresMidi") {
		$MardiApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="MardiSoir") {
		$MardiSoir=mysql_result($nhj,$i,'MardiSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="MardiLivraison") {
		$MardiLivraison=mysql_result($nhj,$i,'npers');
	//mercredis	
	} elseif(mysql_result($nhj,$i,'jourheure')=="MercrediMatin") {
		$MercrediMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="MercrediApresMidi") {
		$MercrediApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="MercrediSoir") {
		$MercrediSoir=mysql_result($nhj,$i,'MercrediSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="MercrediLivraison") {
		$MercrediLivraison=mysql_result($nhj,$i,'npers');
	//jeudis
	} elseif(mysql_result($nhj,$i,'jourheure')=="JeudiMatin") {
		$JeudiMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="JeudiApresMidi") {
		$JeudiApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="JeudiSoir") {
		$JeudiSoir=mysql_result($nhj,$i,'JeudiSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="JeudiLivraison") {
		$JeudiLivraison=mysql_result($nhj,$i,'npers');
	//vendredis	
	} elseif(mysql_result($nhj,$i,'jourheure')=="VendrediMatin") {
		$VendrediMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="VendrediApresMidi") {
		$VendrediApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="VendrediSoir") {
		$VendrediSoir=mysql_result($nhj,$i,'VendrediSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="VendrediLivraison") {
		$VendrediLivraison=mysql_result($nhj,$i,'npers');
	//samedis	
	} elseif(mysql_result($nhj,$i,'jourheure')=="SamediMatin") {
		$SamediMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="SamediApresMidi") {
		$SamediApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="SamediSoir") {
		$SamediSoir=mysql_result($nhj,$i,'SamediSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="SamediLivraison") {
		$SamediLivraison=mysql_result($nhj,$i,'npers');
	//dimanches	
	} elseif(mysql_result($nhj,$i,'jourheure')=="DimancheMatin") {
		$DimancheMatin=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="DimancheApresMidi") {
		$DimancheApresMidi=mysql_result($nhj,$i,'npers');
	} elseif(mysql_result($nhj,$i,'jourheure')=="DimancheSoir") {
		$DimancheSoir=mysql_result($nhj,$i,'DimancheSoir');
	} elseif(mysql_result($nhj,$i,'jourheure')=="DimancheLivraison") {
		$DimancheLivraison=mysql_result($nhj,$i,'npers');
	}
	$i++;
}

/*
 * initialisation de variables
 */

$jourL=date("D");
$jour=date("d");
$mois=date("m");
$moisL=date("m");
$annee=date("Y");
$tab_jour = array(1 => 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
$datel=date("l jS \of F Y h:i:s A",mktime(0,0,0,$mois,$jour,$annee));
$num_jour = date('N');
$nom_jour = $tab_jour[$num_jour];

/*
 * search existing records
 * 
 * */

$lastDate="SELECT * FROM `jos_demiejournees` ORDER BY 'date' DESC";
$lastDate=mysql_query($lastDate);
$lastDateN=mysql_num_rows($lastDate);
if(!$lastDate){
	echo "SQL error: " .mysql_error();
	exit;
}

/*
 * calcul début et fin des dates
 */

if($lastDateN<1){
	$aujourdhui=date("U");
	$startday=$aujourdhui+(24*3600);
	$test=1;
} else {
	$startday=mysql_result($lastDate,0,'date');
	$la_date    = explode(' ', $startday); // on decompose la date SQL
	$heure_sql= explode(':',$la_date[1]); // On prend la partie heure
	$heure = $heure_sql[0]; // La variable de l'heure
	$minutes = $heure_sql[1]; // La variable des minutes
	$secondes = $heure_sql[2]; // la variable des secondes
	$date_sql    = explode('-',$la_date[0]); // On prend la partie date
	$annee = $date_sql[0]; // La variable des annees
	$num_mois = $date_sql[1]; // La variable du numero du mois
	$num_jour = $date_sql[2]; // Le numero du jour
	#mktime  ($hour, $minute, $second, $month, $day, $year)
	$startday= date("U", mktime($heure, $minutes, $secondes, $num_mois,$num_jour,$annee ));	 
	#$startday=strftime("U",$startday);
	$startday=$startday+(12*3600); //on ajoute 12h à 18h->lendemain à 8h
	$test=0;
}

/*
 * ##############################################
	################ begin insertion #############
 */

$i=0;
while($i<$njag){
	######### MATIN ###########
	$ladate=date("Y-m-d"." 08:00:00",$startday); //matin
	#calcul du jour
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	
	# calcul du statut
	/*
	 * on travaille uniquement le samedi matin, pour les autres jours: statut=0
	 * 
	 */
	if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="mercredi"||$nom_jour=="jeudi"||$nom_jour=="vendredi"||$nom_jour=="dimanche"){
		$statut=0;	
	} else {
		$statut=1;
	}	
	#nombre d'heures
	if($nom_jour=="samedi") {
		$nh2do=$SamediMatin;
	} else {
		$nh2do=0;
	}
	
	if($statut==1 && $nh2do>0) {
		$ladateS="
		INSERT INTO `jos_demiejournees` (
		`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
		) VALUES (
		NULL , '" .$ladate ."', '', '" .$nh2do ."', '" .$statut ."', ''
		);";
		//echo $ladateS ."<br>";//tests
		$ladateSQL=mysql_query($ladateS);
		if(!$ladateSQL){
			//echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
		}
	}
	######### APRES-MIDI ###########
	$ladate=date("Y-m-d"." 14:00:00",$startday); //après-midi
	#calcul du jour et du statut
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	
	/* pas de travail l'après-midi */
	
			$statut=0;	
	
		#nombre d'heures

	if($statut==1 && $nh2do>0) {
	
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_demiejournees` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate ."', '', '" .$nh2do ."', '" .$statut ."', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		//echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
	}

######### PANIERS ###########
$ladate1=date("Y-m-d"." 17:00:00",$startday); //DEBUT SOIREE
$ladate=date("Y-m-d"." 18:00:00",$startday); // SOIR TARD
	#calcul du jour et du statut
	$num_jour = date('N',$startday);
	$nom_jour = $tab_jour[$num_jour];
	#if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="dimanche"){
	if($nom_jour=="lundi"||$nom_jour=="mardi"||$nom_jour=="mercredi"||$nom_jour=="vendredi"||$nom_jour=="samedi"||$nom_jour=="dimanche"){
			$statut=0;	
	} else {
		$statut=1;
	}	
	
	
	if($nom_jour=="jeudi") {
		$nh2do=$JeudiLivraison;
	} else {
		$nh2do=0;
	}
			
	if($statut==1 && $nh2do>0) {

	//debut soiree
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_demiejournees` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate1 ."', '', '" .$nh2do ."', '" .$statut ."', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		//echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
	
	
	//fin soiree
	#calcul SQL
	$ladateS="
	INSERT INTO `jos_demiejournees` (
	`id`, `date`, `type`, `nplaces`, `statut`, `REMARQUES`
	) VALUES (
	NULL , '" .$ladate ."', '', '" .$nh2do ."', '" .$statut ."', ''
	);";
	#echo $ladateS ."<br>";//tests
	$ladateSQL=mysql_query($ladateS);
	if(!$ladateSQL){
		//echo "Error on ssql query:<br>" .$ladateS ."<br>" .mysql_error();
	}
	}
	
	$i++; //on increment le compteur
	$startday=$startday+(24*3600); //on ajoute un jour
}

	#header("Location: " .$_SERVER["HTTP_REFERER"]); //return to previous page
	echo "Les demi-journées ont été initialisées<p><a href=\"" .CHEMIN ."\">Retour</a></p>";
	exit();
?>
