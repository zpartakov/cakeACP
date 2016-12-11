<div class="recolteslegumes form">

	<?php echo $this->AlaxosForm->create('Recolteslegume');?>
	<?php echo $this->AlaxosForm->input('id'); ?>
	
 	<h2><?php ___('edit recolteslegume'); ?></h2>
 	
 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => $recolteslegume['Recolteslegume']['id']));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('recolte_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('recolte_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('terrain_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('terrain_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('legume_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('legume_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite_id') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('unite_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb_caisse') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_caisse', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par_caisse_kg_pce') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('par_caisse_kg_pce', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par_caisse_reste') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('par_caisse_reste', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg_pce_total_par_lieu') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('kg_pce_total_par_lieu', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('recolte_kg_piece_total') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('recolte_kg_piece_total', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb_caisses_GP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_caisses_GP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb_caisses_PP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_caisses_PP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets_par_caisse_GP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('cornets_par_caisse_GP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets_par_caisse_PP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('cornets_par_caisse_PP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg_pce_par_cornet_GP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('kg_pce_par_cornet_GP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg_pce_par_cornet_PP') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('kg_pce_par_cornet_PP', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminPER') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixminPER', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxPER') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixmaxPER', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixminBIO') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixminBIO', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('prixmaxBIO') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixmaxBIO', array('label' => false)); ?>
		</td>
	</tr>
  <tr>
        <td>
            <?php ___('Prix FRACP'); ?>
        </td>
        <td>:</td>
        <td>
            <?php echo $this->AlaxosForm->input('prixfracp', array('label' => false)); ?>
        </td>
    </tr>
	<tr>
		<td>
			<?php ___('remarques') ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $this->AlaxosForm->input('remarques', array('label' => false)); ?>
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
<div class="actions">
		<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $recolteslegume['Recolteslegume']['id']), array('class' => 'to_detail', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $recolteslegume['Recolteslegume']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $recolteslegume['Recolteslegume']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $recolteslegume['Recolteslegume']['legume_id'])); ?>
</div>
