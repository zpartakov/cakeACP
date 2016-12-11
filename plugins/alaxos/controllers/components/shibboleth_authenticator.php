<?php
/**
 * This class give the possibility to login through the Shibboleth mechanism (see http://shibboleth.internet2.edu)
 *
 * The users properties and the Shibboleth attributes can be mapped together to allow
 * automatic users creation when they login for the first time or attributes update when they login again.
 *
 * Some of the methods may be overriden in your own class, allowing you to write custom logic
 * to map Shibboleth attributes with users properties:
 * 		- log_user($user)
 * 		- set_new_user_default_properties($user)
 * 		- beforeSave($user)
 *
 * Note:
 * 		This class needs the Auth component to be loaded in order to work, as it is used to create users sessions
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class ShibbolethAuthenticatorComponent extends Object
{
    var $components = array('Session');
    
    const USER_PROPERTY   = 'user_property';
    const UPDATE_ON_LOGIN = 'update_on_login';
    
    /**
     * The controller using the ShibbolethAuthenticatorComponent
     * @var AppController
     */
    protected $controller;
    
    /**
    * The name of the Model representing the users
    *
    * @var string
    */
    protected $user_model_name = 'User';
    
    /**
    * The user external uid field name
    *
    * @var string
    */
    protected $external_uid_fieldname = 'external_uid';
    
    /**
	* the authentication type id field name
	*
	* Set a value for this variable if there is a field (in the database table that store the users)
	* that contains the authentication method of the user, and that can not be left empty.
	*
	* Note: see also $default_authentication_type_value
	*
	* @var string
	*/
	private $authentication_type_fieldname = 'authenticationtype_id';
	
	/**
	* the default authentication type value
	*
	* Set a value for this variable if there is a field (in the database table that store the users)
	* that contains the authentication method of the user, and that can not be left empty.
	*
	* Note: see also $authentication_type_fieldname
	*
	* @var string
	*/
	private $default_authentication_type_value;
	
    /**
     * Contains the key-value mapping between Shibooleth attributes and users properties
     *
     * @var array
     */
    protected $mapping = array();
    
    /**
     * Contains the key-value mapping between Shibooleth attributes and callback functions used to modify the Shibboleth values
     *
     * @var array
     */
    protected $mapping_callback = array();
    
    /**
    * the shibboleth attribute name used as the user unique id
    *
    * @var string
    */
    protected $shibboleth_attribute_uid;
    
    /**
    * A boolean indicating wether a non-existing user must be created on his first login
    *
    * @var boolean
    */
    protected $create_new_user = true;
    
    /**
     * A boolean indicating wether a new user has just been created
     *
     * @var boolean
     */
    protected $new_user_created = false;
    
    /**
     * Contains the errors
     *
     * @var array
     */
    protected $errors = array();
    
    /*****************************************************************************/
    
    public function initialize(&$controller)
	{
	    if(!defined('USER_PROPERTY'))
	    {
	        define('USER_PROPERTY', 'user_property');
	    }
	    
	    if(!defined('UPDATE_ON_LOGIN'))
	    {
	        define('UPDATE_ON_LOGIN', 'update_on_login');
	    }
	    
		$this->controller = $controller;
	}
	
	
	/*****************************************************************************/
	
    /**
    * Get the name of the Model representing the users
    *
    * @return string
    */
    public function get_user_model_name()
    {
    	return $this->user_model_name;
    }
    
    /**
    * Set the name of the Model representing the users
    *
    * @var $user_model_name string
    * @return void
    */
    public function set_user_model_name($user_model_name)
    {
    	$this->user_model_name = $user_model_name;
    }
    
	/**
    * Get the user external uid field name
    *
    * @return string
    */
    public function get_external_uid_fieldname()
    {
        if(strpos($this->external_uid_fieldname, '.') !== false)
        {
            return $this->external_uid_fieldname;
        }
        else
        {
            return $this->user_model_name . '.' . $this->external_uid_fieldname;
        }
    }
    
    /**
    * Set the user external uid field name
    *
    * @var $external_uid_fieldname string
    * @return void
    */
    public function set_external_uid_fieldname($external_uid_fieldname)
    {
    	$this->external_uid_fieldname = $external_uid_fieldname;
    }
    
	
	/**
	* Get the authentication type id field name
	*
	* @return string
	*/
	public function get_authentication_type_fieldname()
	{
	    if(strpos($this->authentication_type_fieldname, '.') !== false)
        {
            return $this->authentication_type_fieldname;
        }
        else
        {
            return $this->user_model_name . '.' . $this->authentication_type_fieldname;
        }
	}
	
	/**
	* Set the authentication type id field name
	*
	* @var $authentication_type_fieldname string
	* @return void
	*/
	public function set_authentication_type_fieldname($authentication_type_fieldname)
	{
		$this->authentication_type_fieldname = $authentication_type_fieldname;
	}
    
	/**
	* Get the default authentication type value
	*
	* @return string
	*/
	public function get_default_authentication_type_value()
	{
		return $this->default_authentication_type_value;
	}
	
	/**
	* Set the default authentication type value
	*
	* @var $default_authentication_type_value string
	* @return void
	*/
	public function set_default_authentication_type_value($default_authentication_type_value)
	{
		$this->default_authentication_type_value = $default_authentication_type_value;
	}
	
	/**
    * Get the shibboleth attribute name used as the user unique id
    *
    * @return string
    */
    public function get_shibboleth_attribute_uid()
    {
    	return $this->shibboleth_attribute_uid;
    }
    
    /**
    * Set the shibboleth attribute name used as the user unique id
    *
    * @var $shibboleth_attribute_uid string
    * @return void
    */
    public function set_shibboleth_attribute_uid($shibboleth_attribute_uid)
    {
    	$this->shibboleth_attribute_uid = $shibboleth_attribute_uid;
    }
    
	/**
    * Get the boolean indicating wether a non-existing user must be created on his first login
    *
    * @return boolean
    */
    public function get_create_new_user()
    {
    	return $this->create_new_user;
    }
    
    /**
    * Set the boolean indicating wether a non-existing user must be created on his first login
    *
    * @var $create_new_user boolean
    * @return void
    */
    public function set_create_new_user($create_new_user)
    {
    	$this->create_new_user = $create_new_user;
    }
    
    /**
     * Return a boolean indicated if a new user has been created during the login
     */
    public function is_new_user()
    {
    	return $this->new_user_created;
    }
    
    /*****************************************************************************/
    
    /**
     * Add a mapping between a Shibooleth attribute and a user property
     *
     * @param $shibboleth_attribute_name string
     * @param $user_property string
     * @param $update_on_login boolean
     * @return void
     */
    public function add_attribute_mapping($shibboleth_attribute_name, $user_property, $update_on_login = true)
    {
        $this->mapping[$shibboleth_attribute_name] = array(USER_PROPERTY => $user_property, UPDATE_ON_LOGIN => $update_on_login);
    }
    
    /**
     * Add a mapping between a Shibooleth attribute and a callback function used to modify the Shibboleth attribute value
     *
     * @param string $shibboleth_attribute_name
     * @param mixed $callback_function
     * @return void
     */
    public function add_callback_function($shibboleth_attribute_name, $callback_function)
    {
        $this->mapping_callback[$shibboleth_attribute_name] = $callback_function;
    }
    
    /**
     * Tries to authenticate the user according to the shibboleth attributes
     *
     * @return boolean
     */
    public function authenticate()
    {
        if($this->has_shibboleth_session())
        {
            $user = $this->get_existing_user();
            //debug($user);
            
            $is_new_user = false;
            $this->new_user_created = false;
            
            if(isset($user) || $this->create_new_user)
            {
                if(!isset($user) || $user == false)
                {
                    $user = array($this->user_model_name => array());
                    $user = $this->set_new_user_default_properties($user);
                    $is_new_user = true;
                }
                
                $user = $this->update_user_with_shibboleth_attributes($user);
                
                $user = $this->beforeSave($user);
                //debug($user);
                
                if(isset($this->authentication_type_fieldname) && isset($this->default_authentication_type_value))
                {
                    $user[$this->user_model_name][$this->authentication_type_fieldname] = $this->default_authentication_type_value;
                }
                
                if($this->controller->{$this->user_model_name}->save($user))
                {
                    //reload the user to be sure we have its id
                    $user = $this->controller->{$this->user_model_name}->read();
                 
                    if($is_new_user)
                    {
                        $this->new_user_created = true;
                    }
                    
                    return $this->log_user($user);
                }
                else
                {
                    foreach($this->controller->{$this->user_model_name}->validationErrors as $field => $error_msg)
                    {
                        $this->add_error($field . ' : ' . $error_msg);
                    }
                                        
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
   
    /**
     * Logs the given user in by using the Auth component
     *
     * @param unknown_type $user
     */
    protected function log_user($user)
	{
	    if(isset($user) && is_array($user))
		{
		    if(isset($this->controller->Auth))
		    {
		        return $this->controller->Auth->login($user);
		    }
		    else
		    {
		        $this->add_error(___d('alaxos', 'the Auth component must be loaded to use the Alaxos.ShibbolethAuthenticator component', true));
		        return false;
		    }
		}
	}
	
    /**
     * Check wether the user is logged with Shibboleth
     *
     * @return boolean
     */
    public function has_shibboleth_session()
    {
        $shibboleth_uid = $this->get_shibboleth_uid();
        
        return isset($shibboleth_uid);
    }
    
    /**
     * Tries to find an already existing user in the database corresponding to the Shibboleth logged user
     *
     * @return Model
     */
    public function get_existing_user()
    {
        if($this->has_shibboleth_session())
        {
            $shibboleth_uid = $this->get_shibboleth_uid();
            
            if(isset($shibboleth_uid) && strlen($shibboleth_uid) > 0)
            {
                /*
                 * Tries to find a Model in the database having this external uid
                 */
                if(!isset($this->controller->{$this->user_model_name}))
                {
                    $this->controller->loadModel($this->user_model_name);
                }
                
                if(isset($this->authentication_type_fieldname) && isset($this->default_authentication_type_value))
                {
                    $user = $this->controller->{$this->user_model_name}->find('first', array('conditions' => array($this->get_external_uid_fieldname() => $shibboleth_uid, $this->get_authentication_type_fieldname() => $this->default_authentication_type_value)));
                }
                else
                {
                    $user = $this->controller->{$this->user_model_name}->find('first', array('conditions' => array($this->get_external_uid_fieldname() => $shibboleth_uid)));
                }
                
                return $user;
            }
        }
        else
        {
            return null;
        }
    }
    
    /**
     * Get the current value of the Shibboleth uid
     *
     * @return string
     */
    public function get_shibboleth_uid()
    {
        return $this->get_shibboleth_value($this->shibboleth_attribute_uid);
    }
    
    /**
     * Get a Shibboleth attribute value
     *
     * @param $shibboleth_attribute string The name of the Shibboleth attribute to retrieve
     * @return string
     */
    public function get_shibboleth_value($shibboleth_attribute)
    {
//        debug($shibboleth_attribute);
//        debug($_SERVER);
        
        $cleaned_SERVER = $this->get_clean_redirect_prefixes_server();
        
        //debug($cleaned_SERVER);
        
        return isset($cleaned_SERVER[$shibboleth_attribute]) ? $cleaned_SERVER[$shibboleth_attribute] : null ;
    }
    
    
    /**
     *
     * @return array
     */
    public function get_errors()
    {
        return $this->errors;
    }
    
    
    /*****************************************************************************/

    private function get_clean_redirect_prefixes_server()
    {
        $cleaned_SERVER = array();
        
        foreach($_SERVER as $key => $value)
        {
            $new_key = $key;
            while(StringTool :: start_with($new_key, 'REDIRECT_'))
            {
                $new_key = substr($new_key, strlen('REDIRECT_'));
            }
            
            $cleaned_SERVER[$new_key] = $value;
        }
        
        return $cleaned_SERVER;
    }
    
    private function update_user_with_shibboleth_attributes($user)
    {
        foreach($this->mapping as $shibboleth_attribute_name => $field_info)
        {
            $fieldname = $field_info[USER_PROPERTY];
            $update    = $field_info[UPDATE_ON_LOGIN];
            
            if(!isset($user[$this->user_model_name][$fieldname]) || $update)
            {
                $shibboleth_value = $this->get_shibboleth_value($shibboleth_attribute_name);
                
                if(array_key_exists($shibboleth_attribute_name, $this->mapping_callback))
                {
                    $shibboleth_value = call_user_func($this->mapping_callback[$shibboleth_attribute_name], $shibboleth_value);
                }
                
                if(isset($shibboleth_value))
                {
                    $user[$this->user_model_name][$fieldname] = $shibboleth_value;
                }
            }
        }
        
        return $user;
    }
    
    
	/*****************************************************************************/
	
	/**
	 * Add error(s) to the errors
	 *
	 * @param string | array $error
	 * @return void
	 */
	protected function add_error($error)
	{
	    if(is_array($error))
	    {
	        foreach($error as $err)
	        {
	            $this->errors[] = $err;
	        }
	    }
	    else
	    {
	        $this->errors[] = $error;
	    }
	}
	
	/**
	 *
	 * @param Model $user
	 * @return Model
	 */
	protected function set_new_user_default_properties($user)
	{
	    $user[$this->user_model_name][$this->external_uid_fieldname] = $this->get_shibboleth_uid();
	    
	    return $user;
	}
	
	/**
	 * Function called before the authenticated user is saved back in the database
	 *
	 * @param Model $user
	 * @return Model
	 */
	protected function beforeSave($user)
	{
	    unset($user[$this->user_model_name]['modified']);
	    unset($user[$this->user_model_name]['updated']);
	    
	    return $user;
	}
    
    
    /*****************************************************************************/
    
}
?>