<div class="users form">
<?php 
if($_GET[idx]!=$session->read('Auth.User.id')) {
	echo "Hello little pirate, sorry you're fired!"; exit;
}

echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Modifier mes coordonnées');?></legend>
	<?php
	//print_r($this['User']);
		echo $form->input('idx',array('value'=>$_GET['idx'], 'type'=>'hidden'));
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('username', array('value'=>$form->value('username'), 'type'=>'hidden'));
		echo $form->input('email');
//		echo $form->input('password');
//		echo $form->input('role');
	?>
	</fieldset>
<?php echo $form->end('Enregistrer');?>
<strong>Attention, une fois que vous aurez soumis vos modifications, vous devrez vous enregistrer à nouveau</strong>


</div>
