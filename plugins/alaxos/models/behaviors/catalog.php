<?php
/**
 * This behaviour add a get_catalog() function to a Model.
 *
 * Settings:
 *
 * 	- displayField	:	Custom display field name. See $displayField in Model
 * 	- sortField		:	Field used to sort (ascending sort) the catalog records
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class CatalogBehavior extends ModelBehavior
{
    function setup(&$model, $settings)
    {
        if(isset($settings['displayField']))
        {
            $this->settings[$model->alias]['displayField'] = $settings['displayField'];
        }
        
        if(isset($settings['sortField']))
        {
            $this->settings[$model->alias]['sortField'] = $settings['sortField'];
        }
        
        if(isset($settings['visibleField']))
        {
            $this->settings[$model->alias]['visibleField'] = $settings['visibleField'];
        }
        
        $this->settings[$model->alias]['default_cache_duration'] = isset($settings['default_cache_duration']) ? $settings['default_cache_duration'] : '1 hour';
    }
    
    
    /**
     * This function returns a complete list of the model records, sorted by the 'order' or 'sort' field
     * It is formatted to be displayed in lists such as comboboxes or radios buttons.
     *
     * The field used for the display is the $displayField of the Model
     *
     * It supports the Translate Behavior, with a fallback to a default language if Configure :: write('languages.default', 'your lang') exists
     *
     * It also support the Alaxos.Cache behaviour that can be used to cache the catalog queries results.
     * To use the Alaxos.Cache behaviour, pass a key 'cache' in the $options parameter such as:
     *
     * 																					- 'cache' => array('keyname', '1 day')
     * 																					or
     * 																					- 'cache' => array('key' => 'keyname', 'duration' => '1 day')
     *
     * @param $model Model
     * @param $options Array - array('cache' => true) or array('cache' => array('', ''))
     */
    function get_catalog(&$model, $options = array())
    {
    	/*
	     * Display field
	     */
	    $displayField = $this->get_display_field($model);
	    
	    /*
	     * Sort field
	     */
	    $sortField = $this->get_sort_field($model);
	    
	    /*
	     * Check if Model has a field that indicates wether an element must be displayed in lists
	     */
	    $visibleField = $this->get_visible_field($model);
	    
	    /*
	     * Cache options
	     */
	    $cache_options = $this->get_cache_options($model, $options);
	    
	    /*
	     * Check if the field to display in the catalog is translated by the Translate behaviour
	     * If this is the case, the building of the list has to be made differently
	     */
	    $displayField_is_translated = $this->is_displayField_translated($model);
	    if($displayField_is_translated)
	    {
	        if(array_key_exists($displayField, $model->actsAs['Translate']))
	        {
	            $translated_field = $model->actsAs['Translate'][$displayField];
	        }
	    }
	    
	    /*
	     * Keep the current recursive value to reset it after the find() query
	     */
	    $current_recursive = $model->recursive;
	    
	    $list = array();
	    
	    if($displayField_is_translated)
	    {
	        /*
	         * Display field is translated
	         */
	        
	        /*
             * For translated fields, recursive must be set to 1 to get the translations
             * (But we reset it after to the current level)
             */
    	    $model->recursive = 1;
    	    
    	    /*
    	     * Temporarly remove all unnecessary linked models in order to limit the number of returned data
    	     * despite the recursive mode set to 1
    	     */
    	    $associations = $model->getAssociated();
    	    $models_to_unbind = array();
    	    foreach($associations as $linked_model_name => $association_type)
    	    {
    	        if($linked_model_name != $translated_field)
    	        {
    	            $models_to_unbind[$association_type][] = $linked_model_name;
    	        }
    	    }
    	    $model->unbindModel($models_to_unbind);
    	    
    	    /*
    	     * eventual visible condition
    	     */
    	    $conditions = null;
	    	if(!empty($visibleField))
	    	{
	    	    $conditions = array($visibleField => true);
	    	}
    	    
    	    /*
    	     * retrieve catalog
    	     */
    	    
    	    $find_options = array('fields' => array('id', $displayField), 'conditions' => $conditions, 'order' => array($sortField => 'asc'));
    	    
    	    if(isset($cache_options))
    	    {
    	        $cache_options['key'] .= '_' . $model->locale;
    	        
    	        $find_options = $find_options + array('cache' => $cache_options);
    	        
    	        $list_i18n = $model->cache_find('all', $find_options);
    	    }
    	    else
    	    {
    	        $list_i18n = $model->find('all', $find_options);
    	    }
    	    
    	    foreach($list_i18n as $record)
    	    {
    	        if(isset($record[$translated_field]))
    	        {
    	            foreach($record[$translated_field] as $translation)
    	            {
    	                if($translation['locale'] == $model->locale && !empty($translation['content']))
    	                {
    	                    $list[$translation['foreign_key']] = $translation['content'];
    	                    break;
    	                }
    	            }
    	        }
    	        
    	        /*
    	         * No transation was found for the record
    	         */
    	        if(!array_key_exists($record[$model->alias]['id'], $list))
    	        {
    	            /*
    	             * Tries to fall back to an eventual default language set
    	             */
    	            $lang = Configure :: read('languages.default');
    	            $fallback_translation = null;
    	            
    	            if(!empty($lang))
    	            {
    	                $fallback_translation = Set :: extract('/' . $translated_field . '[locale=' . $lang . ']/content', $record);
    	            }
    	            
    	            if(isset($fallback_translation) && is_array($fallback_translation) && count($fallback_translation) > 0)
    	            {
    	                $list[$record[$model->alias]['id']] = $fallback_translation[0];
    	            }
    	            else
    	            {
    	                $list[$record[$model->alias]['id']] = '???';
    	            }
    	        }
    	    }
	    }
	    else
	    {
	        /*
	         * Display field is not translated
	         */
	        
    	    /*
             * For the catalog, recursive can be set to 0 to limit db queries
             * (But we reset it after to the current level)
             */
    	    $model->recursive = 0;
    	    
    	    /*
    	     * eventual visible condition
    	     */
    	    $conditions = null;
	    	if(!empty($visibleField))
	    	{
	    	    $conditions = array($visibleField => true);
	    	}
    	    
    	    /*
    	     * retrieve catalog
    	     */
    	    $find_options = array('fields' => array('id', $displayField), 'conditions' => $conditions, 'order' => array($sortField => 'asc'));
    	    
    	    if(isset($cache_options))
    	    {
    	        $find_options = $find_options + array('cache' => $cache_options);
    	        
    	        $list = $model->cache_find('list', $find_options);
    	    }
    	    else
    	    {
    	        $list = $model->find('list', $find_options);
    	    }
    	    
	    }
	    
	    /*
	     * reset recursive value
	     */
	    $model->recursive = $current_recursive;
    	
	    /*
	     * You can do any transformation you need to the catalog.
	     * Therefore, declare an afterFind_catalog() method that returns the modified catalog in your model class.
	     */
	    if(method_exists($model, 'afterFind_catalog'))
	    {
	        $list = $model->afterFind_catalog($list);
	    }
	    
	    return $list;
    }
    
    function clear_cached_catalog(&$model, $options = array())
    {
        if(!array_key_exists('cache', $options))
        {
            $options['cache'] = true;
        }
        
        $cache_options = $this->get_cache_options($model, $options);
        
        if(!array_key_exists('locales', $options))
        {
            $key = $cache_options['key'] . '_' . $model->locale;
            $result = $model->clear_cached_find($key);
        }
        else
        {
            $result = true;
            foreach($options['locales'] as $locale)
            {
                $key = $cache_options['key'] . '_' . $locale;
                if(!$model->clear_cached_find($key))
                {
                    $result = false;
                }
            }
        }
        
        return $result;
    }
    
    /******************************************************************/
    
    private function get_display_field(&$model)
    {
        $displayField = null;
        
        if(isset($this->settings[$model->alias]['displayField']))
	    {
	        $displayField = $this->settings[$model->alias]['displayField'];
	    }
	    elseif($model->displayField)
	    {
	        $displayField = $model->displayField;
	    }
	    else
	    {
	        $displayField = $model->hasField(array('title', 'name', 'titre', 'nom', $model->primaryKey));
	    }
	    
	    return $displayField;
    }
    
    private function get_sort_field(&$model)
    {
        $sortField = null;
        
        if(isset($this->settings[$model->alias]['sortField']))
	    {
	        $sortField = $this->settings[$model->alias]['sortField'];
	    }
	    else
	    {
	        $sortField = $model->hasField(array('order', 'sort', 'tri', $model->primaryKey));
	    }
	    
	    return $sortField;
    }
    
    private function get_visible_field(&$model)
    {
        $visibleField = null;
        
        if(isset($this->settings[$model->alias]['visibleField']))
	    {
	        $visibleField = $this->settings[$model->alias]['visibleField'];
	    }
	    else
	    {
	        $visibleField = $model->hasField(array('visible', 'isvisible', 'isVisible'));
	    }
	    
	    return $visibleField;
    }
    
    private function get_cache_options(&$model, $options)
    {
        $cache_options = null;
        
        $displayField = $this->get_display_field($model);
        
        if(isset($options['cache']))
	    {
	        if(!$model->Behaviors->attached('Alaxos.Cache'))
	        {
	            $model->Behaviors->attach('Alaxos.Cache');
	        }
	        
	        $cache_options = array();
	        
	        if(is_array($options['cache']))
	        {
	            if(isset($options['cache']['key']))
	            {
	                $cache_options['key'] = $options['cache']['key'];
	            }
	            elseif(isset($options['cache'][0]))
	            {
	                $cache_options['key'] = $options['cache'][0];
	            }
	            else
	            {
	                $cache_options['key'] = 'catalog_' . $displayField;
	            }
	            
	            if(isset($options['cache']['duration']))
	            {
	                $cache_options['duration'] = $options['cache']['duration'];
	            }
	            elseif(isset($options['cache'][1]))
	            {
	                $cache_options['duration'] = $options['cache'][1];
	            }
	            else
	            {
	                $cache_options['duration'] = $this->settings[$model->alias]['default_cache_duration'];
	            }
	        }
	        else
	        {
	            $cache_options['key']      = 'catalog_' . $displayField;
	            $cache_options['duration'] = $this->settings[$model->alias]['default_cache_duration'];
	        }
	    }
	    
	    if(isset($cache_options))
	    {
	        /*
	         * Set model->locale manually to ensure it is set when we need it to create the cache key
	         */
	        if (!isset($model->locale) || is_null($model->locale))
	        {
    			if (!class_exists('I18n'))
    			{
    				App :: import('Core', 'i18n');
    			}
    			
    			$I18n =& I18n :: getInstance();
    			$I18n->l10n->get(Configure :: read('Config.language'));
    			$model->locale = $I18n->l10n->locale;
    		}
	    }
	    
	    return $cache_options;
    }
    
    private function is_displayField_translated(&$model)
    {
        $displayField_is_translated = false;
        
        $displayField = $this->get_display_field($model);
        
        if(isset($model->actsAs['Translate']))
	    {
	        if(array_key_exists($displayField, $model->actsAs['Translate']))
	        {
	            $translated_field = $model->actsAs['Translate'][$displayField];
	            $displayField_is_translated = true;
	        }
	        elseif(in_array($displayField, $model->actsAs['Translate']))
	        {
	            $displayField_is_translated = true;
	        }
	    }
	    
	    return $displayField_is_translated;
    }
}
?>