<div class="josReservationsDetails view">
<h2><?php  __('JosReservationsDetail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservationsDetail['JosReservationsDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservationsDetail['JosReservationsDetail']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservationsDetail['JosReservationsDetail']['user']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Npers'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservationsDetail['JosReservationsDetail']['npers']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josReservationsDetail['JosReservationsDetail']['rem']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit JosReservationsDetail', true), array('action'=>'edit', $josReservationsDetail['JosReservationsDetail']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete JosReservationsDetail', true), array('action'=>'delete', $josReservationsDetail['JosReservationsDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josReservationsDetail['JosReservationsDetail']['id'])); ?> </li>
		<li><?php echo $html->link(__('List JosReservationsDetails', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New JosReservationsDetail', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
