<div class="tblCustomers view">
<h2><?php  __('Adresses Cocagnard/e/s (commandes)');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersNo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersNo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersPDDDistrNo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersPDDDistrNo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersNom'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersNom']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersPrenom'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersPrenom']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersAdresse'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersAdresse']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersTelephone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersTelephone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersNPA'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersNPA']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersLocalite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersLocalite']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PersAdresseEmail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['PersAdresseEmail']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Jos User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['jos_user_id']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type de part'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tblCustomer['TblCustomer']['type_part']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tbl Customer', true), array('action' => 'edit', $tblCustomer['TblCustomer']['PersNo'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tbl Customer', true), array('action' => 'delete', $tblCustomer['TblCustomer']['PersNo']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tblCustomer['TblCustomer']['PersNo'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tbl Customers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tbl Customer', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
