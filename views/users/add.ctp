<?php
/*
 * add user
 */
App::import('Lib', 'functions'); //imports app/libs/functions
?>
<div class="users form">

	<?php echo $this->AlaxosForm->create('User');?>
	
 	<h2><?php ___('add user'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>

<div>	
<hr />
Bonjour,<br/>
<br/>
Voici vos informations pour vous connecter à l'intranet<br/>
<br/>
http://<?php  echo SERVEUR.RACINEDIR?>/users/login<br/>
<br/>
&nbsp;&nbsp;Utilisateur  :   <? echo $_POST['mail'];?><br/>
&nbsp;&nbsp;Mot de passe :  <? echo generate_password(8); ?><br/>
<br/>
(attention à bien respecter les minuscules/majuscules et à ne pas mettre d'espace avant/après)<br/>
<br/>
Une fois enregistré, vous pourrez consulter l'intranet. Merci de garder ces infos pour vous et ne pas les transmettre.
</div>




<div>
	<!-- 1st COLUMN -->
			<table border="0" cellpadding="5" cellspacing="0" class="edit">
			<tr>
				<td>
					<?php ___('username') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('username', array('label' => false)); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('password') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('password', array('label' => false, 'value'=>'ta3.14oka')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php ___('email') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('email', array('label' => false)); ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<?php ___('role') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('role', array('label' => false, 'value'=>'member')); ?>
				</td>
			</tr>
						<tr>
				<td>
					<?php ___('PDD') ?>
				</td>
				<td>:</td>
				<td>
					<?php pdd(); ?>
				</td>
			</tr>
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
					<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
			</tr>
			</table>
</div>

</div>
