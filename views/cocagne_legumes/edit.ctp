<div class="cocagneLegumes form">
<?php echo $this->Form->create('CocagneLegume');?>
	<fieldset>
 		<legend><?php __('Edit Cocagne Legume'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('legume');
		echo $this->Form->input('printemps');
		echo $this->Form->input('ete');
		echo $this->Form->input('automne');
		echo $this->Form->input('hiver');
		echo $this->Form->input('generalite');
		echo $this->Form->input('origine');
		echo $this->Form->input('choix');
		echo $this->Form->input('preparation');
		echo $this->Form->input('conservation');
		echo $this->Form->input('conseils');
		echo $this->Form->input('conseils_sante');
		echo $this->Form->input('remarques');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CocagneLegume.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CocagneLegume.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cocagne Legumes', true), array('action' => 'index'));?></li>
	</ul>
</div>