<div class="livreurs index">
	<h2><?php __('Livreurs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('jos_user_id');?></th>
			<th><?php echo $this->Paginator->sort('rem');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($livreurs as $livreur):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $livreur['Livreur']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($livreur['JosUser']['username'], array('controller' => 'jos_users', 'action' => 'view', $livreur['JosUser']['id'])); ?>
		</td>
		<td><?php echo $livreur['Livreur']['rem']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $livreur['Livreur']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $livreur['Livreur']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $livreur['Livreur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $livreur['Livreur']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Livreur', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Jos Users', true), array('controller' => 'jos_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jos User', true), array('controller' => 'jos_users', 'action' => 'add')); ?> </li>
	</ul>
</div>