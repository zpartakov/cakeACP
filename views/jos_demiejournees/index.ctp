<div class="josDemiejournees index">
<h2><?php __('JosDemiejournees');?></h2>
<li><?php echo $this->Html->link(__('Nouvelle demi-journée \(entrée manuelle\))', true), array('action' => 'add')); ?></li>
<p>
<?php
App::import('Lib', 'functions'); //imports app/libs/functions

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));

function mysql_DateTime($d) { 

  $jour = substr($d,8,2);        // jour 
  $mois = substr($d,5,2);  // mois 
  $annee = substr($d,0,4); // année 
  $hm = substr($d,11,5);     // heures et minutes 
  $hm=preg_replace("/:.*/","h",$hm);
  $hm=preg_replace("/^0/","",$hm);
  $date=$jour."/".$mois."/".$annee.", ".$hm;
  // date du jour
// tableau des jours de la semaine
$joursem = array('dim', 'lun', 'mar', 'mer', 'jeu', 'ven', 'sam');
// extraction des jour, mois, an de la date
// calcul du timestamp
$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
// affichage du jour de la semaine
  return $joursem[date("w",$timestamp)] ." " .$date; 
} 

function utime($d) { 
  $jour = substr($d,8,2);        // jour 
  $mois = substr($d,5,2);  // mois 
  $annee = substr($d,0,4); // année 
  $hm = substr($d,11,5);     // heures et minutes 
  $date=$jour."/".$mois."/".$annee." ".$hm;
$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
  return $timestamp; 
} 
?></p>
<table cellpadding="0" cellspacing="0" style="width: 600px">
<tr>
	<th><?php echo $paginator->sort('date');?></th>
	<th><?php echo $paginator->sort('nplaces');?></th>
	<th><?php echo $paginator->sort('statut');?></th>
</tr>
<?php
$aujourdhui=date("U");

$i = 0;
foreach ($josDemiejournees as $josDemiejournee):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
			if(utime($josDemiejournee['JosDemiejournee']['date'])>$aujourdhui) {
	
?>
	<tr<?php echo $class;?>>

		<td>
			<?php 
			echo datefr_short($josDemiejournee['JosDemiejournee']['date']); ?>
		</td>

		<td>
			<?php placesprevues2($josDemiejournee['JosDemiejournee']['id'],$josDemiejournee['JosDemiejournee']['nplaces']); ?>
		</td>
		<td>
			<?php changestatutDJ($josDemiejournee['JosDemiejournee']['id'],$josDemiejournee['JosDemiejournee']['statut']); ?>
		</td>
<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $josDemiejournee['JosDemiejournee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $josDemiejournee['JosDemiejournee']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $josDemiejournee['JosDemiejournee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josDemiejournee['JosDemiejournee']['id'])); ?>
		</td>

	</tr>
<?php 
}
endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nouvelle demi-journée \(entrée manuelle\))', true), array('action' => 'add')); ?></li>
	</ul>
</div>
