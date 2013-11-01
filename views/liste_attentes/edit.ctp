<div class="listeAttentes form">
<?php echo $form->create('ListeAttente');?>
	<fieldset>
 		<legend><?php __('Edit ListeAttente');?></legend>
	<?php
		echo $form->input('nom');
		echo $form->input('prenom');
		echo $form->input('rue');
		echo $form->input('cp');
		echo $form->input('commune');
		echo $form->input('telephone');
		echo $form->input('email');
		echo $form->input('pdd');
		echo $form->input('cocagne');
		echo $form->input('part');
		echo $form->input('classe');
		echo $form->input('commentaires');
		echo $form->input('date');
		echo $form->input('id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('ListeAttente.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ListeAttente.id'))); ?></li>
		<li><?php echo $html->link(__('List ListeAttentes', true), array('action'=>'index'));?></li>
	</ul>
</div>
