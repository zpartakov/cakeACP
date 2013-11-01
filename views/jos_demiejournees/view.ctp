<div class="josDemiejournees view">
<h2><?php  __('JosDemiejournee');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejournee['JosDemiejournee']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejournee['JosDemiejournee']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejournee['JosDemiejournee']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nplaces'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejournee['JosDemiejournee']['nplaces']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Statut'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejournee['JosDemiejournee']['statut']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('REMARQUES'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josDemiejournee['JosDemiejournee']['REMARQUES']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit JosDemiejournee', true), array('action' => 'edit', $josDemiejournee['JosDemiejournee']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete JosDemiejournee', true), array('action' => 'delete', $josDemiejournee['JosDemiejournee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josDemiejournee['JosDemiejournee']['id'])); ?> </li>
		<li><?php echo $html->link(__('List JosDemiejournees', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New JosDemiejournee', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
