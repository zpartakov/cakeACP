<div class="cocagneDefaults form">
<?php echo $this->Form->create('CocagneDefault');?>
	<fieldset>
 		<legend><?php __('Add Cocagne Default'); ?></legend>
	<?php
		echo $this->Form->input('lib');
		echo $this->Form->input('n');
		echo $this->Form->input('rem1');
		echo $this->Form->input('rem2');
		echo $this->Form->input('datemod');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cocagne Defaults', true), array('action' => 'index'));?></li>
	</ul>
</div>