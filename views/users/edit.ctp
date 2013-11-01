<?php
/*
 * edit user
 */
App::import('Lib', 'functions'); //imports app/libs/functions
?>
<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('username');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('role');

/*
 * associated db tables
 * 
 * pdd, oeufs
 */		
		
$user=$form->value('id');
$pdd=pdd_user($user);

pdd($pdd); 

oeufs($user);

					?>
					
	</fieldset>
<?php echo $form->end('Submit');?>

	<!-- 
	<tr>
		<td>
			<?php ___('dateIn') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('dateIn', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('update', true)); ?> 		</td>
 	</tr>
 	 -->


</div>
