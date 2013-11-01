<div class="cocagneRecettes index">
	<h2><?php __('Cocagne Recettes');?></h2>
	<!-- begin search form -->
 <table>
	 <tr>
		 <td>
 <div class="input">
<?php echo $form->create('cocagneRecette', array('url' => array('action' => 'index'))); ?>
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
			<th><?php echo $this->Paginator->sort('titre');?></th>
			<th><?php echo $this->Paginator->sort('ingredients');?></th>
			<th><?php echo $this->Paginator->sort('preparation');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('genre');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cocagneRecettes as $cocagneRecette):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cocagneRecette['CocagneRecette']['id']; ?>&nbsp;</td>
		<td><?php echo $cocagneRecette['CocagneRecette']['titre']; ?>&nbsp;</td>
		<td><?php echo $cocagneRecette['CocagneRecette']['ingredients']; ?>&nbsp;</td>
		<td><?php echo $cocagneRecette['CocagneRecette']['preparation']; ?>&nbsp;</td>
		<td><?php echo $cocagneRecette['CocagneRecette']['date']; ?>&nbsp;</td>
		<td><?php echo $cocagneRecette['CocagneRecette']['genre']; ?>&nbsp;</td>
		<td><?php echo $cocagneRecette['CocagneRecette']['image']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cocagneRecette['CocagneRecette']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cocagneRecette['CocagneRecette']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cocagneRecette['CocagneRecette']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cocagneRecette['CocagneRecette']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cocagne Recette', true), array('action' => 'add')); ?></li>
	</ul>
</div>
