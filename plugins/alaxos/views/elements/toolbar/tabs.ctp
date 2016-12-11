<?php
if(isset($tabs) && count($tabs) > 0)
{
    echo '<div class="pagemenu">';
    echo '<ul>';
    
    foreach($tabs as $tab_id => $tab)
    {
        //debug($tab_id);
        
        if(isset($selected) && $selected == $tab_id)
        {
            echo '<li class="selected">';
        }
        else
        {
            echo '<li>';
        }
        
        echo $html->link($tab['label'], $tab['link']);
        echo '</li>';
    }
    
    echo '</ul>';
    echo '</div>';
}
else
{
    echo '<em>unitinialized toolbar</em>';
}
?>