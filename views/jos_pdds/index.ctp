<div class="josPdds index">
<h2><?php __('Points de distribution');?> > <?php echo $html->link(__('Nouveau PDD', true), array('action'=>'add')); ?></h2>

<p>
<?php
/*
echo $paginator->counter(array(
'format' => __('Page %page% de %pages%, montre %current% enregistrements d\'un total de %count%, commence à l\'enregistrement %start%, finit à l\'enregistrement %end%', true)
));
* */
?></p>
<!-- begin search form -->
 <table>
	 <tr>
		 <td>
 <div class="input">
<?php echo $form->create('JosPdd', array('url' => array('action' => 'index'))); ?>
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
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('No');?></th>
	<th><?php echo $paginator->sort('Texte');?></th>
	<th><?php echo $paginator->sort('Nom');?></th>
	<th><?php echo $paginator->sort('Adresse');?></th>
<!--	<th><?php echo $paginator->sort('Téléphone');?></th>
	<th><?php echo $paginator->sort('Lieu');?></th>-->
	<th><?php echo $paginator->sort('Email');?></th>
	<th><?php echo $paginator->sort('Remarque');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($josPdds as $josPdd):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $josPdd['JosPdd']['id']; ?>
		</td>
		<td>
			<?php echo $josPdd['JosPdd']['PDDINo']; ?>
		</td>
		<td>
			<?php echo $josPdd['JosPdd']['PDDTexte']; ?>
		</td>
		<td>
			<?php echo $josPdd['JosPdd']['PDDNom']; ?>
		</td>
		<td>
			<?php echo $josPdd['JosPdd']['PDDNoRue']; ?>, 
			<?php
			 echo $josPdd['JosPdd']['PDDAdr']; 
			 ?>
			 <br>
			 			<?php echo $josPdd['JosPdd']['PDDLieu']; ?>
			 <br>
			<?php echo $josPdd['JosPdd']['PDDTele']; ?>
		</td>
		<td>
			<a href="mailto:<?php echo $josPdd['JosPdd']['PDDEmail']; ?>"><?php echo $josPdd['JosPdd']['PDDEmail']; ?></a>
		</td>
		<td>
			<?php echo $josPdd['JosPdd']['PDDRem']; ?>
		</td>
<!--		<td>
			<?php echo $josPdd['JosPdd']['PDDGP']; ?>
		</td>
		<td>
			<?php echo $josPdd['JosPdd']['PDDPP']; ?>
		</td>
-->
		<td class="actions">
			<?php echo $html->link(__('Voir', true), array('action'=>'view', $josPdd['JosPdd']['id'])); ?>
			<?php echo $html->link(__('Modifier', true), array('action'=>'edit', $josPdd['JosPdd']['id'])); ?>
			<?php echo $html->link(__('Effacer', true), array('action'=>'delete', $josPdd['JosPdd']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josPdd['JosPdd']['id'])); ?>
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
		<li><?php echo $html->link(__('Nouveau PDD', true), array('action'=>'add')); ?></li>
	</ul>
</div>
