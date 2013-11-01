<?
#debug($josDemiejourneesDefaultSchedules); exit;
?>
<h1>Administration des valeurs par défaut pour les Demies-journées</h1>
Modifier les valeurs par défaut en changeant la valeur pour le jour et l'heure; ensuite, lorsque vous utiliserez l'entrée <a href="http://<? echo $_SERVER["SERVER_ADDR"]; ?>/cocagne/cake/jos_demiejournees_details/intialiser" target="_blank">"intialiser"</a>, vos nouvelles valeurs par défaut seront prises en compte.<br>
<br>
<em>Note</em>: pour les entrées existantes, utiliser l'entrée <a href="http://<? echo $_SERVER["SERVER_ADDR"]; ?>/cocagne/cake/jos_demiejournees_details/correction" target="_blank">"correction"</a>
<br><br>

<div class="josDemiejourneesDefaultSchedules index">
	<table>
	<tr><th>Jour</th><th>Matin</th><th>Après-Midi</th><th>Soir</th><th>Livraison</th></tr>
		<?php
	$i = 0;
	foreach ($josDemiejourneesDefaultSchedules as $josDemiejourneesDefaultSchedule):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	if(preg_match("/Matin$/",$josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['jourheure'])) {
			echo "<tr>
			<td>";
			echo preg_replace("/Matin$/", "", $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['jourheure']);
			echo "</td>";
			 		echo "<td>";
			//nb places avec lien sur édition ajax-like
			 npersparjour($josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'], $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['npers']);
			
			echo "</td>";
	} else {
 		echo "<td>";

		 //nb places avec lien sur édition ajax-like
			 npersparjour($josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'], $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['npers']);
		 
		 echo "</td>";
	}

		if(preg_match("/Livraison$/",$josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['jourheure'])) {
			echo "</tr>";
		}
		?>

	<?php endforeach; ?>
</table>
</div>

