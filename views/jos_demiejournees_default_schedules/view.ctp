<div class="josDemiejourneesDefaultSchedules view">
<h2><?php  __('Jos Demiejournees Default Schedule');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Jourheure'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['jourheure']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Npers'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['npers']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['rem1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['rem2']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Jos Demiejournees Default Schedule', true), array('action' => 'edit', $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Jos Demiejournees Default Schedule', true), array('action' => 'delete', $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jos Demiejournees Default Schedules', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jos Demiejournees Default Schedule', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
