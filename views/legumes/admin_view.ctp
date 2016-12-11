<div class="legumes view">
	
	<h2><?php ___('legume');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $legume['Legume']['id'], 'delete_id' => $legume['Legume']['id'], 'delete_text' => ___('do you really want to delete this legume ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('lib'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $legume['Legume']['lib']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($legume['Unite']['lib'], array('controller' => 'unites', 'action' => 'view', $legume['Unite']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('classification'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($legume['Classification']['lib'], array('controller' => 'classifications', 'action' => 'view', $legume['Classification']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('img'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $legume['Legume']['img']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $legume['Legume']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $legume['Legume']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
