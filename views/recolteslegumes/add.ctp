<?php
$recolte=$_GET['recolte'];
$legume=$_GET['legume'];
$prixminPER=$_GET['prixminPER'];
$prixmaxPER=$_GET['prixmaxPER'];
$prixminBIO=$_GET['prixminBIO'];
$prixmaxBIO=$_GET['prixmaxBIO'];
$prixfracp=$_GET['prixfracp'];
#      public $uses = array('recoltes');
?>
<script language="JavaScript" type="text/javascript">
	function setVisibility(visibility) {
	$.each(['zerecolte_kg_piece_total', 'zenb_caisses_GP','zenb_caisses_PP','zeremarques'], function(index, value) { 
  /*alert(value + ' visibility: ' +document.getElementById(value).style.display); */
  document.getElementById(value).style.display = visibility;
});

	}
</script>

<div class="recolteslegumes form">

	<?php echo $this->AlaxosForm->create('Recolteslegume');?>
	
 	<h2><?php ___('add recolteslegume'); ?></h2>

 	 	 	<a href="javascript:setVisibility('inline')">Détail</a> | <a href="javascript:setVisibility('none')">Résumé</a>

 	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));
	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
	<tr>
		<td>
			<?php ___('recolte_id') ?>
		</td>
		<td>
			<?php 
			echo $this->AlaxosForm->input('recolte_id', array('label' => false, 'default'=>$recolte)); 
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('terrain_id') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('terrain_id', array('label' => false, 'default'=>'4')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('legume_id') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('legume_id', array('label' => false, 'default'=>$legume)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('unite_id') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('unite_id', array('label' => false)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb_caisse') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_caisse', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par_caisse_kg_pce') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('par_caisse_kg_pce', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('par_caisse_reste') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('par_caisse_reste', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('kg_pce_total_par_lieu') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('kg_pce_total_par_lieu', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr id="zerecolte_kg_piece_total" style="display: none">
		<td>
			<?php ___('recolte_kg_piece_total') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('recolte_kg_piece_total', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr id="zenb_caisses_GP" style="display: none">
		<td>
			<?php ___('nb_caisses_GP') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_caisses_GP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr id="zenb_caisses_PP" style="display: none">
		<td>
			<?php ___('nb_caisses_PP') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('nb_caisses_PP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets_par_caisse_GP') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('cornets_par_caisse_GP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('cornets_par_caisse_PP') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('cornets_par_caisse_PP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong><?php ___('kg_pce_par_cornet_GP') ?></strong>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('kg_pce_par_cornet_GP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong><?php ___('kg_pce_par_cornet_PP') ?></strong>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('kg_pce_par_cornet_PP', array('label' => false, 'value'=>'0')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong><?php ___('prixminPER') ?></strong>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixminPER', array('label' => false, 'value'=>$prixminPER)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong><?php ___('prixmaxPER') ?></strong>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixmaxPER', array('label' => false, 'value'=>$prixmaxPER)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong><?php ___('prixminBIO') ?></strong>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixminBIO', array('label' => false, 'value'=>$prixminBIO)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong><?php ___('prixmaxBIO') ?></strong>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('prixmaxBIO', array('label' => false, 'value'=>$prixmaxBIO)); ?>
		</td>
	</tr>
	  <tr>
        <td>
            <?php ___('Prix FRACP'); ?>
        </td>
        <td>
			<?php echo $this->AlaxosForm->input('prixfracp', array('label' => false, 'value'=>$prixfracp)); ?>
        </td>
    </tr>

	<tr>
		<td>
			<?php ___('remarques') ?>
		</td>
		<td>
			<?php echo $this->AlaxosForm->input('remarques', array('label' => false)); ?>
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
