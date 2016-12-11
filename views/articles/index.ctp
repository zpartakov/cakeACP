<div class="articles index">
	
	<h2><?php ___('articles');?></h2>
	 	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'container_class' => 'toolbar_container_list'));
	?>

	<?php
	echo $this->AlaxosForm->create('Article', array('url' => $this->passedArgs)); //'url' => $this->passedArgs allows to keep the sort when searching
	?>
    
	<table cellspacing="0" class="administration">
	
	<tr class="sortHeader">
		<th style="width:5px;"></th>
		<th><?php echo $this->Paginator->sort(__('title', true), 'Article.title');?></th>
		<th><?php echo $this->Paginator->sort(__('text', true), 'Article.text');?></th>
		<th><?php echo $this->Paginator->sort(__('state', true), 'Article.state');?></th>
		<th style="width:120px;"><?php echo $this->Paginator->sort(__('created', true), 'Article.created');?></th>
		<th style="width:120px;"><?php echo $this->Paginator->sort(__('modified', true), 'Article.modified');?></th>
		
		<th class="actions">&nbsp;</th>
	</tr>
	
	<tr class="searchHeader">
		<td></td>
			<td>
			<?php
				echo $this->AlaxosForm->filter_field('title');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('text');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('state');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('created');
			?>
		</td>
		<td>
			<?php
				echo $this->AlaxosForm->filter_field('modified');
			?>
		</td>
		<td class="searchHeader" style="width:80px">
    		<div class="submitBar">
    					<?php echo $this->AlaxosForm->end(___('search', true));?>
    		</div>
    		
    		<?php
			echo $this->AlaxosForm->create('Article', array('id' => 'chooseActionForm', 'url' => array('controller' => 'articles', 'action' => 'actionAll')));
			?>
    	</td>
	</tr>
	
	<?php
	$i = 0;
	foreach ($articles as $article):
		$class = null;
		if ($i++ % 2 == 0)
		{
			$class = ' class="row"';
		}
		else
		{
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php
		echo $this->AlaxosForm->checkBox('Article.' . $i . '.id', array('value' => $article['Article']['id']));
		?>
		</td>
		<td>
			<?php echo $article['Article']['title']; ?>
		</td>
		<td>
			<?php echo $article['Article']['text']; ?>
		</td>
		<td>
			<?php echo $article['Article']['state']; ?>
		</td>
		<td>
			<?php echo DateTool :: sql_to_date($article['Article']['created']); ?>
		</td>
		<td>
			<?php echo $article['Article']['modified']; ?>
		</td>
		<td class="actions">

			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/loupe.png'), array('action' => 'view', $article['Article']['id']), array('class' => 'to_detail', 'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_edit.png'), array('action' => 'edit', $article['Article']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('/alaxos/img/toolbar/small_drop.png'), array('action' => 'delete', $article['Article']['id']), array('escape' => false), sprintf(___("are you sure you want to delete '%s' ?", true), $article['Article']['title'])); ?>

		</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 |
	 	<?php echo $this->Paginator->numbers(array('modulus' => 5, 'first' => 2, 'last' => 2, 'after' => ' ', 'before' => ' '));?>	 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	
	<?php
if($i > 0)
{
	echo '<div class="choose_action">';
	echo ___d('alaxos', 'action to perform on the selected items', true);
	echo '&nbsp;';
	echo $this->AlaxosForm->input_actions_list();
	echo '&nbsp;';
	echo $this->AlaxosForm->end(array('label' =>___d('alaxos', 'go', true), 'div' => false));
	echo '</div>';
}
?>
	
</div>
