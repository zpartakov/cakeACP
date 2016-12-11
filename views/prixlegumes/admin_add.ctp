<div class="prixlegumes form">

	<?php echo $this->AlaxosForm->create('Prixlegume');?>
	
 	<h2><?php ___('admin add prixlegume'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('legume_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('legume_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('unite_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminPER') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixminPER', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxPER') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixmaxPER', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminBIO') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixminBIO', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxBIO') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixmaxBIO', array('label' => false)); ?>
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
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
 	</tr>
	</table>

</div>
