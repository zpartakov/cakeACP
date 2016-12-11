<div class="recolteslegumes index">
	
	<h2><?php ___('recolteslegumes');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $this->AlaxosForm->create('Recolteslegume', array('url' => $this->passedArgs)); //'url' => $this->passedArgs allows to keep the sort when searching
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('recolte', true), 'Recolteslegume.recolte_id');?></th>
		<th><?php echo $this->Paginator->sort(__('terrain', true), 'Recolteslegume.terrain_id');?></th>
		<th><?php echo $this->Paginator->sort(__('legume', true), 'Recolteslegume.legume_id');?></th>
		<th><?php echo $this->Paginator->sort(__('unite', true), 'Recolteslegume.unite_id');?></th>
		<th><?php echo $this->Paginator->sort(__('nb_caisse', true), 'Recolteslegume.nb_caisse');?></th>
		<th><?php echo $this->Paginator->sort(__('par_caisse_kg_pce', true), 'Recolteslegume.par_caisse_kg_pce');?></th>
		<th><?php echo $this->Paginator->sort(__('par_caisse_reste', true), 'Recolteslegume.par_caisse_reste');?></th>
		<th><?php echo $this->Paginator->sort(__('kg_pce_total_par_lieu', true), 'Recolteslegume.kg_pce_total_par_lieu');?></th>
		<th><?php echo $this->Paginator->sort(__('recolte_kg_piece_total', true), 'Recolteslegume.recolte_kg_piece_total');?></th>
		<th><?php echo $this->Paginator->sort(__('nb_caisses_GP', true), 'Recolteslegume.nb_caisses_GP');?></th>
		<th><?php echo $this->Paginator->sort(__('nb_caisses_PP', true), 'Recolteslegume.nb_caisses_PP');?></th>
		<th><?php echo $this->Paginator->sort(__('cornets_par_caisse_GP', true), 'Recolteslegume.cornets_par_caisse_GP');?></th>
		<th><?php echo $this->Paginator->sort(__('cornets_par_caisse_PP', true), 'Recolteslegume.cornets_par_caisse_PP');?></th>
		<th><?php echo $this->Paginator->sort(__('kg_pce_par_cornet_GP', true), 'Recolteslegume.kg_pce_par_cornet_GP');?></th>
		<th><?php echo $this->Paginator->sort(__('kg_pce_par_cornet_PP', true), 'Recolteslegume.kg_pce_par_cornet_PP');?></th>
		<th><?php echo $this->Paginator->sort(__('prixminPER', true), 'Recolteslegume.prixminPER');?></th>
		<th><?php echo $this->Paginator->sort(__('prixmaxPER', true), 'Recolteslegume.prixmaxPER');?></th>
		<th><?php echo $this->Paginator->sort(__('prixminBIO', true), 'Recolteslegume.prixminBIO');?></th>
		<th><?php echo $this->Paginator->sort(__('prixmaxBIO', true), 'Recolteslegume.prixmaxBIO');?></th>
		<th><?php echo $this->Paginator->sort(__('remarques', true), 'Recolteslegume.remarques');?></th>
		<th><?php echo $this->Paginator->sort(__('date_mod', true), 'Recolteslegume.date_mod');?></th>
		
		<th class="actions">&nbsp;</th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
			<td>
			<?php
				echo $this->AlaxosForm->filter_field('recolte_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('terrain_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('legume_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('unite_id');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('nb_caisse');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('par_caisse_kg_pce');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('par_caisse_reste');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('kg_pce_total_par_lieu');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('recolte_kg_piece_total');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('nb_caisses_GP');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('nb_caisses_PP');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('cornets_par_caisse_GP');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('cornets_par_caisse_PP');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('kg_pce_par_cornet_GP');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('kg_pce_par_cornet_PP');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('prixminPER');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('prixmaxPER');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('prixminBIO');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('prixmaxBIO');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('remarques');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('date_mod');
			?>
		</td>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $this->AlaxosForm->create('Recolteslegume', array('id' => 'chooseActionForm', 'url' => array('controller' => 'recolteslegumes', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($recolteslegumes as $recolteslegume):
		$class = null;
		if ($i++ % 2 == 0)
		{
			$class = ' class="row"';
		}
		else
		{
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php
		echo $this->AlaxosForm->checkBox('Recolteslegume.' . $i . '.id', array('value' => $recolteslegume['Recolteslegume']['id']));
		?>
		</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Recolte']['lib'], array('controller' => 'recoltes', 'action' => 'view', $recolteslegume['Recolte']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Terrain']['lib'], array('controller' => 'terrains', 'action' => 'view', $recolteslegume['Terrain']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Legume']['lib'], array('controller' => 'legumes', 'action' => 'view', $recolteslegume['Legume']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($recolteslegume['Unite']['lib'], array('controller' => 'unites', 'action' => 'view', $recolteslegume['Unite']['id'])); ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisse']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['par_caisse_kg_pce']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['par_caisse_reste']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_total_par_lieu']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['recolte_kg_piece_total']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisses_GP']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['nb_caisses_PP']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['cornets_par_caisse_GP']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['cornets_par_caisse_PP']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_par_cornet_GP']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['kg_pce_par_cornet_PP']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixminPER']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixmaxPER']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixminBIO']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['prixmaxBIO']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['remarques']; ?>
		</td>
		<td>
			<?php echo $recolteslegume['Recolteslegume']['date_mod']; ?>
		</td>
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $recolteslegume['Recolteslegume']['id']), array('class' => 'to_detail', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $recolteslegume['Recolteslegume']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $recolteslegume['Recolteslegume']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $recolteslegume['Recolteslegume']['legume_id'])); ?>

		</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 |
	 	<?php echo $this->Paginator->numbers(array('modulus' => 5, 'first' => 2, 'last' => 2, 'after' => ' ', 'before' => ' '));?>	 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	
	<?php
if($i > 0)
{
	echo '<div class="choose_action">';
	echo ___d('alaxos', 'action to perform on the selected items', true);
	echo '&nbsp;';
	echo $this->AlaxosForm->input_actions_list();
	echo '&nbsp;';
	echo $this->AlaxosForm->end(array('label' =>___d('alaxos', 'go', true), 'div' => false));
	echo '</div>';
}
?>
	
</div>
