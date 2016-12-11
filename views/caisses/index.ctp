<div class="caisses index">
	
	<h2><?php ___('caisses');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $this->AlaxosForm->create('Caiss', array('url' => $this->passedArgs)); //'url' => $this->passedArgs allows to keep the sort when searching
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('code', true), 'Caiss.code');?></th>
		<th><?php echo $this->Paginator->sort(__('lib', true), 'Caiss.lib');?></th>
		<th><?php echo $this->Paginator->sort(__('poids', true), 'Caiss.poids');?></th>
		<th><?php echo $this->Paginator->sort(__('img', true), 'Caiss.img');?></th>
		<th><?php echo $this->Paginator->sort(__('date_mod', true), 'Caiss.date_mod');?></th>
		<th><?php echo $this->Paginator->sort(__('rem', true), 'Caiss.rem');?></th>
		
		<th class="actions">&nbsp;</th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
			<td>
			<?php
				echo $this->AlaxosForm->filter_field('code');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('lib');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('poids');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('img');
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
			echo $this->AlaxosForm->create('Caiss', array('id' => 'chooseActionForm', 'url' => array('controller' => 'caisses', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($caisses as $caiss):
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
		echo $this->AlaxosForm->checkBox('Caiss.' . $i . '.id', array('value' => $caiss['Caiss']['id']));
		?>
		</td>
		<td>
			<?php echo $caiss['Caiss']['code']; ?>
		</td>
		<td>
			<?php echo $caiss['Caiss']['lib']; ?>
		</td>
		<td>
			<?php echo $caiss['Caiss']['poids']; ?>
		</td>
		<td>
			<?php echo $caiss['Caiss']['img']; ?>
		</td>
		<td>
			<?php echo $caiss['Caiss']['date_mod']; ?>
		</td>
		<td>
			<?php echo $caiss['Caiss']['rem']; ?>
		</td>
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $caiss['Caiss']['id']), array('class' => 'to_detail', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $caiss['Caiss']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $caiss['Caiss']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $caiss['Caiss']['lib'])); ?>

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
