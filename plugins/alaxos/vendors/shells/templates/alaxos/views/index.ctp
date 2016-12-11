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
<div class="<?php echo $pluralVar;?> index">
	
	<h2><?php echo "<?php ___('" . strtolower($pluralHumanName) . "');?>";?></h2>
	 	
<?php
	echo "\t<?php\n";
 	echo "\techo \$this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));\n";
 	echo "\t?>\n";
	
 	echo "\n";
	
 	echo "\t<?php\n";
    echo "\techo \$alaxosForm->create('{$modelClass}', array('controller' => '{$pluralVar}', 'url' => \$this->passedArgs));\n";
    echo "\t?>\n";
    ?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
<?php  foreach ($fields as $field):?>
<?php
		if (!in_array($field, array('id', 'password', 'created_by', 'modified_by', 'updated_by')))
		{
			$isKey = false;
			if (!empty($associations['belongsTo']))
			{
				foreach ($associations['belongsTo'] as $alias => $details)
				{
					if ($field === $details['foreignKey'])
					{
						$isKey = true;
						echo "\t\t<th>";
						echo "<?php echo \$this->Paginator->sort(__('" . strtolower($alias) . "', true), '{$modelClass}.{$field}');?>";
						echo "</th>\n";
						break;
					}
				}
			}
			
			if(!$isKey)
			{
			    if(in_array($field, array('created', 'modified', 'updated')))
			    {
			        echo "\t\t<th style=\"width:120px;\">";
			    }
			    else
			    {
			        echo "\t\t<th>";
			    }
				echo "<?php echo \$this->Paginator->sort(__('{$field}', true), '{$modelClass}.{$field}');?>";
				echo "</th>\n";
			}
		}
?>
<?php endforeach;?>
		
		<th class="actions"><?php echo "<?php __('Actions');?>";?></th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
	<?php
	foreach ($fields as $field)
	{
		if (!in_array($field, array('id', 'password', 'created_by', 'modified_by', 'updated_by')))
		{
			echo "\t\t<td>\n\t\t\t<?php\n";
			echo "\t\t\t\techo \$this->AlaxosForm->filter_field('{$field}');\n";
			echo "\t\t\t?>\n\t\t</td>\n";
		}
	}
	
//	if (!empty($associations['hasAndBelongsToMany']))
//	{
//		foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData)
//		{
//			echo "\t\t<td>\n\t\t\t<?php\n";
//			echo "\t\t\t\techo \$this->AlaxosForm->filter_field('{$assocName}');\n";
//			echo "\t\t\t? >\n\t\t</td>\n";
//		}
//	}
	?>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    			<?php echo "\t\t<?php echo \$this->AlaxosForm->end(___('search', true));?>\n"; ?>
    		</div>
    		
    		<?php
    		echo "<?php\n";
    		echo "\t\t\techo \$alaxosForm->create('{$modelClass}', array('id' => 'chooseActionForm', 'url' => array('controller' => '{$pluralVar}', 'action' => 'actionAll')));\n";
    		echo "\t\t\t?>\n";
    		?>
    	</td>
	</tr>
	
	<?php
	echo "<?php
	\$i = 0;
	foreach (\${$pluralVar} as \${$singularVar}):
		\$class = null;
		if (\$i++ % 2 == 0)
		{
			\$class = ' class=\"row\"';
		}
		else
		{
			\$class = ' class=\"altrow\"';
		}
	?>\n";
	echo "\t<tr<?php echo \$class;?>>\n";
	
	echo "\t\t<td>\n";
	echo "\t\t<?php\n";
	echo "\t\techo \$alaxosForm->checkBox('{$modelClass}.' . \$i . '.id', array('value' => \${$singularVar}['{$modelClass}']['id']));\n";
	echo "\t\t?>\n";
	echo "\t\t</td>\n";
		
		foreach ($fields as $field)
		{
			if (!in_array($field, array('id', 'password', 'created_by', 'modified_by', 'updated_by')))
			{
				$isKey = false;
				if (!empty($associations['belongsTo']))
				{
					foreach ($associations['belongsTo'] as $alias => $details)
					{
						if ($field === $details['foreignKey'])
						{
							$isKey = true;
							echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
							break;
						}
					}
				}
				
				if ($isKey !== true)
				{
				    if(in_array($schema[$field]['type'], array('date', 'datetime')))
				    {
				        echo "\t\t<td>\n\t\t\t<?php echo DateTool :: sql_to_date(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t</td>\n";
				    }
					elseif($schema[$field]['type'] == 'boolean')
			    	{
			    		echo "\t\t<td>\n";
			    		echo "\t\t\t<?php\n";
			    		echo "\t\t\techo \$alaxosHtml->get_yes_no(\${$singularVar}['{$modelClass}']['{$field}']);\n";
						echo "\t\t\t?>\n";
						echo "\t\t</td>\n";
			    	}
				    else
				    {
				        echo "\t\t<td>\n\t\t\t<?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>\n\t\t</td>\n";
				    }
				}
			}
		}

		echo "\t\t<td class=\"actions\">\n\n";
		echo "\t\t\t<?php echo \$html->link(\$html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', \${$singularVar}['{$modelClass}']['id']), array('id' => 'detail', 'escape' => false)); ?>\n";
		echo "\t\t\t<?php echo \$html->link(\$html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['id']), array('escape' => false)); ?>\n";
		
		if(isset($displayField) && !empty($displayField))
		{
		    echo "\t\t\t<?php echo \$html->link(\$html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['id']), array('escape' => false), sprintf(___(\"are you sure you want to delete '%s' ?\", true), \${$singularVar}['{$modelClass}']['{$displayField}'])); ?>\n";
		}
		else
		{
		    echo "\t\t\t<?php echo \$html->link(\$html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['id']), array('escape' => false), sprintf(___(\"are you sure you want to delete this element ?\", true))); ?>\n";
		}
		
		echo "\n\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
	?>
	</table>

	<div class="paging">
	<?php echo "\t<?php echo \$this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>\n";?>
	 |
	 <?php echo "\t<?php echo \$this->Paginator->numbers();?>"?>
	 |
	<?php echo "\t<?php echo \$this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>\n";?>
	</div>
	
	<?php
	echo "<?php\n";
	echo "if(\$i > 0)\n";
	echo "{\n";
	echo "\techo '<div class=\"choose_action\">';\n";
	echo "\techo ___d('alaxos', 'action to perform on the selected items', true);\n";
	echo "\techo '&nbsp;';\n";
	echo "\techo \$alaxosForm->input_actions_list();\n";
	echo "\techo '&nbsp;';\n";
	echo "\techo \$alaxosForm->end(array('label' =>___d('alaxos', 'go', true), 'div' => false));\n";
	echo "\techo '</div>';\n";
	echo "}\n";
	echo "?>\n";
	?>
	
</div>