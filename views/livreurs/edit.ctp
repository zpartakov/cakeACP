<div class="livreurs form">
<?php echo $this->Form->create('Livreur');?>
	<fieldset>
 		<legend><?php __('Edit Livreur'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('jos_user_id');
		echo $this->Form->input('rem');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Livreur.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Livreur.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Livreurs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Jos Users', true), array('controller' => 'jos_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jos User', true), array('controller' => 'jos_users', 'action' => 'add')); ?> </li>
	</ul>
</div>