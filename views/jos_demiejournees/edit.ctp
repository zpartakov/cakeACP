<div class="josDemiejournees form">
<?php echo $form->create('JosDemiejournee');?>
	<fieldset>
 		<legend><?php __('Edit JosDemiejournee');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('date');
		echo $form->input('type');
		echo $form->input('nplaces');
		echo $form->input('statut');
		echo $form->input('REMARQUES');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('JosDemiejournee.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('JosDemiejournee.id'))); ?></li>
		<li><?php echo $html->link(__('List JosDemiejournees', true), array('action' => 'index'));?></li>
	</ul>
</div>
