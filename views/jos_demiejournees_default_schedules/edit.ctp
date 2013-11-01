<div class="josDemiejourneesDefaultSchedules form">
<?php echo $this->Form->create('JosDemiejourneesDefaultSchedule');?>
	<fieldset>
 		<legend><?php __('Edit Jos Demiejournees Default Schedule'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('jourheure');
		echo $this->Form->input('npers');
		echo $this->Form->input('rem1');
		echo $this->Form->input('rem2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('JosDemiejourneesDefaultSchedule.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('JosDemiejourneesDefaultSchedule.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Jos Demiejournees Default Schedules', true), array('action' => 'index'));?></li>
	</ul>
</div>