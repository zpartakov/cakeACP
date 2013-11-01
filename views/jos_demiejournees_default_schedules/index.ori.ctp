<pre>
Administration des valeurs par défaut pour les Demies-journées

créer une nouvelle table pour le nombre de journées affichées par défaut dans l'interface public

faire un tableau éditable avec les données qui suivent

btn Modifier les valeurs et enregistrer (ou ajax) puis générer de nouvelles entrées

Pour les entrées existantes, utiliser [modifier]
</pre>
<div class="josDemiejourneesDefaultSchedules index">
	<h2><?php __('Jos Demiejournees Default Schedules');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('jourheure');?></th>
			<th><?php echo $this->Paginator->sort('npers');?></th>
			<th><?php echo $this->Paginator->sort('rem1');?></th>
			<th><?php echo $this->Paginator->sort('rem2');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($josDemiejourneesDefaultSchedules as $josDemiejourneesDefaultSchedule):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id']; ?>&nbsp;</td>
		<td><?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['jourheure']; ?>&nbsp;</td>
		<td><?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['npers']; ?>&nbsp;</td>
		<td><?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['rem1']; ?>&nbsp;</td>
		<td><?php echo $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['rem2']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josDemiejourneesDefaultSchedule['JosDemiejourneesDefaultSchedule']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Jos Demiejournees Default Schedule', true), array('action' => 'add')); ?></li>
	</ul>
</div>
