<h1>Maintenances DJ</h1>
<h2>Pour activer la maintenance</h2>
<ul>
<li>mettre 1 pour "actif" (0 = inactif);</li>
<li>renseigner le champ "Stop" (date à partir de laquelles les DJ ne seront plus affichées)</li>
<li>sauvegarder (submit)</li>
</ul>
<h2>Pour désactiver la maintenance</h2>
<ul>
<li>procéder de la même manière mais simplement mettre 0 à actif</li>
</ul> 


<div class="djMaintenances form">
<?php echo $form->create('DjMaintenance');?>
	<fieldset>
 		<legend><?php __('Edit DjMaintenance');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('actif');
		echo $form->input('stop');
		echo $form->input('start');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('DjMaintenance.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('DjMaintenance.id'))); ?></li>
		<li><?php echo $html->link(__('List DjMaintenances', true), array('action' => 'index'));?></li>
	</ul>
</div>
