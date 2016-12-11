	<h2>Toutes les récoltes</h2>
	<style>
		td, th {
	font-size: 8px;
	}
	</style>
<?php
//Configure::write('debug', 2);
App::import('Lib', 'functions'); //imports app/libs/image_manipulation.php
allrecoltes();
?>
