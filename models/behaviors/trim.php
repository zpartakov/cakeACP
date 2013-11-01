<?php
/**
 * Add an automatic trim() of values before saving them in the datasource.
 *
 * By default all fields are trimed, but an array of fields to trim can be passed in the settings
 *
 * Example:
 *          //trim all fields
 *          var $actsAs = array('Alaxos.Trim');
 *
 *          //trim only lastname and firstname
 *          var $actsAs = array('Alaxos.Trim' => array('fields' => array('lastname', 'firstname')));
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.net
 *
 */
class TrimBehavior extends ModelBehavior
{
    const ALL_FIELDS = '*';
    
    function setup(&$model, $settings)
    {
        if(isset($settings['fields']))
        {
            $this->settings[$model->alias]['fields'] = $settings['fields'];
        }
        else
        {
            /*
             * Default settings -> trim all fields
             */
            $this->settings[$model->alias]['fields'] = TrimBehavior::ALL_FIELDS;
        }
    }
    
    function beforeSave(&$model)
    {
        $fields_to_trim = array();
        
        if($this->settings[$model->alias]['fields'] == TrimBehavior::ALL_FIELDS)
        {
            $fields_to_trim = array_keys($model->data[$model->alias]);
        }
        else
        {
            $fields_to_trim = $this->settings[$model->alias]['fields'];
        }
        
        foreach($model->data[$model->alias] as $fieldname => $value)
        {
            if(in_array($fieldname, $fields_to_trim))
            {
                $model->data[$model->alias][$fieldname] = trim($value);
            }
        }
    }
}
