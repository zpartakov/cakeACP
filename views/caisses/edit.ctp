<div class="caisses form">

	<?php echo $this->AlaxosForm->create('Caiss');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit caiss'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $caiss['Caiss']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('code') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('code', array('label' => false)); ?>
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
			<?php ___('poids') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('poids', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('img') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('img', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date_mod') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('date_mod', array('label' => false)); ?>
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
