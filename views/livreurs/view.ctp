<div class="livreurs view">
<h2><?php  __('Livreur');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $livreur['Livreur']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Jos User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($livreur['JosUser']['username'], array('controller' => 'jos_users', 'action' => 'view', $livreur['JosUser']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $livreur['Livreur']['rem']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Livreur', true), array('action' => 'edit', $livreur['Livreur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Livreur', true), array('action' => 'delete', $livreur['Livreur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $livreur['Livreur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Livreurs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livreur', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jos Users', true), array('controller' => 'jos_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jos User', true), array('controller' => 'jos_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
