<div class="users view">
	
	<h2><?php ___('user');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $user['User']['id'], 'delete_id' => $user['User']['id'], 'delete_text' => ___('do you really want to delete this user ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('username'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('email'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $user['User']['email']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('pseudo'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $user['User']['pseudo']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('role'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $user['User']['role']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('datein'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $user['User']['dateIn']; ?>
		</td>
	</tr>
	</table>
</div>
