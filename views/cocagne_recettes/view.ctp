<div class="cocagneRecettes view">
<h2><?php  __('Cocagne Recette');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['titre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ingredients'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['ingredients']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Preparation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['preparation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Genre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['genre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cocagneRecette['CocagneRecette']['image']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cocagne Recette', true), array('action' => 'edit', $cocagneRecette['CocagneRecette']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Cocagne Recette', true), array('action' => 'delete', $cocagneRecette['CocagneRecette']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cocagneRecette['CocagneRecette']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cocagne Recettes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cocagne Recette', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
