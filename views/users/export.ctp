<?php
/*
 * list users
 */
App::import('Lib', 'functions'); //imports app/libs/functions
?>
<div class="users index">
	
	<h2><?php ___('users');?></h2>
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th>name</th>
				<th>username</th>
				<th>email</th>
		<th>role</th>
		<th>PDD</th>
		<th>Oeufs</th>
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

	</tr>
<?php endforeach; ?>
	</table>


	

	
</div>