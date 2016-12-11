<div class="josUsers form">
<?php echo $form->create('JosUser');?>
	<fieldset>
 		<legend><?php __('Add JosUser');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('username');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('usertype');
		echo $form->input('block');
		echo $form->input('sendEmail');
		echo $form->input('gid');
		echo $form->input('registerDate');
		echo $form->input('lastvisitDate');
		echo $form->input('activation');
		echo $form->input('params');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List JosUsers', true), array('action' => 'index'));?></li>
	</ul>
</div>
