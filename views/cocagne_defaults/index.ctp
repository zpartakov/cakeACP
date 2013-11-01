<div class="cocagneDefaults index">
	<h2><?php __('Cocagne Defaults');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('lib');?></th>
			<th><?php echo $this->Paginator->sort('n');?></th>
			<th><?php echo $this->Paginator->sort('rem1');?></th>
			<th><?php echo $this->Paginator->sort('rem2');?></th>
			<th><?php echo $this->Paginator->sort('datemod');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cocagneDefaults as $cocagneDefault):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cocagneDefault['CocagneDefault']['id']; ?>&nbsp;</td>
		<td><?php echo $cocagneDefault['CocagneDefault']['lib']; ?>&nbsp;</td>
		<td><?php echo $cocagneDefault['CocagneDefault']['n']; ?>&nbsp;</td>
		<td><?php echo $cocagneDefault['CocagneDefault']['rem1']; ?>&nbsp;</td>
		<td><?php echo $cocagneDefault['CocagneDefault']['rem2']; ?>&nbsp;</td>
		<td><?php echo $cocagneDefault['CocagneDefault']['datemod']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cocagneDefault['CocagneDefault']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cocagneDefault['CocagneDefault']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cocagneDefault['CocagneDefault']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cocagneDefault['CocagneDefault']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cocagne Default', true), array('action' => 'add')); ?></li>
	</ul>
</div>
