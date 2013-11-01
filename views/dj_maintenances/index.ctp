<div class="djMaintenances index">
<h2><?php __('DjMaintenances');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('actif');?></th>
	<th><?php echo $paginator->sort('stop');?></th>
	<th><?php echo $paginator->sort('start');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($djMaintenances as $djMaintenance):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $djMaintenance['DjMaintenance']['id']; ?>
		</td>
		<td>
			<?php echo $djMaintenance['DjMaintenance']['actif']; ?>
		</td>
		<td>
			<?php echo $djMaintenance['DjMaintenance']['stop']; ?>
		</td>
		<td>
			<?php echo $djMaintenance['DjMaintenance']['start']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $djMaintenance['DjMaintenance']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $djMaintenance['DjMaintenance']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $djMaintenance['DjMaintenance']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $djMaintenance['DjMaintenance']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New DjMaintenance', true), array('action' => 'add')); ?></li>
	</ul>
</div>
