<?php
App::import('Lib', 'functions'); //imports app/libs/image_manipulation.php
?>
<style>
td {
	text-align: right;
	border: thin solid;
	}
	</style>
	
<div class="recoltes view">

	<h2><?php ___('recolte');?></h2>

	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $recolte['Recolte']['id'], 'delete_id' => $recolte['Recolte']['id'], 'delete_text' => ___('do you really want to delete this recolte ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('date'); ?>
		</td>
		<td>
			<?php echo DateTool :: sql_to_date($recolte['Recolte']['date']); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('lib'); ?>
		</td>
		<td>
			<?php echo $recolte['Recolte']['lib']; ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php ___('nb gp'); ?>
		</td>
		<td>
			<?php echo $recolte['Recolte']['nb_GP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('nb pp'); ?>
		</td>
		<td>
			<?php echo $recolte['Recolte']['nb_PP']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('date mod'); ?>
		</td>
		<td>
			<?php echo $recolte['Recolte']['date_mod']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('rem'); ?>
		</td>
		<td>
			<?php echo $recolte['Recolte']['rem']; ?>
		</td>
		
	
		
	</tr>
	</table>
</div>
<?php
recoltelegume($recolte['Recolte']['id'],$recolte['Recolte']['nb_GP'],$recolte['Recolte']['nb_PP']);
?>
