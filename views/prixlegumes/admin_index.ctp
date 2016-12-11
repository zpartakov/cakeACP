<div class="prixlegumes index">
	
	<h2><?php ___('prixlegumes');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $this->AlaxosForm->create('Prixlegume', array('url' => $this->passedArgs)); //'url' => $this->passedArgs allows to keep the sort when searching
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('legume', true), 'Prixlegume.legume_id');?></th>
		<th><?php echo $this->Paginator->sort(__('unite', true), 'Prixlegume.unite_id');?></th>
		<th><?php echo $this->Paginator->sort(__('prixminPER', true), 'Prixlegume.prixminPER');?></th>
		<th><?php echo $this->Paginator->sort(__('prixmaxPER', true), 'Prixlegume.prixmaxPER');?></th>
		<th><?php echo $this->Paginator->sort(__('prixminBIO', true), 'Prixlegume.prixminBIO');?></th>
		<th><?php echo $this->Paginator->sort(__('prixmaxBIO', true), 'Prixlegume.prixmaxBIO');?></th>
		<th><?php echo $this->Paginator->sort(__('date_mod', true), 'Prixlegume.date_mod');?></th>
		<th><?php echo $this->Paginator->sort(__('rem', true), 'Prixlegume.rem');?></th>
		
		<th class="actions">&nbsp;</th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
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
				echo $this->AlaxosForm->filter_field('date_mod');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('rem');
			?>
		</td>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $this->AlaxosForm->create('Prixlegume', array('id' => 'chooseActionForm', 'url' => array('controller' => 'prixlegumes', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($prixlegumes as $prixlegume):
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
		echo $this->AlaxosForm->checkBox('Prixlegume.' . $i . '.id', array('value' => $prixlegume['Prixlegume']['id']));
		?>
		</td>
		<td>
			<?php echo $this->Html->link($prixlegume['Legume']['lib'], array('controller' => 'legumes', 'action' => 'view', $prixlegume['Legume']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($prixlegume['Unite']['lib'], array('controller' => 'unites', 'action' => 'view', $prixlegume['Unite']['id'])); ?>
		</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixminPER']; ?>
		</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixmaxPER']; ?>
		</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixminBIO']; ?>
		</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['prixmaxBIO']; ?>
		</td>

		<td>
			<?php echo $prixlegume['Prixlegume']['date_mod']; ?>
		</td>
		<td>
			<?php echo $prixlegume['Prixlegume']['rem']; ?>
		</td>
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $prixlegume['Prixlegume']['id']), array('class' => 'to_detail', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $prixlegume['Prixlegume']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $prixlegume['Prixlegume']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $prixlegume['Prixlegume']['id'])); ?>

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
