<div class="livreurs form">
<?php echo $this->Form->create('Livreur');?>
	<fieldset>
 		<legend><?php __('Add Livreur'); ?></legend>
	<?php
		echo $this->Form->input('User.id');
		echo $this->Form->input('rem');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Livreurs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Jos Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jos User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>