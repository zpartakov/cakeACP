<div class="articles form">

	<?php echo $this->AlaxosForm->create('Article');?>
	
 	<h2><?php ___('add article'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('title') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('title', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('text') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('text', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('state') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('state', array('label' => false)); ?>
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
