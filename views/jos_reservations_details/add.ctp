<div class="josReservationsDetails form">
<?php echo $form->create('JosReservationsDetail');?>
	<fieldset>
 		<legend><?php __('Add JosReservationsDetail');?></legend>
	<?php
		echo $form->input('date');
		echo $form->input('user');
		echo $form->input('npers');
		echo $form->input('rem');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List JosReservationsDetails', true), array('action'=>'index'));?></li>
	</ul>
</div>
