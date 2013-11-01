<div class="djMaintenances form">
<?php echo $form->create('DjMaintenance');?>
	<fieldset>
 		<legend><?php __('Add DjMaintenance');?></legend>
	<?php
		echo $form->input('actif');
		echo $form->input('stop');
		echo $form->input('start');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List DjMaintenances', true), array('action' => 'index'));?></li>
	</ul>
</div>
