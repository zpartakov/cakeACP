<?php
/*
 * list users
 */
App::import('Lib', 'functions'); //imports app/libs/functions
?>
<div class="users index">
	
	<h2><?php ___('users');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $alaxosForm->create('User', array('controller' => 'users', 'url' => $this->passedArgs));
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('name', true), 'User.name');?></th>
				<th><?php echo $this->Paginator->sort(__('username', true), 'User.username');?></th>
				<th><?php echo $this->Paginator->sort(__('email', true), 'User.email');?></th>
		<th><?php echo $this->Paginator->sort(__('role', true), 'User.role');?></th>
		<th>PDD</th>
		<th>Oeufs</th>
<th class="actions"><?php __('Actions');?></th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
			<td>
			<?php
				echo $this->AlaxosForm->filter_field('name');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('username');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('email');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('role');
			?>
		</td>

		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $alaxosForm->create('User', array('id' => 'chooseActionForm', 'url' => array('controller' => 'users', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($users as $user):
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
		echo $alaxosForm->checkBox('User.' . $i . '.id', array('value' => $user['User']['id']));
		?>
		</td>
		<td>
			<?php echo $user['User']['name']; ?>
		</td>
				<td>
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['email']; ?>
		</td>
		<td>
			<?php echo $user['User']['role']; ?>
		</td>
		<td>
			<?php
			$current_user=$user['User']['id'];
			$pdd=pdd_user($current_user);
			//echo "PDD: " .$pdd;
			pdd_show($pdd); 

 ?>
		</td>
		<td>
			<?php oeufs_show($current_user); ?>
		</td>
		<td class="actions">

			<?php echo $html->link($html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $user['User']['id']), array('id' => 'detail', 'escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
			<?php echo $html->link($html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $user['User']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $user['User']['email'])); ?>

		</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 |
	 	<?php echo $this->Paginator->numbers();?>	 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	
	<?php
if($i > 0)
{
	echo '<div class="choose_action">';
	echo ___d('alaxos', 'action to perform on the selected items', true);
	echo '&nbsp;';
	echo $alaxosForm->input_actions_list();
	echo '&nbsp;';
	echo $alaxosForm->end(array('label' =>___d('alaxos', 'go', true), 'div' => false));
	echo '</div>';
}
?>
	
</div>