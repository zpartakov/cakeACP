<div class="josDemiejournees form">
<?php echo $form->create('JosDemiejournee');?>
	<fieldset>
 		<legend><?php __('Add JosDemiejournee');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List JosDemiejournees', true), array('action' => 'index'));?></li>
	</ul>
</div>
