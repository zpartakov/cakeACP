<div class="cocagneDefaults view">
<h2><?php  __('Cocagne Default');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneDefault['CocagneDefault']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lib'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneDefault['CocagneDefault']['lib']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('N'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneDefault['CocagneDefault']['n']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneDefault['CocagneDefault']['rem1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneDefault['CocagneDefault']['rem2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Datemod'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneDefault['CocagneDefault']['datemod']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cocagne Default', true), array('action' => 'edit', $cocagneDefault['CocagneDefault']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Cocagne Default', true), array('action' => 'delete', $cocagneDefault['CocagneDefault']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cocagneDefault['CocagneDefault']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cocagne Defaults', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cocagne Default', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
