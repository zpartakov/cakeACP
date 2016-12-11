<div class="tblCustomers form">
<?php echo $this->Form->create('TblCustomer');?>
	<fieldset>
 		<legend><?php __('Modifier adresse Cocagnard/e/s (commandes)'); ?></legend>
	<?php
		echo $this->Form->input('PersNo');
		echo $this->Form->input('PersPDDDistrNo');
		echo "<br><em>Chercher la valeur de l'identifiant PDD dans l'administration des PDD</em>";
		echo $this->Form->input('PersNom',array('label'=>'Nom'));
		echo $this->Form->input('PersPrenom');
		echo $this->Form->input('PersAdresse');
		echo $this->Form->input('PersTelephone');
		echo $this->Form->input('PersNPA');
		echo $this->Form->input('PersLocalite');
		echo $this->Form->input('PersAdresseEmail');
		echo $this->Form->input('jos_user_id',array('type'=>'text'));
		echo "<br><em>Chercher la valeur de l'identifiant joomla dans l'administration Joomla!</em>";
		echo $this->Form->input('type_part');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Enregistrer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Supprimer', true), array('action' => 'delete', $this->Form->value('TblCustomer.PersNo')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TblCustomer.PersNo'))); ?></li>
		<li><?php echo $this->Html->link(__('Liste', true), array('action' => 'index'));?></li>
	</ul>
</div>
