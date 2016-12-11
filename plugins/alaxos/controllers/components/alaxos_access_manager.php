<?php
/**
 * This class can be used instead of the Auth + ACL core components to get a simpler Authorization mechanism
 *
 * The idea is to allow / reject access to actions based on their prefixes.
 * You can for instance choose that a user with the role 'administrator' can access all actions with the prefix 'admin_'
 *
 * Note:
 *
 * 		This class doesn't use at all the Auth or Acl core components.
 * 		It was written at a time when the Acl component did not support storage of access rights in a database, making it not usable to me
 * 		I may consider this component as deprecated one day.
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosAccessManagerComponent extends Object
{
	var $components = array('Session');
	
	var $actions_roles_mapping = array();
	
	/*
	 * Contains prefix - roles pairs defining roles allowed to access all actions with the same prefix
	 */
	var $prefix_roles_mapping  = array();
	
	var $controller = null;
	
	/**
	 * The controller used for login
	 * (used in combination with $login_action)
	 *
	 * @var string
	 */
	var $login_controller = null;
	
	/**
	 * The action used for login
	 * (used in combination with $login_controller)
	 *
	 * @var string
	 */
	var $login_action = null;
	
	function initialize(&$controller)
	{
		$this->controller = $controller;
		$this->set_login_url();
	}
	
	function startup(&$controller)
	{
		$this->check_access();
	}
	
	function add_action($action_name, $authorized_roles = array(ROLE_ID_ADMINISTRATOR))
	{
		if(is_array($authorized_roles))
		{
			$this->actions_roles_mapping[$action_name] = $authorized_roles;
		}
		else
		{
			$this->actions_roles_mapping[$action_name] = array($authorized_roles);
		}
	}
	
    function add_prefix($prefix_name, $authorized_roles = array(ROLE_ID_ADMINISTRATOR))
	{
		if(is_array($authorized_roles))
		{
			$this->prefix_roles_mapping[$prefix_name] = $authorized_roles;
		}
		else
		{
			$this->prefix_roles_mapping[$prefix_name] = array($authorized_roles);
		}
	}
	
	function set_login_url($login_controller = 'users', $login_action = 'login')
	{
	    $this->login_controller = $login_controller;
	    $this->login_action     = $login_action;
	}
	
	function check_access()
	{
		$authorized = false;
		$user_logged = false;
		
		$action = $this->controller->action;
		if(isset($this->controller->params['prefix']))
		{
		    $prefix = $this->controller->params['prefix'];
		}
		
		if(array_key_exists($action, $this->actions_roles_mapping))
		{
			/*
			 * The action is protected
			 * -> check if logged User has the right to do the action
			 */
			
			if($this->Session->check(LOGGED_USER))
			{
				$logged_user = $this->Session->read(LOGGED_USER);
				
				if(isset($logged_user))
				{
				    $user_logged = true;
				    
					foreach ($this->actions_roles_mapping[$action] as $authorized_role_id)
					{
						foreach ($logged_user[LOGGED_USER_ROLES] as $role)
						{
							if($role['id'] == $authorized_role_id || $role['id'] == ROLE_ID_ADMINISTRATOR)
							{
								$authorized = true;
								break;
							}
						}
					}
				}
			}
		}
		elseif(isset($prefix) && array_key_exists($prefix, $this->prefix_roles_mapping))
		{
		    /*
			 * The action is protected
			 * -> check if logged User has the right to do the action
			 */
			
			if($this->Session->check(LOGGED_USER))
			{
				$logged_user = $this->Session->read(LOGGED_USER);
				
				if(isset($logged_user))
				{
				    $user_logged = true;
				    
					foreach ($this->prefix_roles_mapping[$prefix] as $authorized_role_id)
					{
						foreach ($logged_user[LOGGED_USER_ROLES] as $role)
						{
							if($role['id'] == $authorized_role_id || $role['id'] == ROLE_ID_ADMINISTRATOR)
							{
								$authorized = true;
								break;
							}
						}
					}
				}
			}
		}
		else
		{
			$authorized = true;
		}
		
		
		if(!$authorized)
		{
		    if(isset($this->controller->RequestHandler) && $this->controller->RequestHandler->isAjax())
		    {
		        if($user_logged)
		        {
		            e('<span class="error">' . ___d('alaxos', 'not authorized', true) . '</span>');
		        }
		        else
		        {
		            e('<span class="error">' . ___d('alaxos', 'please login', true) . '</span>');
		        }
		        
		        die();
		    }
		    else
		    {
		        if($user_logged)
		        {
    			    $this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error', array('class' => 'error'));
		        }
		        else
		        {
		            $this->Session->setFlash(___d('alaxos', 'please login', true), 'flash_error', array('class' => 'error'));
		        }
		        
    			$return_url = $this->controller->get_return_url();
    			
    			/*
    			 * Note:
    			 * 		we use 'admin' => '0' because 'admin' => false leads to an infinite redirection loop
    			 * 		Why ?
    			 * 		TODO: discover why... ;-)
    			 */
    			$this->controller->redirect(array('admin' => '0', 'controller' => $this->login_controller, 'action' => $this->login_action . '?' . RETURN_URL . '=' . $return_url));
		    }
		}
	}
	
}
?>