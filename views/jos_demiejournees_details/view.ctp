<div class="josDemiejourneesDetails view">
<h2><?php  __('JosDemiejourneesDetail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['user']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Npers'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['npers']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['rem']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit JosDemiejourneesDetail', true), array('action' => 'edit', $josDemiejourneesDetail['JosDemiejourneesDetail']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete JosDemiejourneesDetail', true), array('action' => 'delete', $josDemiejourneesDetail['JosDemiejourneesDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josDemiejourneesDetail['JosDemiejourneesDetail']['id'])); ?> </li>
		<li><?php echo $html->link(__('List JosDemiejourneesDetails', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New JosDemiejourneesDetail', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
