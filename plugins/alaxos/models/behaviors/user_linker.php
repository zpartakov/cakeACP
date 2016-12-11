<?php
/**
 * Add an automatic update of the fields created_by and modified_by with the current logged user id
 * This will work for the current model and for join tables.
 *
 * The current logged user id may be obtained by passing a method in the UserLinkerBehavior settings
 * specifying a function of the Model that returns the user id
 *
 * Note about the join tables:
 *
 *		This Behaviour brings another functionnality for the join tables:
 *		It manages the 'created' and 'modified' fields of the join table if they exists.
 *		But please note that in order to manage these fields correctly, the join table must have an 'id' field
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class UserLinkerBehavior extends ModelBehavior
{
    /**
     * Contains the temporary relations created by the beforeSave() methods
     * that must be destroyed in afterSave()
     *
     * @var array
     */
    var $temporary_relations = array('hasMany' => array());
    
    /**
     * The name of the Model function to call to get the user id
     * This function is typically implemented in the AppModel class
     *
     * @var string
     */
    var $get_user_id_function = null;
    
    /****************************************************************************************/
    
    function setup(&$model, $settings)
    {
        if(isset($settings['get_user_id_function']))
        {
            $this->get_user_id_function = $settings['get_user_id_function'];
        }
    }
    
    
    function beforeSave(&$model)
	{
	    //debug($model->data);
	    //debug($model);
	    
	    $logged_user_id = null;
	    
	    if(!empty($this->get_user_id_function) && method_exists($model, $this->get_user_id_function))
	    {
	        $logged_user_id = call_user_func(array($model, $this->get_user_id_function));
	        
    	    if(isset($logged_user_id))
    		{
    		    $this->set_user_on_current_model($model, $logged_user_id);
    		}
	    }
	    
	    $this->set_user_on_join_tables($model, $logged_user_id);
		
		return true;
	}
	
	
	function afterSave(&$model, $new_object_created)
	{
	    $this->reset_relations($model);
	}
	
	
	function afterFind(&$model, $results)
	{
	    if(isset($results) && is_array($results))
	    {
    	    foreach ($results as $key => &$result)
    		{
    			foreach ($result as $model_name => &$values)
    			{
    			    /**
    			     * Compare creation and update dates. If they are equal, unset update date.
    			     *
    			     * I don't like this Cake comportment making Cake setting an update date
    			     * for records that have never been updated !...
    			     */
    			    if(isset($values['created']) && isset($values['modified']) && $values['created'] == $values['modified'])
    			    {
    			        $values['modified'] = null;
    			    }
    			    elseif(isset($values['created']) && isset($values['updated']) && $values['created'] == $values['updated'])
    			    {
    			         $values['updated'] = null;
    			    }
    			}
    		}
	    }
		
		return $results;
	}
	

	/****************************************************************************************/
	
	/**
	 * Set the created_by and modified_by user id on the current Model (meaning the Model including the UserLinkerBehavior)
	 *
	 * @param Model $model
	 * @param int $logged_user_id
	 * @return void
	 */
	private function set_user_on_current_model(&$model, $logged_user_id)
	{
	    if(isset($logged_user_id))
	    {
    		/*
    	     * Id is not set -> it is a creation
    	     */
    		if($model->hasField('created_by') && (!isset($model->data[$model->alias]['id']) || strlen($model->data[$model->alias]['id']) == 0))
    		{
    		    if(!isset($model->data[$model->alias]['created_by']))
    		    {
    		        $model->data[$model->alias]['created_by'] = $logged_user_id;
    		        
    		        /*
    		         * If the save is called with a whitelist, add 'created_by' to the whitelist
    		         * in order to have this field saved as well
    		         */
        		    if(!empty($model->whitelist) && !in_array('created_by', $model->whitelist))
        		    {
        		        $model->whitelist[] = 'created_by';
        		    }
    		    }
    		}
    		
    		/*
    	     * Id is set -> it is an update
    	     */
    		if($model->hasField('modified_by') && isset($model->data[$model->alias]['id']) && strlen($model->data[$model->alias]['id']) > 0)
    		{
    			$model->data[$model->alias]['modified_by'] = $logged_user_id;
    			
    			/*
		         * If the save is called with a whitelist, add 'modified_by' to the whitelist
		         * in order to have this field saved as well
		         */
    		    if(!empty($model->whitelist) && !in_array('modified_by', $model->whitelist))
    		    {
    		        $model->whitelist[] = 'modified_by';
    		    }
    		}
    	    elseif($model->hasField('updated_by') && isset($model->data[$model->alias]['id']) && strlen($model->data[$model->alias]['id']) > 0)
    		{
    			$model->data[$model->alias]['updated_by'] = $logged_user_id;
    			
    			/*
		         * If the save is called with a whitelist, add 'updated_by' to the whitelist
		         * in order to have this field saved as well
		         */
    		    if(!empty($model->whitelist) && !in_array('updated_by', $model->whitelist))
    		    {
    		        $model->whitelist[] = 'updated_by';
    		    }
    		}
	    }
	}
	
	
	/**
	 * Set the created_by and modified_by user id on the join tables if there are any to save
	 *
	 * Note:
	 * 			if there are any join table to save, the behaviour set a temporary 'hasMany' relation
	 * 			on the current Model and transform the $model->data in order to allow to save them.
	 *
	 * 			In order to conserve the existing data, we also have to retrieve first the existing data from
	 * 			the join table to set them again in the data to save.
	 *
	 *			CakePHP default comportment with join tables is to delete records, and save them again.
	 * 			This work to maintain relations, but would not work to keep history for created, modified, created_by and modified_by fields
	 *
	 * @param Model $model
	 * @param int $logged_user_id
	 * @return void
	 */
	private function set_user_on_join_tables(&$model, $logged_user_id = null)
	{
	    //debug($model);
	    //debug($model->hasAndBelongsToMany);
	    //debug($model->data);
	    
	    
	    foreach($model->hasAndBelongsToMany as $model_name => $relation_infos)
	    {
	        //debug($relation_infos);
	        
	        $className             = $relation_infos['className'];
	        $foreignKey            = $relation_infos['foreignKey'];
	        $associationForeignKey = $relation_infos['associationForeignKey'];
	        $joinTable_model_name  = $relation_infos['with'];
	        
	        
	        if(isset($model->data[$className][$className]))
	        {
	            /*
	             * Here we are in the situation of hasAndBelongsToMany data to save
	             */
	            //debug('Here we are in the situation of hasAndBelongsToMany data to save');
	            
	            $fk_ids = $model->data[$className][$className];
	            
	            if(is_array($fk_ids))
	            {
	                $fk_objects_for_hasMany = array();
	                foreach($fk_ids as $fk_id)
	                {
        		        /*
        		         * Tries to find if the linked element already exists
        		         */
	                    if(isset($model->{$joinTable_model_name}))
	                    {
	                        //debug('we are going to search for the existing linked data');
	                        
	                        if(isset($model->data[$model->alias]['id']))
	                        {
	                            $joinTable_object = $model->{$joinTable_model_name}->find('first', array('conditions' => array($foreignKey => $model->data[$model->alias]['id'], $associationForeignKey => $fk_id)));
	                        }
	                        else
	                        {
	                            $joinTable_object = false;
	                        }
	                        
	                        $linked_object_array = array($associationForeignKey => $fk_id);
	                        
	                        if($joinTable_object !== false)
	                        {
	                            /*********************************************
                                 * UPDATE record(s) in the join table
                                 *********************************************/
	                            
	                            /*
	                             * Resave all existing field values
	                             */
	                            
	                            foreach($joinTable_object[$joinTable_model_name] as $fieldname => $value)
	                            {
	                                $linked_object_array[$fieldname] = $value;
	                            }
	                            
	                            if(isset($logged_user_id))
	                            {
	                                $linked_object_array['modified_by'] = $logged_user_id;
	                            }
	                            
	                            /*
	                             * Do not save again 'modified' => allow cake to set the new 'modified' value
	                             */
	                            unset($linked_object_array['modified']);
	                            unset($linked_object_array['updated']);
	                        }
	                        else
	                        {
	                            /*********************************************
	                             * INSERT new record(s) in the join table
	                             *********************************************/
	                            if(isset($logged_user_id))
	                            {
	                                $linked_object_array['created_by'] = $logged_user_id;
	                            }
	                        }
	                        
	                        $fk_objects_for_hasMany[] = $linked_object_array;
	                    }
	                    else
	                    {
	                        debug('not able to search for the existing linked data');
	                    }
	                    
	                    $model->data[$className] = $fk_objects_for_hasMany;
	                }
	                
	                $model->bindModel(array('hasMany' => array($joinTable_model_name)));
	                $this->temporary_relations['hasMany'][] = $joinTable_model_name;
	            }
	        }
	    }
	}
	
	
	/**
	 * Reset the temporary relations created during the beforeSave operation
	 *
	 * @param Model $model
	 * @return void
	 */
	private function reset_relations(&$model)
	{
	    foreach($this->temporary_relations as $relation_type => $relations)
	    {
	        foreach($relations as $relation_name)
	        {
	            $model->unbindModel(array($relation_type => array($relation_name)));
	        }
	    }
	}
	
}
?>