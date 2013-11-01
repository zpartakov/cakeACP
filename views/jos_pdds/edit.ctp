<div class="josPdds form">
<?php echo $form->create('JosPdd');?>
	<fieldset>
 		<legend><?php __('Edit JosPdd');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('Lieu_dit');
		echo $form->input('mini');
		echo $form->input('moyen');
		echo $form->input('grand');
		echo $form->input('oeufs');
		echo $form->input('PDDTexte');
		echo $form->input('PDDAdr');
		echo $form->input('CP');
		echo $form->input('Localite');
		echo $form->input('Ouverture');
		echo $form->input('dispo_paniers');
		echo $form->input('imperatifs_livraison');
		echo $form->input('nb_max_paniers');
		echo $form->input('contact');
		echo $form->input('tel');
		echo $form->input('mail');
		?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('JosPdd.PDDNo')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('JosPdd.PDDNo'))); ?></li>
		<li><?php echo $html->link(__('List JosPdds', true), array('action'=>'index'));?></li>
	</ul>
</div>
