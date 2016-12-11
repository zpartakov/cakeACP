<div class="recolteslegumes view">
	
	<h2><?php ___('recolteslegume');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $recolteslegume['Recolteslegume']['id'], 'delete_id' => $recolteslegume['Recolteslegume']['id'], 'delete_text' => ___('do you really want to delete this recolteslegume ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('recolte'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Recolte']['lib'], array('controller' => 'recoltes', 'action' => 'view', $recolteslegume['Recolte']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('terrain'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Terrain']['lib'], array('controller' => 'terrains', 'action' => 'view', $recolteslegume['Terrain']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('legume'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Legume']['lib'], array('controller' => 'legumes', 'action' => 'view', $recolteslegume['Legume']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Unite']['lib'], array('controller' => 'unites', 'action' => 'view', $recolteslegume['Unite']['id'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb caisse'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisse']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par caisse kg pce'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['par_caisse_kg_pce']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par caisse reste'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['par_caisse_reste']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg pce total par lieu'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_total_par_lieu']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('recolte kg piece total'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['recolte_kg_piece_total']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb caisses gp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisses_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb caisses pp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisses_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets par caisse gp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['cornets_par_caisse_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets par caisse pp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['cornets_par_caisse_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg pce par cornet gp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_par_cornet_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg pce par cornet pp'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_par_cornet_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminper'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixminPER']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxper'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixmaxPER']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminbio'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixminBIO']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxbio'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixmaxBIO']; ?>
		</td>
	</tr>
   <tr>
        <td>
            <?php ___('Prix FRACP'); ?>
        </td>
        <td>:</td>
        <td>
            <?php echo $recolteslegume['Recolteslegume']['prix_fracp']; ?>
        </td>
    </tr>
	<tr>
		<td>
			<?php ___('remarques'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['remarques']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['date_mod']; ?>
		</td>
	</tr>
	</table>
</div>
<div class="actions">
		<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $recolteslegume['Recolteslegume']['id']), array('class' => 'to_detail', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $recolteslegume['Recolteslegume']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $recolteslegume['Recolteslegume']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $recolteslegume['Recolteslegume']['legume_id'])); ?>
</div>
