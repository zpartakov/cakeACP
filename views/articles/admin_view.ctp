<div class="articles view">
	
	<h2><?php ___('article');?></h2>
	
	<?php
	echo $this->element('toolbar/toolbar', array('plugin' => 'alaxos', 'add' => true, 'list' => true, 'edit_id' => $article['Article']['id'], 'delete_id' => $article['Article']['id'], 'delete_text' => ___('do you really want to delete this article ?', true)));
	?>

	<table border="0" class="view">
	<tr>
		<td>
			<?php ___('lang'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $article['Article']['lang']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('title'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $article['Article']['title']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('introtext'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $article['Article']['introtext']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('fulltext'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $article['Article']['fulltext']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('state'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $article['Article']['state']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('created'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo DateTool :: sql_to_date($article['Article']['created']); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php ___('modified'); ?>
		</td>
		<td>:</td>
		<td>
			<?php echo $article['Article']['modified']; ?>
		</td>
	</tr>
	</table>
</div>
