<?
	Configure::write('debug', 0);

?>
<div class="recoltes form">

	<?php echo $this->AlaxosForm->create('Recolte');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit recolte'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $recolte['Recolte']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('date') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('date', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('lib') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('lib', array('label' => false)); ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php ___('nb_GP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_GP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb_PP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_PP', array('label' => false)); ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php ___('rem') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('rem', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('update', true)); ?> 		</td>
 	</tr>
	</table>

</div>
