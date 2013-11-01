<div class="cocagneRecettes form">
<?php echo $this->Form->create('CocagneRecette');?>
	<fieldset>
 		<legend><?php __('Edit Cocagne Recette'); ?></legend>
	<?php
	#echo $this->['CocagneRecette']['preparation']; exit;
		echo $this->Form->input('id');
		echo $this->Form->input('titre');
		echo $this->Form->input('ingredients');
		#echo $this->Form->input('preparation', array('value' => utf8_encode($cocagneRecette['CocagneRecette']['preparation']));
		
		#echo $this->Form->textarea('preparation', array('cols' => 60, 'rows' => 12));
		echo $this->Form->input('preparation');
		echo $this->Form->input('date');
		echo $this->Form->input('genre');
		echo $this->Form->input('image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CocagneRecette.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CocagneRecette.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cocagne Recettes', true), array('action' => 'index'));?></li>
	</ul>
</div>
