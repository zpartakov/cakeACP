<?php
/*******************************************************************************************************
 * This element allows to render an horizontal menu containing the links that are given in the $menu_items variable.
 *
 * Building the menu
 * -----------------
 *
 * The menu items should be constructed this way:
 *
 * $menu_items   = array();
 * $menu_items[] = array('title' => ___('home', true),  'link' => '/');
 * $menu_items[] = array('title' => ___('users', true), 'link' => '/users');
 * $menu_items[] = array('title' => ___('roles', true), 'link' => '/roles', 'class' => 'my_css_class');
 *
 * Subitems appearing on item hovering can be added this way:
 *
 * $menu_items[] = array(
 *                         array('title' => ___('members', true),           'link' => '/admin/members',          'id' => 'members'),
 *                         array('title' => ___('honorary members', true),  'link' => '/admin/members/honorary', 'id' => 'honorary_members'),
 *                         array('title' => ___('members pictures', true),  'link' => '/admin/member_pictures')
 *                      );
 *
 * The first link ('members') is displayed as a menu item. The next ones are displayed as subitems.
 *
 * Auto selected item
 * -------------------
 *
 * The selected menu item can be styled with the 'selected' CSS class.
 *
 * The element tries to add the 'selected' CSS class by default on menu items/subitems if the link they contain leads to the current page.
 * The CSS class is added if:
 *
 * - the link and the current page have the same prefix (e.g 'admin') and the same controller name
 * - the link and the current page have the same plugin name
 *
 * Forcing a selected item/subitem
 * --------------------------------
 *
 * It is also possible to force the selection of a menu item/subitem. For this:
 *
 * - a menu item/subitem must have an 'id' property.
 * - the $selected_item variable with the 'id' property value must be passed to the element
 *
 * echo $this->element('menu/horizontal', array('plugin' => 'alaxos', 'menu_items' => $menu_items, 'selected_item' => 'honorary_members'));
 *
 * CSS
 * ---
 *
 * The CSS file '/alaxos/css/menu.css' is provided as a default style.
 *
 * It can be included by passing
 *
 * 		$import_css=true
 *
 * to the element. But please note that in this case it will be included as an inline CSS import.
 * The reason is that at least until CakePHP 1.3.7, adding an import in the page header is not possible
 * if the call to the Html->css() method is made in a element, itself being called from a layout.
 *
 * Special CSS class can be given on menu items/subitem by using the 'class' property on menu items.
 *
 ******************************************************************************************************/
if(isset($menu_items))
{
    if(isset($import_css) && $import_css === true)
    {
        /*
         * Render the required CSS inline, as if an element is rendered from a layout, it wouldn't work with inline => false
         * And a menu is very likely going to be included in a layout
         */
        echo $this->Html->css('/alaxos/css/menu', 'import');
    }
    
    $links = array();
    
    foreach($menu_items as $key => $menu_item)
    {
        if(isset($menu_item['title']))
        {
            $id      = !empty($menu_item['id']) ? $menu_item['id'] : null;
            $title   = $menu_item['title'];
            $link    = $menu_item['link'];
            $options = !empty($menu_item['options']) ? $menu_item['options'] : null;
            
            if(!isset($selected_item))
            {
                $parsed_link = array_merge(array('prefix' => null), Router :: parse($link));
                    $parsed_url  = array_merge(array('prefix' => null), Router :: parse($this->params['url']['url']));
            
                if(!empty($parsed_link['plugin']) && $parsed_link['plugin'] == $parsed_url['plugin']
                    ||
                   ($parsed_link['prefix'] == $parsed_url['prefix'] && $parsed_link['controller'] == $parsed_url['controller'])
                  )
                {
                    $options['class'] = isset($options['class']) ? $options['class'] . ' selected' : 'selected';
                }
            }
            elseif($selected_item == $id)
            {
                $options['class'] = isset($options['class']) ? $options['class'] . ' selected' : 'selected';
            }
            
            $links[] = $this->Html->link($title, $link, $options);
        }
        elseif(is_array($menu_item))
        {
            /*
             * Array but no title given -> it is a submenu
             */
            
            $sublinks    = array();
            $parent_link = null;
            
            foreach($menu_item as $menu_subitem)
            {
                $id      = !empty($menu_subitem['id']) ? $menu_subitem['id'] : null;
                $title   = $menu_subitem['title'];
                $link    = $menu_subitem['link'];
                $options = !empty($menu_subitem['options']) ? $menu_subitem['options'] : null;

                if(!isset($selected_item))
                {
                    $parsed_link = array_merge(array('prefix' => null), Router :: parse($link));
                    $parsed_url  = array_merge(array('prefix' => null), Router :: parse($this->params['url']['url']));

                    if(!empty($parsed_link['plugin']) && $parsed_link['plugin'] == $parsed_url['plugin']
                        ||
                        ($parsed_link['prefix'] == $parsed_url['prefix'] && $parsed_link['controller'] == $parsed_url['controller'])
                      )
                    {
                        $options['class'] = isset($options['class']) ? $options['class'] . ' selected' : 'selected';
                    }
                }
                elseif($selected_item == $id)
                {
                    $options['class'] = isset($options['class']) ? $options['class'] . ' selected' : 'selected';
                }

                if(!isset($parent_link))
                {
                    $parent_link = $this->Html->link($title, $link, $options);
                }
                else
                {
                    $sublinks[] = $this->Html->link($title, $link, $options);
                }
            }
            
            $links[$parent_link] = $sublinks;
        }
    }

    if(count($links) > 0)
    {
        echo '	<div class="horizontal_menu_wrapper">';
        echo $this->Html->nestedList($links, array('class' => 'navbar'));
        echo '	</div>';
    }
}

