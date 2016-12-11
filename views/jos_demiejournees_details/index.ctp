<div class="josDemiejourneesDetails index">
<h2><?php __('JosDemiejourneesDetails');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('date');?></th>
	<th><?php echo $paginator->sort('user');?></th>
	<th><?php echo $paginator->sort('npers');?></th>
	<th><?php echo $paginator->sort('rem');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($josDemiejourneesDetails as $josDemiejourneesDetail):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['id']; ?>
		</td>
		<td>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['date']; ?>
		</td>
		<td>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['user']; ?>
		</td>
		<td>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['npers']; ?>
		</td>
		<td>
			<?php echo $josDemiejourneesDetail['JosDemiejourneesDetail']['rem']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $josDemiejourneesDetail['JosDemiejourneesDetail']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $josDemiejourneesDetail['JosDemiejourneesDetail']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $josDemiejourneesDetail['JosDemiejourneesDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josDemiejourneesDetail['JosDemiejourneesDetail']['id'])); ?>
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
		<li><?php echo $html->link(__('New JosDemiejourneesDetail', true), array('action' => 'add')); ?></li>
	</ul>
</div>
