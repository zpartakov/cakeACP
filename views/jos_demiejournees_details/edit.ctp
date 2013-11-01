<?php
/**
* @version        $Id: edit.ctp v1.0 15.10.2010 12:37:26 CEST $
* @package        Cocagne
* @copyright      Copyright (C) 2010 - 2014 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Cocagne is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
$this->pageTitle = 'Modifier une inscription'; 

?>
<div class="josDemiejourneesDetails form">
<?php echo $form->create('JosDemiejourneesDetail');?>
	<fieldset>
 		<legend><?php echo $this->pageTitle;?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('date');
		echo $form->input('user', array('label'=>'Cocagnard/e'));

		echo $form->input('npers', array('label'=>'Nombre de personnes'));
		echo $form->input('rem', array('label'=>'Remarques'));
	?>
	</fieldset>
<?php echo $form->end('Enregistrer');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('JosDemiejourneesDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('JosDemiejourneesDetail.id'))); ?></li>
		<li><?php echo $html->link(__('List JosDemiejourneesDetails', true), array('action' => 'index'));?></li>
	</ul>
</div>
