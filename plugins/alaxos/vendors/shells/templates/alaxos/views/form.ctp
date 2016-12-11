<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * @author Nicolas Rod <nico@alaxos.com> (adaptation for Alaxos plugin)
 */
?>
<div class="<?php echo $pluralVar;?> form">

<?php
	echo "\t<?php echo \$this->AlaxosForm->create('{$modelClass}');?>\n";
	
	if (strpos($action, 'edit') !== false)
	{
		echo "\t<?php echo \$this->AlaxosForm->input('" . $primaryKey . "'); ?>\n";
	}
?>
	
 	<h2><?php printf("<?php ___('%s %s'); ?>", strtolower(Inflector::humanize($action)), strtolower($singularHumanName)); ?></h2>
 	
 	<?php
 	if (strpos($action, 'edit') !== false)
	{
		echo "<?php\n";
	 	echo "\techo \$this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true, 'back_to_view_id' => \${$singularVar}['{$modelClass}']['id']));\n";
	 	echo "\t?>\n";
	}
	else
	{
		echo "<?php\n";
	 	echo "\techo \$this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'list' => true));\n";
	 	echo "\t?>\n";
	}
 	?>
 	
 	<table border="0" cellpadding="5" cellspacing="0" class="edit">
<?php
	foreach ($fields as $field)
	{
		if (strpos($action, 'add') !== false && $field == $primaryKey)
		{
			continue;
		}
		elseif (!in_array($field, array('id', 'created', 'modified', 'updated', 'created_by', 'modified_by', 'updated_by')))
		{
?>
	<tr>
		<td>
			<?php echo "<?php ___('" . $field . "') ?>\n";?>
		</td>
		<td>:</td>
		<td>
			<?php echo "<?php echo \$this->AlaxosForm->input('{$field}', array('label' => false)); ?>\n"; ?>
		</td>
	</tr>
<?php
		}
	}
	
	if (!empty($associations['hasAndBelongsToMany']))
	{
		foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData)
		{
			?>
	<tr>
		<td>
			<?php echo "<?php ___('" . $assocName . "') ?>\n";?>
		</td>
		<td>:</td>
		<td>
			<?php echo "<?php echo \$this->AlaxosForm->input('{$assocName}', array('label' => false)); ?>"; ?>
		</td>
	</tr>
			<?php
		}
	}
?>
	<tr>
 		<td></td>
 		<td></td>
 		<td>
			<?php
			if (strpos($action, 'edit') === false)
			{
			    echo "<?php echo \$this->AlaxosForm->end(___('submit', true)); ?>";
			}
			else
			{
			     echo "<?php echo \$this->AlaxosForm->end(___('update', true)); ?>";
			}
			?>
 		</td>
 	</tr>
	</table>

</div>
