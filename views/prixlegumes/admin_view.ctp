<div class="prixlegumes view">
	
	<h2><?php ___('prixlegume');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $prixlegume['Prixlegume']['id'], 'delete_id' => $prixlegume['Prixlegume']['id'], 'delete_text' => ___('do you really want to delete this prixlegume ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('legume'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($prixlegume['Legume']['lib'], array('controller' => 'legumes', 'action' => 'view', $prixlegume['Legume']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($prixlegume['Unite']['lib'], array('controller' => 'unites', 'action' => 'view', $prixlegume['Unite']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminper'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixminPER']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxper'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixmaxPER']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminbio'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixminBIO']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxbio'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixmaxBIO']; ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['rem']; ?>
		</td>
	</tr>
	</table>
</div>
