<div class="josUsers index">
<h2><?php __('Cocagnard/e/s');?></h2>
<!-- begin search form -->
 <table>
	 <tr>
		 <td>
 <div class="input">
<?php echo $form->create('JosUser', array('url' => array('action' => 'index'))); ?>
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
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% de %pages%, affiche %current% enregistrements d\'un total de %count%, commence à l\'enregistrement %start%, finit à l\'enregistrement %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Nom','name');?></th>
	<th><?php echo $paginator->sort("Nom d'utilisateur",'username');?></th>
	<th><?php echo $paginator->sort('Courriel','email');?></th>
	<th><?php echo $paginator->sort("Type d'utilisateur",'usertype');?></th>

	<th><?php echo $paginator->sort('Date de la dernière visite','lastvisitDate');?></th>
</tr>
<?php
$i = 0;
foreach ($josUsers as $josUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>

		<td>
			<?php echo $josUser['JosUser']['name']; ?>
		</td>
		<td>
			<?php echo $josUser['JosUser']['username']; ?>
		</td>
		<td>
			<?php echo "<a href=mailto:".$josUser['JosUser']['email'].">".$josUser['JosUser']['email']."</a>"; ?>
		</td>

		<td>
			<?php echo $josUser['JosUser']['usertype']; ?>
		</td>


		<td>
			<?php echo $josUser['JosUser']['lastvisitDate']; ?>
		</td>

		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $josUser['JosUser']['id'])); ?>
			<?php #echo $html->link(__('Edit', true), array('action' => 'edit', $josUser['JosUser']['id'])); ?>
			<?php #echo $html->link(__('Delete', true), array('action' => 'delete', $josUser['JosUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josUser['JosUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('précédent', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('suivant', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><a href="/cms/administrator/index.php?option=com_users">Ajouter Cocagnard/e</a></li>
	</ul>
</div>
