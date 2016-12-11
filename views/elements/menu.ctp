<div id="cakephp-global-navigation">
<ul id="menuDeroulant">
	<!-- homepage -->
	<li>
		<a href="http://<? echo $_SERVER["HTTP_HOST"].RACINEDIR;?>">Accueil admin</a>
		<ul class="sousMenu">
			<li><a href="/">cocagne.ch</a></li>
			<li><a href="http://admin.cocagne.ch/">Administration Infomaniak</a></li>
			<li><a href="http://webmail.cocagne.ch/">@webmail</a></li>
			<li><a href="/test/">cocagne.ch site de test</a></li>
			<li><a href="/c5/dashboard/">Administration c5</a></li>
			<li><a href="/c5/la-cooperative/intranet/gestion-du-site/modifications-du-site/">Modifications du site</a></li>
			<li><a href="/c5/la-cooperative/intranet/gestion-du-site/aide/">Aide</a></li>
			<li><a href="http://www.cocagne.ch/limesurvey/admin/">Formulaires (lime)</a></li>
            <li><a href="<? echo RACINEDIR;?>/pages/emails">emails</a></li>
            <li><a href="<? echo RACINEDIR;?>/pages/phpinfo">infos php</a></li>
			<li><a href="<? echo RACINEDIR;?>/pages/infosconfidentielles">Informations confidentielles</a></li>
			<li><a target="_blank" href="/c5/la-cooperative/intranet/intranet/">Intranet du comité</a>
			<li><a target="_blank" href="/c5/la-cooperative/intranet/intranet/pvs-comite/">PVs du comité</a>

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
	<li>&nbsp;PDDs
		<ul class="sousMenu">
			<li><a href="<? echo RACINEDIR;?>/jos_pdds">Points de distribution</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_pdds/emails">Email Points de distribution</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_pdds/lime">LimeSurvey PDD</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_pdds/dolibarr">LimeSurvey Dolibarr</a></li>
		</ul>

	</li>

			<!-- Dolibarr -->

	<li><a href="<? echo RACINEDIR;?>/pages/facturation">Facturation</a>
		<ul class="sousMenu">
<li>FIXME / en cours</li>
<li><a href="<? echo RACINEDIR;?>/pages/erp/etiquettes">FIXME Étiquettes</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/pdds">FIXME PDD résumé</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/pddfull">FIXME PDD résumé</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_abo_manquant">TODO Abonnement(s) manquant(s)</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_adh_extra_infos">TODO Mise à jour infos Adhérents</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_cat_adh_manquante">TODO Catégorie(s) PDL bug</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_contact_manquant">TODO Contact(s) bug1</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_contact_manquant_sans_fourn">TODO Contact(s) bug2</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_creer_dj">TODO Créer demi-journée</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_users">TODO Màj Adhérents/Cake</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/dolibarr_vider_categorie_mailing">TODO Retrait coopérateurs mailing</a>
<li><a href="<? echo RACINEDIR;?>/pages/erp/inscription_b">Inscriptions</a>

		</ul>

	</li>

	<!-- Cocagnards -->
	<li><a href="<? echo RACINEDIR;?>/jos_users/">Cocagnard/e/s</a>
	<ul class="sousMenu">
			<li><a href="http://www.cocagne.ch/cms/cocagnardes/modeles-mails-sitecocagnech
">Modèles mails</a></li>
			<li><a href="http://www.cocagne.ch/cms/static/passwd.php">Nvl utilisateur</a></li>
			<li><a href="http://webmail.cocagne.ch/">@webmail</a></li>
			<li><a href="http://www.cocagne.ch/commandes/admin">Gestion des commandes</a></li>
			<li><a href="<? echo RACINEDIR;?>/tbl_customers">Adresses (commandes)</a></li>
			<li><a href="<? echo RACINEDIR;?>/livreurs">Livreu/r/se/s</a></li>
			<li><a href="<? echo RACINEDIR;?>/jos_users/export">Export</a></li>
			<li><a href="<? echo RACINEDIR;?>/tbl_customers/miseajour">Mise à jour PDD</a></li>
			<!--<li><a href="http://www.cocagne.ch/c5/static/sync_users_c5.php">Mise à jour Colibri</a></li>
			<li><a href="http://www.cocagne.ch/c5/static/sync_users.php">Mise à jour Colibri (old)</a></li>
            <li><a href="<? echo RACINEDIR;?>/pages/c5newusers">nouveaux inscrits (emails)</a></li>-->
		</ul>
	</li>
		<!-- Recettes & légumes -->

	<li style="width: 200px"><a href="#">Recettes & légumes</a>
		<ul class="sousMenu">
			<li><a href="<? echo RACINEDIR;?>/cocagne_recettes/">Recettes</a>

			<li><a href="<? echo RACINEDIR;?>/cocagne_legumes/">Légumes</a></li>
			<li><a href="<? echo RACINEDIR;?>/cocagne_legumes/book">Légumes (pdf)</a></li>
		</ul>

	</li>
</ul>

</div>
