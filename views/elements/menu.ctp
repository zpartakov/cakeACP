<?php
if($session->read('Auth.User.role')=="administrator") {
?>
<div id="cakephp-global-navigation">
<ul id="menuDeroulant">
	<!-- homepage -->
	<li>
		<a href="http://<? echo $_SERVER["HTTP_HOST"].RACINEDIR;?>">Accueil admin</a>
		<ul class="sousMenu">
			<li><a href="/"><?php  echo SITENAME;?></a></li>
			<li><a href="http://admin.<?php  echo SERVEURMAIL;?>/">Administration Infomaniak</a></li>
			<li><a href="http://webmail.<?php  echo SERVEURMAIL;?>/">@webmail</a></li>
		</ul>

	</li>

	<!-- DJ -->


	<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/correction">Demi-journées</a>
		<ul class="sousMenu">
			<li><a href="<? echo RACINEDIR;?>/jos_demiejournees">Programmation</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/correction">Corriger</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_default_schedules/">Valeurs semaine par défaut</a></li>
			<li><a href="<? echo RACINEDIR;?>/cocagne_defaults/">Valeurs par défaut</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/export">Exporter</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/intialiser">Initialiser</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_demiejournees/ajustements">Ajuster Npers</a></li>
			<li><a href="<? echo RACINEDIR;?>/dj_maintenances/edit/1">Maintenances</a></li>
			<!--<li><a href="<? echo RACINEDIR;?>/jos_demiejournees_details/archiver">Archiver</a></li>-->
		</ul>
	</li>
	
	<li><a href="<? echo RACINEDIR;?>/jos_pdds">PDDs</a>
		<ul class="sousMenu">
			<li><a href="<? echo RACINEDIR;?>/jos_pdds/emails">Email Points de distribution</a></li>
			<!-- <li><a href="<? echo RACINEDIR;?>/jos_pdds/lime">LimeSurvey PDD</a></li> -->
		</ul>

	</li>
	
	
		<!-- Cocagnards -->
	<li><a href="<? echo RACINEDIR;?>/users/">Coopérateurs</a>
	<ul class="sousMenu">
			<li><a href="<? echo RACINEDIR;?>/livreurs">livreurs</a></li>
			<li><a href="<? echo RACINEDIR;?>/users/export">Export</a></li>
			<li><a href="http://webmail.pdr.ch/">@webmail</a></li>	
	</ul>
	</li>
	<!-- Login / Logout -->
	<li><a href="<? echo RACINEDIR;?>/users/login">Login</a>
	<ul class="sousMenu">
	<li><a href="<? echo RACINEDIR;?>/users/logout">Logout</a></li>
	</ul>
	</li>
	
</ul>
	
</div>
<?php 
}
?>
