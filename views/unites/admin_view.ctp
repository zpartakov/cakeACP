<div class="unites view">
	
	<h2><?php ___('unite');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $unite['Unite']['id'], 'delete_id' => $unite['Unite']['id'], 'delete_text' => ___('do you really want to delete this unite ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('lib'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $unite['Unite']['lib']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $unite['Unite']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
