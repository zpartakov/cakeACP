<?php
/**
 * This component allows to parse search fields and create an array containing conditions that can be passed
 * for instance to the paginate() method of a controller.
 *
 * Some of the conditions may be retrieved from Session, if a search with criteria was previously made on the current page
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosFilterComponent extends Object
{
	const START_PREFIX 	= 'start__';
	const END_PREFIX 	= 'end__';
	
	/**
	 * This Model name will be ignored by the filtering process.
	 * This allows to use this Model name in the view to pass technical infos between requests, such as keeping the search zone opened through Javascript
	 * @var string
	 */
	const MODEL_TECHNICAL = '_Tech';
	
    /**
     * fields which will replace the regular syntax in where i.e. field = 'value'
     */
    var $fieldFormatting = array('string' => '%s',
    							 'text'	  => '%s',
                                 'date'	  => " %s ");
                                 //'date'	  => " '%s' ");
    
    var $alias_fields = array();
    
    /**
     * @var AppController
     */
    var $controller = null;
    
    /**
    * a boolean indicating wether wildcards characters must be automatically appended
    * at the start and the end of 'string' and 'text' fields
    *
    * @var boolean
    */
    private $auto_append_wildcard_characters = true;
    
    /**
    * a boolean indicating wether any filter stored in session must be automatically cleared
    * when the page referer doesn't belong to any CRUD action of the same Model
    *
    * @var boolean
    */
    private $auto_clear_filter = true;
    
    /****************************************************************************************/
    
    public function initialize(&$controller)
	{
	    $this->controller = $controller;
	}
	
	/****************************************************************************************/
	
    /**
    * Get a boolean indicating wether wildcards characters must be automatically appended
    * at the start and the end of 'string' and 'text' fields
    *
    * @return boolean
    */
    public function get_auto_append_wildcard_characters()
    {
    	return $this->auto_append_wildcard_characters;
    }
    
    
    /**
    * Set a boolean indicating wether wildcards characters must be automatically appended
    * at the start and the end of 'string' and 'text' fields
    *
    * @var $auto_append_wildcard_characters boolean
    * @return void
    */
    public function set_auto_append_wildcard_characters($auto_append_wildcard_characters)
    {
    	$this->auto_append_wildcard_characters = $auto_append_wildcard_characters;
    }
    
    /**
    * Get a boolean indicating wether any filter stored in session must be automatically cleared
    * when the page is requested with a GET request and the request in not a sort
    *
    * @return boolean
    */
    public function get_auto_clear_filter()
    {
        return $this->auto_clear_filter;
    }
    
    /**
    * Set a boolean indicating wether any filter stored in session must be automatically cleared
    * when the page is requested with a GET request and the request in not a sort
    *
    * @var $auto_clear_filter boolean
    * @return void
    */
    public function set_auto_clear_filter($auto_clear_filter)
    {
        $this->auto_clear_filter = $auto_clear_filter;
    }
    
    /****************************************************************************************/
    
    function add_field_alias($alias, $db_fields, $field_type = 'string')
    {
    	$this->alias_fields[$alias]['db_field'] = $db_fields;
    	$this->alias_fields[$alias]['type']     = $field_type;
    }
    
    
    /**
     * Return a conditions array to pass for instance to the paginate method of the calling controller
     *
     * @access public
     */
	function get_filter()
	{
        $this->_prepareFilter();
        
        $filter = array();
        if(isset($this->controller->data) && count($this->controller->data) > 0)
        {
            //Loop for models
            foreach($this->controller->data as $model_name => $field_values)
            {
                if($model_name == self :: MODEL_TECHNICAL || $model_name == '_Token')
                {
                    continue;
                }
                
            	$start_end_pairs = array();
             	
				foreach($field_values as $field_name => $value)
				{
					/*
					 * If the linked Model is not loaded yet, tries to load it
					 */
					if(!isset($this->controller->{$model_name}))
					{
						$this->controller->loadModel($model_name);
					}
					
					if(isset($this->controller->{$model_name}) || array_key_exists($field_name, $this->alias_fields))
					{
						$build_from_to = false;
						$field_wo_prefix = null;
						
						if($this->startsWith($field_name, self :: START_PREFIX))
						{
							$field_wo_prefix = substr($field_name, strlen(self :: START_PREFIX));
							if(!array_key_exists($field_wo_prefix, $start_end_pairs))
							{
								$start_end_pairs[$field_wo_prefix] = array();
							}
							
							$start_end_pairs[$field_wo_prefix]['start'] = $value;
							
							if(isset($start_end_pairs[$field_wo_prefix]['end']))
							{
								$build_from_to = true;
							}
						}
						elseif($this->startsWith($field_name, self :: END_PREFIX))
						{
							$field_wo_prefix = substr($field_name, strlen(self :: END_PREFIX));
							if(!array_key_exists($field_wo_prefix, $start_end_pairs))
							{
								$start_end_pairs[$field_wo_prefix] = array();
							}
							
							$start_end_pairs[$field_wo_prefix]['end'] = $value;
							
							if(isset($start_end_pairs[$field_wo_prefix]['start']))
							{
								$build_from_to = true;
							}
						}
						
						if($build_from_to)
						{
							$filter = $this->build_from_to_filter($filter, $model_name, $field_wo_prefix, $start_end_pairs);
						}
						else if(strlen($value) > 0 && !$this->startsWith($field_name, self :: START_PREFIX) && !$this->startsWith($field_name, self :: END_PREFIX))
						{
							$filter = $this->build_one_value_filter($filter, $model_name, $field_name, $value);
						}
					}
				}
            }
        }
        
        return $filter;
    }
   
    private function get_field_type($model_name, $field_name)
    {
    	$type = null;
    	
    	if(array_key_exists($field_name, $this->alias_fields))
		{
			/*
			 * Find type in the alias_fields array
			 */
			$type = $this->alias_fields[$field_name]['type'];
		}
    	elseif(array_key_exists($field_name, $this->controller->{$model_name}->virtualFields))
		{
		    /*
		     * If the alias exists in the virtualFields, default is to treat it as a string
		     * If the virtual field should be treated differently, use the 'alias_fields' as it allow to indicate a field type.
		     */
		    $type = 'string';
		}
		else
		{
			/*
			 * Tries to find type based on Model
			 */
			if(isset($this->controller->{$model_name}))
			{
				$columns = $this->controller->{$model_name}->getColumnTypes();
				if(isset($columns[$field_name]))
				{
				    $type = $columns[$field_name];
				}
			}
		}
		
		return $type;
    }
    
    private function get_field_search_format($type)
    {
    	if(isset($this->fieldFormatting[$type]))
    	{
    		return $this->fieldFormatting[$type];
    	}
    	else
    	{
    		return ' %s ';
    	}
    }
    
    private function get_real_db_name($model_name, $field_name)
    {
    	if(array_key_exists($field_name, $this->alias_fields))
		{
			return $this->alias_fields[$field_name]['db_field'];
		}
		elseif(array_key_exists($field_name, $this->controller->{$model_name}->virtualFields))
		{
		    return $this->controller->{$model_name}->virtualFields[$field_name];
		}
		else
		{
			return $model_name . '.' . $field_name;
		}
    }
    
    private function build_one_value_filter($filter, $model_name, $field_name, $value)
    {
    	$type 		  = $this->get_field_type($model_name, $field_name);
    	$format 	  = $this->get_field_search_format($type);
    	$real_db_name = $this->get_real_db_name($model_name, $field_name);
    	
    	if($type == 'date' || $type == 'datetime')
    	{
    		$value = $this->get_sql_date($value);
    	}
    	
    	$dbo = $this->controller->{$model_name}->getDataSource();
    	switch($dbo->config['driver'])
    	{
    	    case 'postgres':
    	        $like_operator = 'ILIKE'; // -> case insensitive LIKE
    	        break;
    	        
    	    default:
    	        $like_operator = 'LIKE';
    	        break;
    	}
    	
    	if(isset($value))
    	{
	    	$db_field = null;
	    	switch ($type)
	    	{
	    		case 'string':
	    		case 'text':
	    			$db_field = $real_db_name . ' ' . $like_operator . ' ';
	    		break;
	    		
	    		default:
	    			$db_field = $real_db_name;
	    		break;
	    	}
	    	
	    	if($type != 'boolean')
	    	{
	    	    $filter[$db_field] = sprintf($format, $value);
	    	}
	    	else
	    	{
	    	    if($value == '0' || $value == 'false' || $value === 0 || $value === false
	    	        || $value == __d('alaxos', 'false', true) || $value == __d('alaxos', 'no', true))
	    	    {
	    	        $filter[$db_field] = false;
	    	    }
	    	    elseif($value == '1' || $value == 'true' || $value === 1 || $value === true
	    	        || $value == __d('alaxos', 'true', true) || $value == __d('alaxos', 'yes', true))
	    	    {
	    	        $filter[$db_field] = true;
	    	    }
	    	    else
	    	    {
	    	        /*
	    	         * If the boolean value is not one of the values above,
	    	         * we clear it to hide it in the view
	    	         */
	    	        unset($this->controller->data[$model_name][$field_name]);
	    	    }
	    	}
	    	
	    	if($this->auto_append_wildcard_characters &&
	    	        ($type == 'text' || $type == 'string'))
	        {
	            $filter[$db_field] = StringTool :: ensure_start_with($filter[$db_field], '%');
	            $filter[$db_field] = StringTool :: ensure_end_with($filter[$db_field], '%');
	        }
	    	
	    	return $filter;
    	}
    	else
    	{
    		return null;
    	}
    }
    
    private function build_from_to_filter($filter, $model_name, $field_name, $start_end_pairs)
    {
    	$operator = '';
    	if(isset($start_end_pairs[$field_name]['start']) && strlen($start_end_pairs[$field_name]['start']) > 0
    		&& isset($start_end_pairs[$field_name]['end']) && strlen($start_end_pairs[$field_name]['end']) > 0)
    	{
    		$operator = ' BETWEEN ? AND ? ';
    		$value = array($start_end_pairs[$field_name]['start'], $start_end_pairs[$field_name]['end']);
    	}
    	elseif(isset($start_end_pairs[$field_name]['start']) && strlen($start_end_pairs[$field_name]['start']) > 0)
    	{
    		$operator = '';	//default is =
    		$value = $start_end_pairs[$field_name]['start'];
    	}
    	elseif(isset($start_end_pairs[$field_name]['end']) && strlen($start_end_pairs[$field_name]['end']) > 0)
    	{
    		$operator = ' <= ';
    		$value = $start_end_pairs[$field_name]['end'];
    	}
    	
    	if(isset($value))
    	{
    		$type = $this->get_field_type($model_name, $field_name);
	    	$format = $this->get_field_search_format($type);
	    	$real_db_name = $this->get_real_db_name($model_name, $field_name);

	    	if(is_array($value))
	    	{
		    	if($type == 'date' || $type == 'datetime')
		    	{
		    		$value[0] = $this->get_sql_date($value[0]);
		    		$value[1] = $this->get_sql_date($value[1]);
		    	}
	    		
		    	if(isset($value[0]) && isset($value[1]))
		    	{
	    			$filter[$real_db_name . ' ' . $operator] = $value;
		    	}
	    	}
	    	else
	    	{
		    	if($type == 'date' || $type == 'datetime')
		    	{
		    		$value = $this->get_sql_date($value);
		    	}
    	
		    	if(isset($value))
		    	{
	    			$filter[$real_db_name . ' ' . $operator] = sprintf($format, $value);
		    	}
	    	}
    	}
    	
    	return $filter;
    }
    
    private function get_sql_date($date_value)
    {
    	return DateTool :: date_to_sql($date_value);
    }
    
    /**
     * function that take care of storing the filter data in Session and loading it back
     */
    function _prepareFilter()
    {
        if(isset($this->controller->data) && count($this->controller->data) > 0)
        {
            foreach($this->controller->data as $model => $fields)
            {
                foreach($fields as $key => $field)
                {
                    if(!$this->startsWith($key, self :: START_PREFIX) && !$this->startsWith($key, self :: END_PREFIX) && $field == '')
                    {
                        unset($this->controller->data[$model][$key]);
                    }
                }
            }
            
            $this->controller->Session->write($this->controller->name . '.' . $this->controller->params['action'], $this->controller->data);
        }
        elseif(isset($this->controller->params['named']['filter']))
        {
            /*
             * Preset filter parameters by setting them in the URL
             *
             * - Different filters may be set in the URL parameter separated by "|" or a ampersand double encoded "%252526"
             * - A wildcard character can be set by adding a "*" or a percent double encoded "%252525"
             *
             * Note: (the double encodings are necessary because of the Apache mod_rewrite)
             *
             * Valid examples:
             *
             * Log.log_category_id=7|Log.message3=192.168.1.2* (the URL can be sent unchanged)
             * Log.log_category_id=7&Log.message3=192.168.1.2% (the double encoded URL would look like this: "filter:Log.log_category_id=6%252526message3=9.194.8.73%252525")
             */
            
            if(substr_count($this->controller->params['named']['filter'], '|') > 0)
            {
                $filters = explode('|', $this->controller->params['named']['filter']);
            }
            else
            {
                $filters = explode('&', $this->controller->params['named']['filter']);
            }
            
            if(count($filters) > 0)
            {
                $data = array();
                
                foreach($filters as $filter)
                {
                    $filter_infos = explode('=', $filter);
                    if(count($filter_infos) == 2)
                    {
                        $field = trim($filter_infos[0]);
                        $value = $filter_infos[1];
                        
                        $value = str_replace('*', '%', $value);
                        
                        $model_class = $this->controller->modelClass;
                        if(substr_count($field, '.') == 1)
                        {
                            $model_class = substr($field, 0, strpos($field, '.'));
                            $field       = substr($field, strpos($field, '.') + 1);
                        }
                        
                        if(!array_key_exists($model_class, $data))
                        {
                            $data[$model_class] = array();
                        }
                        
                        $data[$model_class][$field] = $value;
                    }
                }
                
                $this->controller->data = $data;
                $this->controller->Session->write($this->controller->name . '.' . $this->controller->params['action'], $this->controller->data);
            }
        }
        else
        {
            if($this->must_clear_filter())
            {
                $this->controller->Session->delete($this->controller->name . '.' . $this->controller->params['action']);
                $this->controller->data = null;
            }
            else
            {
            	$filter = $this->controller->Session->read($this->controller->name . '.' . $this->controller->params['action']);
            	
            	/*
            	 * Clean the technical model infos if any
            	 * -> allow to reset the technical infos when coming back on the page
            	 * -> allow for instance to start the page with a hidden search area, even when we come back on the page
            	 *
            	 * Note:
            	 * 		but we do not delete the TEch infos if there are some active filters
            	 * 		-> 	allow the search fields to be shown when we come back on the page, to show the active filters without
            	 * 			needing to open the search fields, which would not be clear for the user
            	 */
                if(isset($filter[self :: MODEL_TECHNICAL]) && !$this->has_filter())
                {
                    unset($filter[self :: MODEL_TECHNICAL]);
                    $this->controller->Session->write($this->controller->name . '.' . $this->controller->params['action'], $filter);
                }
                    
            	$this->controller->data = $filter;
            }
        }
    }
    
    /**
     * Check if any filter stored in Session must be cleared.
     *
     * It return true when:
     *
     * 	- $this->auto_clear_filter is set to true
     * 	- HTTP referer doesn't belong to any CRUD action of the same Model and same prefix
     *
     * 		ex:	current page = admin_index
	 *			referer      = admin_edit
	 *			-> don't clean the filters)
     */
    private function must_clear_filter()
    {
        if($this->auto_clear_filter == false)
        {
            return false;
        }
        else
        {
            if(isset($_SERVER['HTTP_REFERER']))
            {
                $plugin     = $this->controller->params['plugin'];
                $controller = $this->controller->params['controller'];
                $prefix     = !empty($this->controller->params['prefix']) ? $this->controller->params['prefix'] . '_' : null;
                
                $index_action          = Router :: url(array('plugin' => $plugin, 'controller' => $controller, 'action' => $prefix . 'index'), true);
                $explicit_index_action = $index_action . '/index';
                $view_action           = Router :: url(array('plugin' => $plugin, 'controller' => $controller, 'action' => $prefix . 'view'), true);
                $add_action            = Router :: url(array('plugin' => $plugin, 'controller' => $controller, 'action' => $prefix . 'add'), true);
                $edit_action           = Router :: url(array('plugin' => $plugin, 'controller' => $controller, 'action' => $prefix . 'edit'), true);
                $delete_action         = Router :: url(array('plugin' => $plugin, 'controller' => $controller, 'action' => $prefix . 'delete'), true);
                
                if(
                    in_array($_SERVER['HTTP_REFERER'], array($index_action, $explicit_index_action, $view_action, $add_action, $edit_action, $delete_action))
                    || StringTool :: start_with($_SERVER['HTTP_REFERER'], StringTool :: ensure_end_with($index_action, '/'))
                    || StringTool :: start_with($_SERVER['HTTP_REFERER'], StringTool :: ensure_end_with($explicit_index_action, '/'))
                    || StringTool :: start_with($_SERVER['HTTP_REFERER'], StringTool :: ensure_end_with($view_action, '/'))
                    || StringTool :: start_with($_SERVER['HTTP_REFERER'], StringTool :: ensure_end_with($add_action, '/'))
                    || StringTool :: start_with($_SERVER['HTTP_REFERER'], StringTool :: ensure_end_with($edit_action, '/'))
                    || StringTool :: start_with($_SERVER['HTTP_REFERER'], StringTool :: ensure_end_with($delete_action, '/'))
                )
                {
                    return false;
                }
            }
            
            return true;
        }
    }
    
    private function has_filter()
    {
        $filter = $this->controller->Session->read($this->controller->name . '.' . $this->controller->params['action']);
        
        if(isset($filter) && is_array($filter))
        {
            foreach($filter as $model_name => $filter_values)
            {
                if($model_name != self :: MODEL_TECHNICAL)
                {
                    foreach($filter_values as $value)
                    {
                        if(!empty($value))
                        {
                            return true;
                        }
                    }
                }
            }
        }
        
        return false;
    }
    
    function startsWith($string, $needle)
    {
    	//return (substr($string, 0, strlen($needle)) == $needle);
    	return StringTool :: start_with($string, $needle);
    }
    
}

?>
