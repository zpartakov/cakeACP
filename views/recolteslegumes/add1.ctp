<?php
$recolte=$_GET['recolte'];
?>
<div class="recolteslegumes form">

	<?php echo $this->AlaxosForm->create('Recolteslegume',array('action'=>'add2'));?>
	
 	<h2><?php ___('Choix du légume'); ?></h2>
	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">

			<?php 
			echo $this->AlaxosForm->hidden('recolte', array('label' => false, 'default'=>$recolte)); 
			?>


	<tr>
		<td>
			<?php ___('legume_id') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('legume_id', array('label' => false)); ?>
		</td>
	</tr>
	
	<tr>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
 	</tr>
	</table>

</div>
