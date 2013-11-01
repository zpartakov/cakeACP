<div class="cocagneRecettes form">
<?php echo $this->Form->create('CocagneRecette');?>
	<fieldset>
 		<legend><?php __('Add Cocagne Recette'); ?></legend>
	<?php
		echo $this->Form->input('titre');
		echo $this->Form->input('ingredients');
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

		<li><?php echo $this->Html->link(__('List Cocagne Recettes', true), array('action' => 'index'));?></li>
	</ul>
</div>