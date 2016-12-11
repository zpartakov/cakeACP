<?php
/**
 * @deprecated From version 1.3 of CakePHP, it is not useful anymore
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosPaginatorHelper extends PaginatorHelper
{
    var $helpers = array('Html', 'Ajax', 'Alaxos.AlaxosHtml');
    
    /**
     * @deprecated From version 1.3 of CakePHP, the core PaginatorHelper does exactly the same
     */
	public function sort_dir($property_name, $title, $sort, $direction = 'asc', $nowrap_title = false, $link_params = null)
	{
	    $title = ___($title, true);
	    $title = $nowrap_title ? $this->AlaxosHtml->nowrap($title) : $title;
	    
	    $url_array = array();
	    $url_array['direction'] = ($sort == $property_name && $direction == 'asc') ? 'desc' : 'asc';
	    
	    if(isset($link_params) && is_array($link_params))
	    {
	        $param_str = '';
	        foreach($link_params as $param_name => $param_value)
	        {
	            $param_str .= $param_name . ':' . $param_value;
	        }
	        
	        $url_array[] = $param_str;
	    }
	    
	    if(StringTool :: start_with(Configure::version(), '1.2'))
	    {
	        /*
	         * Hack for CakePHP prior to 1.3: there was a bug on the sort direction
	         */
	        $class = ($sort == $property_name && $direction == 'asc') ? 'asc' : (($sort == $property_name) ? 'desc' : '');
	    }
	    else
	    {
	        trigger_error('AlaxosPaginator->sort_dir() is deprecated. Use CakePHP 1.3 PaginatorHelper instead.', E_USER_NOTICE);
	        $class = null;
	    }
	    
		echo $this->sort($title,
						$property_name,
						array('url' =>      $url_array,
							  'class' =>    $class,
							  'escape' =>   false)
						);
	}
}
?>