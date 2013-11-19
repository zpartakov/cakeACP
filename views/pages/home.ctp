<?php
App::import('Lib', 'functions'); //imports app/libs/functions 
if($session->read('Auth.User.role')) {
			#echo "Bienvenue, " .$session->read('Auth.User.username');
			#echo "<br>Ton groupe: " .$session->read('Auth.User.role')."<br>";
			#echo "<br>Ton id: " .$session->read('Auth.User.id')."<br>";
}
$this->pageTitle = 'Accueil intranet p2r.ch'; 
if($session->read('Auth.User.role')=="administrator") {
?>
<h1><?php echo $this->pageTitle;?></h1>
<h2>Configuration générale</h2>
<li><a href="<? echo RACINEDIR;?>/cocagne_defaults/">Valeurs par défaut</a></li>

<h2>Demi-journées</h2>
<!--<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/liste">Programmation des demi-journées</a></li>-->
<li><a href="<? echo RACINEDIR;?>/demijournees/">Inscriptions membres</a></li>
			<li><a href="<? echo RACINEDIR;?>/listeattentes/">Liste d'attente</a></li>

<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/correction">Correction des demi-journées</a></li>
<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_default_schedules/">Valeurs par défaut</a></li>

<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/export">Exporter tableau des demi-journées</a></li>
<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/intialiser">Initialisation des demi-journées</a></li>
<li><a href="<? echo RACINEDIR;?>/jos_demiejournees/ajustements">Ajustements du nombre de personnes pour les demi-journées</a></li>

<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/archiver">Archiver les demi-journées</a></li>

<h2>Admin mysql</h2>
<li><a href="<? echo RACINEDIR;?>/jos_demiejournees">Demi-journées</a></li>
<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details">Détails demi-journées</a></li>
<li><a href="http://www.p2r.ch/MySQLAdmin/">phpMyAdmin</a>
<?php 
} elseif($session->read('Auth.User.role')=="member") {
	?>
	<li><a href="<?php  echo RACINEDIR ?>/jos_demiejournees/demijournees">Demi-Journées</a></li>
	<!--<li><a href="<?php  echo RACINEDIR ?>/users/coordonnees?idx=<?php echo $session->read('Auth.User.id');?>">Coordonnées</a></li>  -->
	<?php 
} else {
	?>
	Espace protégé, veuillez <a href="<? echo RACINEDIR;?>/users/login">vous enregistrer</a>
	<?php 
}

?>