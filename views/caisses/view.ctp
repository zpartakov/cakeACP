<div class="caisses view">
	
	<h2><?php ___('caiss');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $caiss['Caiss']['id'], 'delete_id' => $caiss['Caiss']['id'], 'delete_text' => ___('do you really want to delete this caiss ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('code'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $caiss['Caiss']['code']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('lib'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $caiss['Caiss']['lib']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('poids'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $caiss['Caiss']['poids']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('img'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $caiss['Caiss']['img']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $caiss['Caiss']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $caiss['Caiss']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
