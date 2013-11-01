<div class="josPdds index">
<h2><?php __('Points de distribution');?></h2>
<?php 
if($_GET['all']==1) {
//	$montre="inline";
	echo "<a href=?all=0>Résumé</a>";
} else {
	$montre="none";
	echo "<a href=?all=1>Détail</a>";
}
?>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% de %pages%, affiche %current% enregistrements d\'un total de %count%, commence à l\'enregistrement %start%, finit à l\'enregistrement %end%', true)
));
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
	<!-- <th><?php echo $paginator->sort('id');?></th> -->

	<th><?php echo $paginator->sort('Lieu_dit');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('mini');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('moyen');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('grand');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('oeufs');?></th>
	<th><?php echo $paginator->sort('PDDTexte');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('PDDAdr');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('CP');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('Localite');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('Ouverture');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('dispo_paniers');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('imperatifs_livraison');?></th>
	<th style="display: <?php  echo $montre;?>;"><?php echo $paginator->sort('nb_max_paniers');?></th>
	<th><?php echo $paginator->sort('contact');?></th>
	<th><?php echo $paginator->sort('tel');?></th>
	<th><?php echo $paginator->sort('mail');?></th>
	
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
	<!-- 	<td>
			<?php echo $josPdd['JosPdd']['id']; ?>
		</td>
 -->

<td>
			<?php echo $html->link($josPdd['JosPdd']['Lieu_dit'], array('action'=>'view', $josPdd['JosPdd']['id'])); ?>
			</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['mini']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['moyen']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['grand']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['oeufs']; ?>
		</td>


<td>

			<?php echo $josPdd['JosPdd']['PDDTexte']; 
			
			?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['PDDAdr']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['CP']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['Localite']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['Ouverture']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['dispo_paniers']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['imperatifs_livraison']; ?>
		</td>


<td style="display: <?php  echo $montre;?>;">
			<?php echo $josPdd['JosPdd']['nb_max_paniers']; ?>
		</td>


<td>
			<?php echo $josPdd['JosPdd']['contact']; ?>
		</td>


<td>
			<?php echo $josPdd['JosPdd']['tel']; ?>
		</td>


<td>
			<?php echo $josPdd['JosPdd']['mail']; ?>
		</td>


		<td class="actions">
			<?php echo $html->link(__('Voir', true), array('action'=>'view', $josPdd['JosPdd']['id'])); ?>
			<?php echo $html->link(__('Modifier', true), array('action'=>'edit', $josPdd['JosPdd']['id'])); ?>
			<?php echo $html->link(__('Supprimer', true), array('action'=>'delete', $josPdd['JosPdd']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josPdd['JosPdd']['id'])); ?>
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
		<li><?php echo $html->link(__('Nouveau point de distribution', true), array('action'=>'add')); ?></li>
	</ul>
</div>
