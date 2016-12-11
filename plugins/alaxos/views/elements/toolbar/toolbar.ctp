<?php
/*
* include CSS needed to show the datepicker
*/
$this->AlaxosHtml->css('/alaxos/css/alaxos', null, array('inline' => false));

$container_class = isset($container_class) ? $container_class : 'toolbar_container';
$toolbar_class = isset($toolbar_class) ? $toolbar_class : 'toolbar';

e('<div class="' . $container_class . '">');
	e('<div class="' . $toolbar_class . '">');
	
	$separator = '&nbsp;&nbsp;';
	
	if(isset($back_to_view_id))
	{
		e($html->link($html->image('/alaxos/img/toolbar/undo.png', array('alt' => ___d('alaxos', 'back', true))), array('action'=>'view', $back_to_view_id), array('alt' => ___d('alaxos', 'cancel', true), 'title' => ___d('alaxos', 'cancel', true), 'escape' => false)));
		e($separator);
	}
	
	if(isset($back_to_view_link))
	{
		e($html->link($html->image('/alaxos/img/toolbar/undo.png', array('alt' => ___d('alaxos', 'undo', true))), $back_to_view_link, array('alt' => ___d('alaxos', 'cancel', true), 'title' => ___d('alaxos', 'cancel', true), 'escape' => false)));
		e($separator);
	}
	
	if(isset($add) && $add)
	{
		e($html->link($html->image('/alaxos/img/toolbar/add.png', array('alt' => ___d('alaxos', 'add', true))), array('action'=>'add'), array('alt' => ___d('alaxos', 'add', true), 'title' => ___d('alaxos', 'add', true), 'escape' => false)));
		
		if(isset($add_text) && $add_text)
	    {
	        echo '&nbsp;' . $add_text;
	    }
	    
		e($separator);
	}
	
	
	if(isset($add_link))
	{
		e($html->link($html->image('/alaxos/img/toolbar/add.png', array('alt' => ___d('alaxos', 'add', true))), $add_link, array('alt' => ___d('alaxos', 'add', true), 'title' => ___d('alaxos', 'add', true), 'escape' => false)));
		
		if(isset($add_text) && $add_text)
	    {
	        echo '&nbsp;' . $add_text;
	    }
	    
		e($separator);
	}
	
	if(isset($edit_id))
	{
		e($html->link($html->image('/alaxos/img/toolbar/editor.png', array('alt' => __d('alaxos', 'edit', true))), array('action'=>'edit', $edit_id), array('alt' => ___d('alaxos', 'edit', true), 'title' => ___d('alaxos', 'edit', true), 'escape' => false)));
		e($separator);
	}
	
	if(isset($edit_link))
	{
		e($html->link($html->image('/alaxos/img/toolbar/editor.png', array('alt' => __d('alaxos', 'edit', true))), $edit_link, array('alt' => ___d('alaxos', 'edit', true), 'title' => ___d('alaxos', 'edit', true), 'escape' => false)));
		e($separator);
	}
	
	if(isset($list) && $list)
	{
		e($html->link($html->image('/alaxos/img/toolbar/list.png', array('alt' => __d('alaxos', 'list', true))), array('action' => 'index'), array('alt' => ___d('alaxos', 'list', true), 'title' => ___d('alaxos', 'list', true), 'escape' => false)));
		e($separator);
	}
	
	if(isset($list_link))
	{
		e($html->link($html->image('/alaxos/img/toolbar/list.png', array('alt' => __d('alaxos', 'list', true))), $list_link, array('alt' => ___d('alaxos', 'list', true), 'title' => ___d('alaxos', 'list', true), 'escape' => false)));
		e($separator);
	}
	
	if(isset($delete_id))
	{
	    $delete_text = isset($delete_text) ? $delete_text : ___d('alaxos', 'do you really want to delete this item ?', true);
		e($html->link($html->image('/alaxos/img/toolbar/drop.png', array('alt' => __d('alaxos', 'delete', true))), array('action' => 'delete', $edit_id), array('alt' => ___d('alaxos', 'delete', true), 'title' => ___d('alaxos', 'delete', true), 'escape' => false), $delete_text));
		e($separator);
	}
	
	if(isset($deactivate_id))
	{
	    $deactivate_text = isset($deactivate_text) ? $deactivate_text : ___d('alaxos', 'do you really want to deactivate this item ?', true);
		e($html->link($html->image('/alaxos/img/toolbar/deactivate22.png', array('alt' => __d('alaxos', 'deactivate', true))), array('action' => 'deactivate', $deactivate_id), array('alt' => ___d('alaxos', 'deactivate', true), 'title' => ___d('alaxos', 'deactivate', true), 'escape' => false), $deactivate_text));
		e($separator);
	}
	
	if(isset($reactivate_id))
	{
	    $reactivate_text = isset($reactivate_text) ? $reactivate_text : ___d('alaxos', 'do you really want to reactivate this item ?', true);
		e($html->link($html->image('/alaxos/img/toolbar/reactivate22.png', array('alt' => __d('alaxos', 'reactivate', true))), array('action' => 'activate', $reactivate_id), array('alt' => ___d('alaxos', 'reactivate', true), 'title' => ___d('alaxos', 'reactivate', true), 'escape' => false), $reactivate_text));
		e($separator);
	}
	
	if(isset($additional_buttons))
	{
	    foreach($additional_buttons as $additional_button)
	    {
	        echo $additional_button;
	        echo $separator;
	    }
	}
	
	e('</div>');
	
	if(!isset($counter) || $counter)
	{
		if(isset($paginator->params['paging']) && count($paginator->params['paging']) > 0)
		{
		    e('<div class="paging_info">');
		    
			e($paginator->counter(array('format' => ___d('alaxos', 'elements: %count%', true))));
			e('<br/>');
			e($paginator->counter(array('format' => ___d('alaxos', 'page %page% on %pages%', true))));
			
			e('</div>');
		}
	}
	
e('</div>');
?>