<div class="josReservations form">
<?php echo $form->create('JosReservation');?>
	<fieldset>
 		<legend><?php __('Edit JosReservation');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('date');
		echo $form->input('type');
		echo $form->input('nplaces');
		echo $form->input('REMARQUES');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('JosReservation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('JosReservation.id'))); ?></li>
		<li><?php echo $html->link(__('List JosReservations', true), array('action'=>'index'));?></li>
	</ul>
</div>
