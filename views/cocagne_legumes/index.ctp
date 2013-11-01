<div class="cocagneLegumes index">
	<h2><?php __('Cocagne Légumes');?></h2>
		<!-- begin search form -->
 <table>
	 <tr>
		 <td>
 <div class="input">
<?php echo $form->create('CocagneLegume', array('url' => array('action' => 'index'))); ?>
		<?php #echo $form->input('q', array('style' => 'width: 250px;', 'label' => false, 'size' => '80')); ?>
		<?php echo $form->input('q', array('label' => false, 'size' => '50', 'class'=>'txttosearch')); ?>
		</div>
</td><td>
<input type="submit" class="chercher" value="Chercher" /> 
</div> 
</td>
</tr>
</table>
<!-- end search form -->
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('legume');?></th>
			<th><?php echo $this->Paginator->sort('printemps');?></th>
			<th><?php echo $this->Paginator->sort('ete');?></th>
			<th><?php echo $this->Paginator->sort('automne');?></th>
			<th><?php echo $this->Paginator->sort('hiver');?></th>
			<!--<th><?php echo $this->Paginator->sort('generalite');?></th>
			<th><?php echo $this->Paginator->sort('origine');?></th>
			<th><?php echo $this->Paginator->sort('choix');?></th>
			<th><?php echo $this->Paginator->sort('preparation');?></th>
			<th><?php echo $this->Paginator->sort('conservation');?></th>
			<th><?php echo $this->Paginator->sort('conseils');?></th>
			<th><?php echo $this->Paginator->sort('conseils_sante');?></th>
			<th><?php echo $this->Paginator->sort('remarques');?></th>-->
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cocagneLegumes as $cocagneLegume):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cocagneLegume['CocagneLegume']['id']; ?>&nbsp;</td>
		<td><?php echo $cocagneLegume['CocagneLegume']['legume']; ?>&nbsp;</td>
		<td><?php echo $cocagneLegume['CocagneLegume']['printemps']; ?>&nbsp;</td>
		<td><?php echo $cocagneLegume['CocagneLegume']['ete']; ?>&nbsp;</td>
		<td><?php echo $cocagneLegume['CocagneLegume']['automne']; ?>&nbsp;</td>
		<td><?php echo $cocagneLegume['CocagneLegume']['hiver']; ?>&nbsp;</td>
	<!--	<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['generalite']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['origine']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['choix']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['preparation']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['conservation']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['conseils']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['conseils_sante']),0,10); ?>&nbsp;</td>
		<td><?php echo substr(utf8_encode($cocagneLegume['CocagneLegume']['remarques']),0,10); ?>&nbsp;</td>-->
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cocagneLegume['CocagneLegume']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cocagneLegume['CocagneLegume']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cocagneLegume['CocagneLegume']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cocagneLegume['CocagneLegume']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cocagne Legume', true), array('action' => 'add')); ?></li>
	</ul>
</div>
