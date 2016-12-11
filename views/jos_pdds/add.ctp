<div class="josPdds form">
<?php echo $form->create('JosPdd');?>
	<fieldset>
 		<legend><?php __('Add JosPdd');?></legend>
	<?php
		echo $form->input('PDDINo');
		echo $form->input('PDDTexte');
		echo $form->input('PDDNom');
		echo $form->input('PDDAdr');
		echo $form->input('PDDNoRue');
		echo $form->input('PDDTele');
		echo $form->input('PDDLieu');
		echo $form->input('PDDEmail');
		echo $form->input('PDDRem');
		echo $form->input('PDDGP');
		echo $form->input('PDDPP');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List JosPdds', true), array('action'=>'index'));?></li>
	</ul>
</div>
