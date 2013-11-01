<div class="josPdds view">
<h2><?php  __('Point de distribution');?>: <?php echo $josPdd['JosPdd']['PDDTexte']; ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lieu_dit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['Lieu_dit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('mini'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			compte_panier('MP',$josPdd['JosPdd']['id']);
			echo " (nbre d'après le fichier excel: " .$josPdd['JosPdd']['mini'] .")";
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('moyen'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			compte_panier('P2',$josPdd['JosPdd']['id']);
			echo " (nbre d'après le fichier excel: " .$josPdd['JosPdd']['moyen'] .")";
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('grand'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			compte_panier('GP',$josPdd['JosPdd']['id']);
			echo " (nbre d'après le fichier excel: " .$josPdd['JosPdd']['grand'] .")";
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('oeufs'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['oeufs']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDTexte'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDTexte']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDAdr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDAdr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('CP'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['CP']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Localite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['Localite']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ouverture'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['Ouverture']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('dispo_paniers'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['dispo_paniers']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('imperatifs_livraison'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['imperatifs_livraison']; ?>
			&nbsp;
		</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('nb_max_paniers'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			
			
			compte_panier('%',$josPdd['JosPdd']['id']);
			echo " (nbre d'après le fichier excel: " .$josPdd['JosPdd']['nb_max_paniers'] .")"; 
			?>
			&nbsp;
		</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('contact'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['contact']; ?>
			&nbsp;
		</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('tel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['tel']; ?>
			&nbsp;
		</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('mail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['mail']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br/>
<h3>Coopérateurs de ce PDD</h3>
<ul>
<?php 

/*
 * quick  and dirty
*
* extraction des données
* */
$sql="
SELECT * FROM jos_users_pdds AS jup, users AS users
WHERE
jup.jos_pdd_id=".$josPdd['JosPdd']['id'] ."
AND
users.id=jup.user_id
";
//echo "<br>" .$sql; echo "<hr>"; exit; //tests
	
$sql=mysql_query($sql); 
if(!$sql) {
	echo "SQL error DJ: " .mysql_error();
}
	
$i=0;
echo "<table style=\"width: 40%\">";
while ($i<mysql_num_rows($sql)) {
	echo "<tr><td>";
	echo "<a href=\"".RACINEDIR."/jos_users/view/" .mysql_result($sql, $i,'id') ."\">";
	
	echo mysql_result($sql, $i,'name');
	//echo ", ".mysql_result($sql, $i,'email');
	echo "</a></td><td>";
	echo $html->image("b_usrdrop.png", array(
			"title" => "Supprimer le coopérateur",
			"alt" => "Supprimer le coopérateur",
			'url' => array('action'=>'deleteuser', 
			mysql_result($sql, $i,'jup.user_id')), 
			null, sprintf(__('Are you sure you want to delete # %s?', true), 
			mysql_result($sql, $i,'jup.user_id'))));
	
	
	//echo $html->link(__('  Supprimer', true), array('action'=>'deleteuser', mysql_result($sql, $i,'jup.user_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), mysql_result($sql, $i,'jup.user_id')));

	
	
	
	
	echo "</td></tr>";
	$i++;
}
echo "</table>";
?>
</ul>
<p style="margin-top: 10px"><a href="../adduser?pdd=<?php echo $josPdd['JosPdd']['id'];?>">Ajouter un coopérateur à ce PDD</a></p>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit JosPdd', true), array('action'=>'edit', $josPdd['JosPdd']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete JosPdd', true), array('action'=>'delete', $josPdd['JosPdd']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josPdd['JosPdd']['id'])); ?> </li>
		<li><?php echo $html->link(__('List JosPdds', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New JosPdd', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
