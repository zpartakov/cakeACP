<div class="josPdds view">
<h2><?php  __('JosPdd');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDINo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDINo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDTexte'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDTexte']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDNom'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDNom']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDAdr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDAdr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDNoRue'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDNoRue']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDTele'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDTele']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDLieu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDLieu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDEmail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDEmail']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDRem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDRem']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDGP'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDGP']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PDDPP'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $josPdd['JosPdd']['PDDPP']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<h2>Cocagnard/e/s de ce PDD</h2><ul>
<?php 
$sql="SELECT * FROM tbl_customers WHERE PersPDDDistrNo=".$josPdd['JosPdd']['id'] ." ORDER BY PersNom, PersPrenom";
//echo $sql;
$sql=mysql_query($sql);
debug($sql);
$i=0;
while ($i<mysql_num_rows($sql)) {
	echo "<li>";
	echo mysql_result($sql, $i,'PersNom').", ".mysql_result($sql, $i,'PersPrenom');
	echo "</li>";
	$i++;
}
?>
</ul>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit JosPdd', true), array('action'=>'edit', $josPdd['JosPdd']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete JosPdd', true), array('action'=>'delete', $josPdd['JosPdd']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $josPdd['JosPdd']['id'])); ?> </li>
		<li><?php echo $html->link(__('List JosPdds', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New JosPdd', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
