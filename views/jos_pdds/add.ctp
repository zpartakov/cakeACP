<div class="josPdds form">
<?php echo $form->create('JosPdd');?>
	<fieldset>
 		<legend><?php __('Add JosPdd');?></legend>
 		<!-- 

id
Lieu_dit
mini
moyen
grand
oeufs
PDDTexte
PDDAdr
CP
Localite
Ouverture
dispo_paniers
imperatifs_livraison
nb_max_paniers
contact
tel
mail
-->
	<?php
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
		<li><?php echo $html->link(__('List JosPdds', true), array('action'=>'index'));?></li>
	</ul>
</div>
