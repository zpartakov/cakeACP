<?php 
/*
 * a form for an administrator to confirm new user registration
 * 
 * todo: preg for login, check pseudo, passwd generator, email new user when finished
 */
print_r($user); 
App::import('Lib', 'functions'); //imports app/libs/functions 

$random_password=generate_password(8);
$email=$user['0']['User']['username'];
$pseudo=$user['0']['User']['pseudo'];
$username=preg_replace("/@.*$/","",$email);
//echo $random_password; exit;
//exit;
?><div class="users form">

	<?php 
	//echo $this->AlaxosForm->create('User', array('action'=>'edit'));
	//todo: make nice in one shot see after
	echo $this->AlaxosForm->create('User');
	?>
	
	<?php echo $this->AlaxosForm->input('id', array('value'=>$user['0']['User']['id'])); ?>
	
 	<h2><?php ___('confirm new user'); ?></h2>
 	
 
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('username') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('username', array('label' => false, 'value'=>$email)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('password') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('text', array('label' => false, 'value'=>$random_password)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('email') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('email', array('label' => false, 'value'=>$email)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('pseudo') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('pseudo', array('label' => false, 'value'=>$pseudo)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('role') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('role', array('label' => false, 'value'=>"www")); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('dateIn') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('dateIn', array('label' => false, 'value'=>date("Y-m-d h:i:s"))); ?>
		</td>
	</tr>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('update', true)); ?> 		</td>
 	</tr>
	</table>

</div>
