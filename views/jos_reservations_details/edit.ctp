<div class="josReservationsDetails form">
<?php echo $form->create('JosReservationsDetail');?>
	<fieldset>
 		<!-- <legend><?php __('Edit JosReservationsDetail');?></legend> -->
 		<legend>Editer la demi-journée</legend>
	<?php
		echo $form->input('id');
		echo $form->input('date');
		echo $form->input('user');
		echo $form->input('npers');
		echo $form->input('rem');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Effacer', true), array('action'=>'delete', $form->value('JosReservationsDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('JosReservationsDetail.id'))); ?></li>
		<li><?php echo $html->link(__('Lister les demi-journées (détail)', true), array('action'=>'index'));?></li>
	</ul>
</div>
