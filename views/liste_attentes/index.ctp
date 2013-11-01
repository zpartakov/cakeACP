<div class="listeAttentes index">
<h2><?php __('ListeAttentes');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('nom');?></th>
	<th><?php echo $paginator->sort('prenom');?></th>
	<th><?php echo $paginator->sort('rue');?></th>
	<th><?php echo $paginator->sort('cp');?></th>
	<th><?php echo $paginator->sort('commune');?></th>
	<th><?php echo $paginator->sort('telephone');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('pdd');?></th>
	<th><?php echo $paginator->sort('cocagne');?></th>
	<th><?php echo $paginator->sort('part');?></th>
	<th><?php echo $paginator->sort('classe');?></th>
	<th><?php echo $paginator->sort('commentaires');?></th>
	<th><?php echo $paginator->sort('date');?></th>
	<th><?php echo $paginator->sort('id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($listeAttentes as $listeAttente):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $listeAttente['ListeAttente']['nom']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['prenom']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['rue']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['cp']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['commune']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['telephone']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['email']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['pdd']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['cocagne']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['part']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['classe']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['commentaires']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['date']; ?>
		</td>
		<td>
			<?php echo $listeAttente['ListeAttente']['id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $listeAttente['ListeAttente']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $listeAttente['ListeAttente']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $listeAttente['ListeAttente']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listeAttente['ListeAttente']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New ListeAttente', true), array('action'=>'add')); ?></li>
	</ul>
</div>
