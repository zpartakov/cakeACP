<div class="djMaintenances view">
<h2><?php  __('DjMaintenance');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $djMaintenance['DjMaintenance']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actif'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $djMaintenance['DjMaintenance']['actif']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stop'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $djMaintenance['DjMaintenance']['stop']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $djMaintenance['DjMaintenance']['start']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit DjMaintenance', true), array('action' => 'edit', $djMaintenance['DjMaintenance']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete DjMaintenance', true), array('action' => 'delete', $djMaintenance['DjMaintenance']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $djMaintenance['DjMaintenance']['id'])); ?> </li>
		<li><?php echo $html->link(__('List DjMaintenances', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New DjMaintenance', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
