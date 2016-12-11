<div class="terrains view">
	
	<h2><?php ___('terrain');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $terrain['Terrain']['id'], 'delete_id' => $terrain['Terrain']['id'], 'delete_text' => ___('do you really want to delete this terrain ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('lib'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $terrain['Terrain']['lib']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $terrain['Terrain']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $terrain['Terrain']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
