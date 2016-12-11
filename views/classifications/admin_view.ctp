<div class="classifications view">
	
	<h2><?php ___('classification');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $classification['Classification']['id'], 'delete_id' => $classification['Classification']['id'], 'delete_text' => ___('do you really want to delete this classification ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('lib'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $classification['Classification']['lib']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $classification['Classification']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $classification['Classification']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
