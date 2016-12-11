<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosFormHelper extends FormHelper
{
    const START_PREFIX 	= 'start__';
	const END_PREFIX 	= 'end__';

    /**
     * Other helpers used by AlaxosFormHelper
     *
     * @var array
     * @access public
     */
	var $helpers = array('Html', 'Alaxos.AlaxosHtml');
	
	/******************************************************************************************/
	/* Filters fields */
	
	/**
	 * Create an input field that can be used as a filter at the top of a data table.
	 * Depending on the field type, the generated filter may be composed of two input fields that can be used
	 * to make a from-to search.
	 *
	 * $options:
	 * 			See FormHelper->input() for available options
	 * 			+
	 * 			'start_field' 	=> array of options for the first input field when from-to input boxes are used
	 * 			'end_field'		=> array of options for the second input field when from-to input boxes are used
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	function filter_field($fieldname, $options = array())
	{
	    /*
	     * Set default filter width to 95% of the container
	     * Should be OK in most cases when the filter is included at the top of a table column
	     */
	    $options['style'] = array_key_exists('style', $options) ? $options['style'] : 'width:95%;';
	    
	    /*
	     * Determine the field type in order to know what kind of filter must be shown
	     */
	    $fieldtype = !empty($options['type']) ? $options['type'] : null;
	    
	    if(!isset($fieldtype))
	    {
    	    $fieldtype = $this->get_fieldtype($fieldname);
    	    
    	    if(empty($fieldtype))
    	    {
    	        $fieldtype = 'string';
    	    }
	    }
	    
	    /*
	     * Check if the fieldname is a foreign key
	     * If this is the case, build a select filter instead of a number filter
	     */
	    if (preg_match('/_id$/', $fieldname))
	    {
	        /*
	         * If this is a foreign key, and no options list is given as parameters, look for a corresponding variable in the view containing the linked model elements.
	         * If such a list is found, use it to build a select filter
	         * If such a list is not found, print a standard filter
	         */
	        if(empty($options['options']))
	        {
    	    	/*
    	         * Look for an existing View variable whose name correspond to the fk model to build the select input
    	         *
    	         * e.g.:   fieldname = role_id ---> look for a variable called $roles
    	         */
    	        $view =& ClassRegistry :: getObject('view');
    			$varName = Inflector :: variable(Inflector :: pluralize(preg_replace('/_id$/', '', $fieldname)));
                                    			
    			$varOptions = $view->getVar($varName);
    			if (is_array($varOptions))
    			{
    			    /*
    			     * A corresponding variable was found -> use it to fill the select list
    			     */
    			    $options['options'] = $varOptions;
    			    $fieldtype = 'select';
    			}
	        }
	        elseif(is_array($options['options']))
	        {
	            $fieldtype = 'select';
	        }
	    }
			
	    switch($fieldtype)
	    {
	        case 'select':
	            return $this->filter_select($fieldname, $options);
	            break;
	            
	        case 'number':
	        case 'integer':
	        case 'numeric':
	        case 'long':
	        case 'float':
	        case 'int':
	            return $this->filter_number($fieldname, $options);
	            break;
	        
	        case 'date':
	        case 'datetime':
	            return $this->filter_date($fieldname, $options);
	            break;
	            
	        case 'boolean':
	            return $this->filter_boolean($fieldname, $options);
	            break;
	        
	        case 'varchar':
	        case 'text':
	        case 'string':
	        default:
	            return $this->filter_text($fieldname, $options);
	            break;
	    }
	}

	/**
	 * Create a filter made of two input fields that allow to only enter numbers.
	 * These fields can be used as a from-to search filter.
	 *
	 * $options:
	 * 			See FormHelper->text() for available options
	 * 			+
	 * 			'start_field' 	=> array of options for the first input field
	 * 			'end_field'		=> array of options for the second input field
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	function filter_number($fieldname, $options = array())
	{
	    $start_field_options = array_key_exists('start_field', $options) ? $options['start_field'] : array();
	    $end_field_options   = array_key_exists('end_field',   $options) ? $options['end_field']   : array();
	    
	    if(!array_key_exists('style',   $start_field_options))
	    {
	        $start_field_options['style'] = 'width:100%';
	    }
	    
	    if(!array_key_exists('style',   $end_field_options))
	    {
	        $end_field_options['style'] = 'width:100%';
	    }
	    
	    $start_fieldname = $this->get_start_fieldname($fieldname);
	    $end_fieldname   = $this->get_end_fieldname($fieldname);
	    
	    $cells   = array();
        $cells[] = $this->input_number($start_fieldname, $start_field_options);
        $cells[] = $this->input_number($end_fieldname, $end_field_options);
		
		return $this->AlaxosHtml->formatTable($cells, 1, null, array('style' => 'width:100%;'));
	}

	/**
	 * Create a filter made of two input fields linked to a datepicker.
	 * These fields can be used as a from-to search filter.
	 *
	 * $options:
	 * 			See FormHelper->text() for available options
	 * 			+
	 * 			'start_field' 	=> array of options for the first input field
	 * 			'end_field'		=> array of options for the second input field
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	function filter_date($fieldname, $options = array())
	{
	    $start_field_options = array_key_exists('start_field', $options) ? $options['start_field'] : array();
	    $end_field_options   = array_key_exists('end_field',   $options) ? $options['end_field']   : array();
	    
	    $start_fieldname = $this->get_start_fieldname($fieldname);
	    $end_fieldname   = $this->get_end_fieldname($fieldname);
	    
	    $cells   = array();
        $cells[] = $this->input_date($start_fieldname, $start_field_options);
        $cells[] = $this->input_date($end_fieldname, $end_field_options);
		
		return $this->AlaxosHtml->formatTable($cells, 1, array('style' => 'white-space:nowrap;'));
	}
	
	/**
	 * Create a text field that can be used as a filter.
	 * The method is only a wrapper for the text() method.
	 *
	 * $options:
	 * 			See FormHelper->text() for available options
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	function filter_text($fieldname, $options = array())
	{
	    return $this->text($fieldname, $options);
	}
	
	/**
	 * Create a dropdown list containing 'yes' and 'no' values that can be used as a filter.
	 * List options may be overriden in the $options array.
	 *
	 * $options:
	 * 			See FormHelper->select() for available options
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	function filter_boolean($fieldname, $attributes = array())
	{
	    if(empty($attributes['options']))
	    {
	        $attributes['options'] = array('1' => __d('alaxos', 'yes', true), '0' => __d('alaxos', 'no', true));
	    }
	    
	    return $this->filter_select($fieldname, $attributes);
	}
	
	/**
	 * Create a dropdown list that can be used as a filter.
	 * If not explicitly given, list options may be automatically found according to the fieldname value.
	 *
	 * $options:
	 * 			See FormHelper->select() for available options
	 * 			or  FormHelper->radio() if $options['type'] is 'radio'
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	function filter_select($fieldname, $attributes = array())
	{
	    if(empty($attributes['options']))
	    {
	        /*
	         * Look for an existing View variable whose name correspond to the fk model to build the select input
	         *
	         * e.g.:   fieldname = role_id ---> look for a variable called $roles
	         */
	        $view =& ClassRegistry :: getObject('view');
			$varName = Inflector :: variable(Inflector :: pluralize(preg_replace('/_id$/', '', $fieldname)));
                                			
			$varOptions = $view->getVar($varName);
			if (is_array($varOptions))
			{
			    /*
			     * A corresponding variable was found -> use it to fill the select list
			     */
			    $options = $varOptions;
			}
	    }
	    else
	    {
	        $options = $attributes['options'];
	    }
	    
	    $selected            = !empty($attributes['selected']) ? $attributes['selected'] : null;
	    $attributes['empty'] = !empty($attributes['empty'])    ? $attributes['empty']    : true;
	    
	    if (isset($attributes['type']) && $attributes['type'] === 'radio')
		{
			return $this->radio($fieldname, $options, $attributes);
		}
		else
		{
		    return $this->select($fieldname, $options, $selected, $attributes);
		}
	}
	
	/**
	 * Override of FormHelper::create() to get rid of any eventual filter passed in URL parameters
	 * in order to reset it when a new search is done by submitting the form
	 *
	 * @see FormHelper::create()
	 */
	function create($model = null, $options = array())
	{
	    if(array_key_exists('url', $options) && array_key_exists('filter', $options['url']))
	    {
	        unset($options['url']['filter']);
	    }
	    
	    return parent::create($model, $options);
	}
	
	/******************************************************************************************/
	/* Simple fields */
	
	/**
	 * Override of FormHelper::input() to be able to call automatically input_date() or input_number()
	 * when the field is of the corresponfing type
	 *
	 * @see cake/libs/view/helpers/FormHelper::input()
	 */
	public function input($fieldname, $options = array())
	{
	    $this->setEntity($fieldname);
	    
		/*
	     * Determine the field type in order to know if a special input must be shown
	     */
	    $fieldtype = !empty($options['type']) ? $options['type'] : null;
	    
	    if(!isset($fieldtype))
	    {
    	    $fieldtype = $this->get_fieldtype($fieldname);
    	    
    	    if(empty($fieldtype))
    	    {
    	        $fieldtype = 'string';
    	    }
	    }
	    
	    if($fieldtype == 'number' || $fieldtype == 'numeric' || $fieldtype == 'float' || $fieldtype == 'long')
	    {
	        $options['integer'] = false;
	    }
	    
	    if (preg_match('/_id$/', $fieldname) || (array_key_exists($this->model(), $this->fieldset) && $fieldname == $this->fieldset[$this->model()]['key']))
	    {
	    	/*
	    	 * In case of foreign key, use the standard parent :: input() function
	    	 * as it will print a select box
	    	 *
	    	 * In case of primaryKey, use the standard parent :: input() function
	    	 * as it will print a hidden field
	    	 */
	    	$fieldtype = 'default';
	    }
	    
	    switch($fieldtype)
	    {
	        case 'date':
	        case 'datetime':
	            return $this->_get_label($fieldname, $options) . $this->input_date($fieldname, $options);
	            break;
	        
	        case 'number':
	        case 'integer':
	        case 'numeric':
	        case 'long':
	        case 'float':
	        case 'int':
	            return $this->_get_label($fieldname, $options) . $this->input_number($fieldname, $options);
	            break;
	            
	        default:
	            return parent :: input($fieldname, $options);
	            break;
	    }
	}
	
	/**
	 * Return a text field that allow to enter only numbers.
	 * Depending on the numeric type, the field may only allow to enter an integer.
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	public function input_number($fieldname, $options = array())
	{
	    $this->AlaxosHtml->include_js_alaxos();
	    
	    $numeric_class = !array_key_exists('integer', $options) || $options['integer'] == true ? 'inputInteger' : 'inputFloat';
	    
	    if(!array_key_exists('class', $options))
		{
		    $options = array_merge($options, array('class' => $numeric_class));
		}
		else
		{
		    $class = $options['class'];
		    unset($options['class']);
		    $options = array_merge($options, array('class' => $numeric_class . ' ' . $class));
		}
		
		$input_field = $this->text($fieldname, $options);
		$input_field .= $this->_get_validation_error_zone($this->_get_validation_error($fieldname));
		
		return $input_field;
	}
	
	/**
	 * Return a text field linked to a datepicker (see frequency-decoder.com)
	 * The date format is set according to the current locale that may have been set with the DateTool :: set_current_locale() method.
	 *
	 * When the date is entered manually in the textbox, the date is automatically completed when the textbox loose focus
	 * ex: 	'10.08'	=> automatically completed to '10.08.2010'
	 * 		'10'	=> automatically completed to '10.08.2010'
	 *
	 * @param string $fieldname
	 * @param array $options
	 */
	public function input_date($fieldname, $options = array())
	{
	    $this->AlaxosHtml->include_js_datepicker();
	    $this->AlaxosHtml->include_js_jquery();
	    $this->AlaxosHtml->include_js_jquery_no_conflict();
	    $this->AlaxosHtml->include_js_alaxos();
	    
	    /*
	     * include CSS needed to show the datepicker
	     */
	    $this->AlaxosHtml->css('/alaxos/css/datepicker', null, array('inline' => false));
	    
	    /*
	     * Set the class attribute needed to display the datepicker
	     * The class has to be retrieved from a PHP function, because it depends on the current locale
	     */
	    if(!array_key_exists('class', $options))
		{
			$options = array_merge($options, array('class' => $this->get_datepicker_css_class()));
		}
		
		if(!array_key_exists('value', $options))
		{
		    $options = $this->value($options, $fieldname);
		    $options['value'] = DateTool :: sql_to_date($options['value']);
		}
		
	    if(!array_key_exists('maxlength', $options))
		{
		    $options['maxlength'] = '10';
		}
		
		$input_field = $this->text($fieldname, $options);
		$input_field .= $this->_get_validation_error_zone($this->_get_validation_error($fieldname));
		
		return $input_field;
	}
	
	/**
	 * Wrapper method for the FormHelper->select() method called automatically with 'yes' and 'no' options
	 *
	 * @param string $fieldname
	 * @param array $options
	 * @param mixed $selected
	 * @param array $attributes
	 */
	public function input_yes_no($fieldname, $options = array(), $selected = null, $attributes = array())
	{
	    if(empty($options))
	    {
	        $options = array('1' => __d('alaxos', 'yes', true), '0' => __d('alaxos', 'no', true));
	    }
	    
	    return $this->select($fieldname, $options, $selected, $attributes);
	}
	
	/**
	 * Wrapper method for the FormHelper->select() method called automatically with 'true' and 'false' options
	 *
	 * @param string $fieldname
	 * @param array $options
	 * @param mixed $selected
	 * @param array $attributes
	 */
	public function input_true_false($fieldname, $options = array(), $selected = null, $attributes = array())
	{
	    if(empty($options))
	    {
	        $options = array('1' => __d('alaxos', 'true', true), '0' => __d('alaxos', 'false', true));
	    }
	    
	    return $this->select($fieldname, $options, $selected, $attributes);
	}
	
	/******************************************************************************************/
	/* Special fields */
	
	/**
	 * Return a dropdown list filled with actions that can be performed on the selected elements of a datat list
	 * It also automatically set the needed translated Javascript vaiables.
	 *
	 * @param string $fieldName
	 * @param array $options
	 */
	public function input_actions_list($fieldName = '_Tech.action', $options = array())
	{
	    $options['id'] = !empty($options['id'])      ? $options['id']      : 'ActionToPerform';
	    $actions       = !empty($options['actions']) ? $options['actions'] : array('deleteAll' => ___d('alaxos', 'delete all', true));
	    
	    /*
	     * Include translated texts for JS confirm box
	     */
	    $script  = 'var confirmDeleteAllText =            "' . ___d('alaxos', 'are you sure you want to delete all those items ?', true) . '";' . "\n";
	    $script .= 'var pleaseChooseActionToPerformText = "' . ___d('alaxos', 'please choose the action to perform', true) . '";' . "\n";
	    
	    $this->AlaxosHtml->scriptBlock($script, array('inline' => false));
	    
	    unset($options['actions']);
	    
	    return $this->select($fieldName, $actions, null, $options);
	}
	
	/******************************************************************************************/
	
	/**
	 * Return the CSS class name needed by the frequency-decoder.com datepicker used to recognize the date format.
	 * The date format is determined by the current locale (that can be set by the DateTool :: set_current_locale()).
	 *
	 * @param $class_name
	 */
	function get_datepicker_css_class($class_name = 'inputDate')
    {
    	$locale = DateTool :: get_current_locale();
    	
    	$locale = strtolower($locale);
    	
    	switch($locale)
    	{
    		case 'fr_ch':
    		case 'fr_ch.utf-8':
    		case 'fr_fr':
    			return $class_name . ' format-d-m-y divider-dot';
    		
    		case 'en_en':
			case 'en_us':
			case 'en_en.utf-8':
			case 'en_us.utf-8':
				return $class_name . ' format-y-m-d divider-dash';
				
    		default:
    			return 'H:i:s';
    	}
    }
    
    /**
     * Return the type of a field
     *
     * @param string $fieldname
     */
    function get_fieldtype($fieldname)
    {
        $fieldtype = null;
        
        if(isset($this->fieldset['fields']) && array_key_exists($fieldname, $this->fieldset['fields']))
	    {
            $fieldtype = $this->fieldset['fields'][$fieldname]['type'];
	    }
	    elseif(stripos($fieldname, '.') === false && isset($this->params['models']) && isset($this->fieldset) && count($this->fieldset) > 0)
	    {
	        foreach($this->params['models'] as $model_name)
	        {
	            if(array_key_exists($model_name, $this->fieldset)
	                && array_key_exists('fields', $this->fieldset[$model_name])
	                && array_key_exists($fieldname, $this->fieldset[$model_name]['fields'])
	              )
	            {
                    $fieldtype = $this->fieldset[$model_name]['fields'][$fieldname]['type'];
                    break;
	            }
	        }
	    }
	    elseif(stripos($fieldname, '.') !== false)
	    {
	        $model_name = substr($fieldname, 0, strpos($fieldname, '.'));
	        $fieldname = substr($fieldname, strpos($fieldname, '.') + 1);
	        
	        if(array_key_exists($model_name, $this->fieldset)
	                && array_key_exists('fields', $this->fieldset[$model_name])
	                && array_key_exists($fieldname, $this->fieldset[$model_name]['fields'])
	          )
            {
                $fieldtype = $this->fieldset[$model_name]['fields'][$fieldname]['type'];
            }
	    }
	    
	    return $fieldtype;
    }
    
    /**
     * Return the fieldname to use for the first field a from-to search filter
     *
     * @param string $fieldname
     */
    function get_start_fieldname($fieldname)
    {
        if(stripos($fieldname, '.') !== false)
	    {
	        $model_name = substr($fieldname, 0, strpos($fieldname, '.'));
	        $field_name = substr($fieldname, strpos($fieldname, '.') + 1);
	        
	        $start_fieldname = $model_name . '.' . AlaxosFormHelper :: START_PREFIX . $field_name;
	    }
	    else
	    {
	        $start_fieldname = AlaxosFormHelper :: START_PREFIX . $fieldname;
	    }
	    
	    return $start_fieldname;
    }
    
    /**
     * Return the fieldname to use for the second field a from-to search filter
     *
     * @param string $fieldname
     */
    function get_end_fieldname($fieldname)
    {
        if(stripos($fieldname, '.') !== false)
	    {
	        $model_name = substr($fieldname, 0, strpos($fieldname, '.'));
	        $field_name = substr($fieldname, strpos($fieldname, '.') + 1);
	        
    	    $end_fieldname   = $model_name . '.' . AlaxosFormHelper :: END_PREFIX   . $field_name;
	    }
	    else
	    {
    	    $end_fieldname   = AlaxosFormHelper :: END_PREFIX   . $fieldname;
	    }
	    
	    return $end_fieldname;
    }
    
    /**
     * Return an eventual error message for a field
     *
     * @param string $fieldname
     */
    function _get_validation_error($fieldname)
    {
        $view =& ClassRegistry :: getObject('view');
    	$validationErrors = $view->validationErrors;
    		
        if(stripos($fieldname, '.') !== false)
	    {
	        $model_name = substr($fieldname, 0, strpos($fieldname, '.'));
	        $fieldname = substr($fieldname, strpos($fieldname, '.') + 1);
	    }
	    else
	    {
    		$model_name = $view->model;
	    }
	    
		if(isset($validationErrors[$model_name][$fieldname]))
		{
		    return $validationErrors[$model_name][$fieldname];
		}
		else
		{
		    return null;
		}
    }
    
    /**
     * Return a div containing an error if the given one is not empty
     *
     * @param string $error
     */
    function _get_validation_error_zone($error)
    {
        if(!empty($error))
        {
            $error_zone = '<div class="error-message">';
    	    $error_zone .= $error;
    	    $error_zone .= '</div>';
    	    return $error_zone;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Get the label for the given fieldname
     *
     * @param $fieldname
     * @param $options
     */
    function _get_label($fieldname, $options)
    {
        $label = null;
		if(!isset($options['label']) || $options['label'] !== false)
		{
		    $options['type'] = 'text';
		    
		    if(!isset($options['label']))
		    {
		        $label = $this->_inputLabel($fieldname, null, $options);
		    }
		    else
		    {
		        $label = $this->_inputLabel($fieldname, $options['label'], $options);
		    }
		}
		unset($options['label']);
		
		return $label;
    }
}
?>