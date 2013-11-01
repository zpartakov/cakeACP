<?php
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
Merci de remplir ce formulaire pour vous inscrire, vous recevrez prochainement de nos nouvelles avec vos informations de connexion
</div>
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
					<?php ___('pseudo') ?>
				</td>
				<td>:</td>
				<td>
					<?php echo $this->AlaxosForm->input('pseudo', array('label' => false)); ?>
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
