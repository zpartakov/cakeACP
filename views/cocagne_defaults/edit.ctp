<div class="cocagneDefaults form">
<?php echo $this->Form->create('CocagneDefault');?>
	<fieldset>
 		<legend><?php __('Edit Cocagne Default'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('lib', array("style"=>"width: 800px"));
		echo $this->Form->input('n');
		echo $this->Form->input('rem1', array("style"=>"width: 800px"));
		echo $this->Form->input('rem2');
		echo $this->Form->input('datemod');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CocagneDefault.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CocagneDefault.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cocagne Defaults', true), array('action' => 'index'));?></li>
	</ul>
</div>