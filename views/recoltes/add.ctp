
<div class="recoltes form">

	<?php echo $this->AlaxosForm->create('Recolte');?>
	
 	<h2><?php ___('add recolte'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('date') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('date', array('label' => false,'onChange'=>'calculeSemaine()')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('lib') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('lib', array('label' => false)); ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php ___('nb_GP') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_GP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb_PP') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_PP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	
			
		
	<tr>
		<td>
			<?php ___('rem') ?>
			
			</td>
		<td>
			<?php echo $this->AlaxosForm->input('rem', array('label' => false)); ?>
		</td>
	</tr>
	<tr><td colspan="2"><div style="font-size: smaller">Remarque sur le cornet de la semaine (impression générale, manques, trop, etc....)<br />Si plusieurs terrains de provenance pour un légume faire des entrées séparées ou noter ici</div>
		</td></tr>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php echo $this->AlaxosForm->end(___('submit', true)); ?> 		</td>
 	</tr>
	</table>

</div>
