<div class="josDemiejourneesDetails form">
<?php echo $form->create('JosDemiejourneesDetail');?>
	<fieldset>
 		<legend><?php __('Add JosDemiejourneesDetail');?></legend>
	<?php
		echo $form->input('date');
		echo $form->input('user');
		echo $form->input('npers');
		echo $form->input('voiture', array('style'=>'width: 30px','label'=>'Co-voiturage proposé? (1=oui, 0=non)'));
		
		echo $form->input('rem');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List JosDemiejourneesDetails', true), array('action' => 'index'));?></li>
	</ul>
</div>
