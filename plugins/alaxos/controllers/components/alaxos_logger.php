<?php
/*
--
-- MySQL tables and data
--

CREATE TABLE IF NOT EXISTS `log_categories` (
  `id`       int(11) NOT NULL auto_increment,
  `name`     varchar(50) NOT NULL,
  `order`    int(11) NOT NULL,
  `visible`  tinyint(1) NOT NULL,
  `created`  datetime NOT NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `log_categories` (`id`, `name`, `order`, `visible`, `created`, `modified`) VALUES
(1, 'Debug',       10, 1, NOW(), NULL),
(2, 'Info',        20, 1, NOW(), NULL),
(3, 'Warning',     30, 1, NOW(), NULL),
(4, 'Error',       40, 1, NOW(), NULL),
(5, 'Visit',       50, 1, NOW(), NULL),
(6, 'Request',     60, 1, NOW(), NULL),
(7, 'Bot request', 70, 1, NOW(), NULL),
(8, 'RSS',         80, 1, NOW(), NULL);

CREATE TABLE IF NOT EXISTS `logs` (
  `id`              int(11) NOT NULL auto_increment,
  `log_category_id` int(11) NOT NULL,
  `message1`        varchar(512) collate utf8_unicode_ci NOT NULL,
  `message2`        varchar(512) collate utf8_unicode_ci default NULL,
  `message3`        varchar(512) collate utf8_unicode_ci default NULL,
  `message4`        varchar(512) collate utf8_unicode_ci default NULL,
  `message5`        varchar(512) collate utf8_unicode_ci default NULL,
  `message6`        varchar(512) collate utf8_unicode_ci default NULL,
  `message7`        varchar(512) collate utf8_unicode_ci default NULL,
  `message8`        varchar(512) collate utf8_unicode_ci default NULL,
  `created`         datetime NOT NULL,
  `modified`        datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

 */

/**
 * This component can be used to easily fill a "logs" table.
 *
 * $this->AlaxosLogger->auto_log()		store new visits, requests, bot requests and RSS checks
 *
 * $this->AlaxosLogger->log()			store whatever you pass to the function
 */
class AlaxosLoggerComponent extends Object
{
	/*
	 * Log categories
	 */
	const DEBUG         = 1;
	const INFO          = 2;
	const WARNING       = 3;
	const ERROR         = 4;
	const VISIT         = 5;
	const REQUEST       = 6;
	const BOT_REQUEST   = 7;
	const RSS           = 8;

	private $custom_log_categories = array();

	/**
     * @var AppController
     */
    private $controller = null;

    /**
     * @var array If one of these strings is found in the user agent, the request is considered as made by a bot
     */
    private $bots_agents_subtexts = array('google', 'yahoo', 'bing', 'bot', 'baidu', 'spider', 'crawler', 'ask.com', 'wordpress', 'postrank', 'scoutjet', 'Windows-Live-Social-Object-Extractor-Engine');

    /**
     * List of action prefixes to ignore.
     * If any log method is called and the action prefix belongs to this array, no Log is stored
     *
     * @var array
     */
    private $action_prefixes_to_ignore = array();

    /**
     * An array of log categories ids that must never be deleted when the logs table is auto cleaned
     *
     * @var array Array of ids
     */
    private $log_categories_to_keep = array();

    /**
     * The number of days logs must be kept
     *
     * If null, the logs are never deleted
     *
     * @var int Number of days logs must be kept
     */
    private $days_to_keep_logs = null;

    /*********************************************************************************/

	public function initialize(&$controller)
	{
	    $this->controller = $controller;
	}

	/*********************************************************************************/

	public function get_bots_agents_subtexts()
	{
		return $this->bots_agents_subtexts;
	}

	public function set_bots_agents_subtexts($bots_agents_subtexts)
	{
		$this->bots_agents_subtexts = $bots_agents_subtexts;
	}

	public function add_bots_agents_subtexts($bot_agent_subtext)
	{
		$this->bots_agents_subtexts[] = $bot_agent_subtext;
	}

	/*********************************************************************************/

	public function get_custom_log_categories()
	{
		return $this->custom_log_categories;
	}

	public function set_custom_log_categories($custom_log_categories)
	{
		$this->custom_log_categories = $custom_log_categories;
	}

	public function add_custom_log_category($log_category)
	{
		$this->custom_log_categories[] = $log_category;
	}

	/*********************************************************************************/

	public function get_action_prefixes_to_ignore()
	{
		return $this->action_prefixes_to_ignore;
	}

	public function set_action_prefixes_to_ignore($action_prefixes_to_ignore)
	{
		$this->action_prefixes_to_ignore = $action_prefixes_to_ignore;
	}

	public function add_action_prefix_to_ignore($action_prefix_to_ignore)
	{
		$this->action_prefixes_to_ignore[] = $action_prefix_to_ignore;
	}

	/*********************************************************************************/

    public function set_log_categories_to_keep($log_categories_to_keep)
    {
    	$this->log_categories_to_keep = $log_categories_to_keep;
    }

	public function add_log_category_to_keep($log_category_id)
    {
    	$this->log_categories_to_keep[] = $log_category_id;
    }

	public function get_log_categories_to_keep($log_categories_to_keep)
    {
    	return $this->log_categories_to_keep;
    }

    /*********************************************************************************/

    /**
     * Set the number of days the logs must be kept
     * @param int $days_to_keep_logs The number of days the logs must be kept
     */
	public function set_days_to_keep_logs($days_to_keep_logs)
    {
    	$this->days_to_keep_logs = $days_to_keep_logs;
    }

	/*********************************************************************************/

	/**
	 * @return boolean
	 */
	public function is_bot_request()
	{
		foreach($this->bots_agents_subtexts as $bots_subtext)
		{
			if(stripos($_SERVER['HTTP_USER_AGENT'], $bots_subtext) !== false)
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * @return boolean
	 */
	public function is_rss_request()
	{
		if(!$this->is_bot_request() && StringTool :: end_with($this->controller->params['url']['url'], '.rss'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @return boolean
	 */
	public function is_human_request()
	{
		return (!$this->is_rss_request() && !$this->is_bot_request());
	}

	/*********************************************************************************/

	public function get_request_url()
	{
	    $hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
	    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';

		if(!isset($_SERVER['REQUEST_URI']))
		{
			if(isset($_SERVER['QUERY_STRING']))
			{
			    return $protocol . '://' . $hostname . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
			}
			else
			{
				return $protocol . '://' . $hostname . $_SERVER['PHP_SELF'];
			}
		}
		else
		{
			return $protocol . '://' . $hostname . $_SERVER['REQUEST_URI'];
		}
	}

	public function is_current_prefix_disabled()
	{
	    if(isset($this->controller->params['prefix']))
	    {
	        return in_array($this->controller->params['prefix'], $this->action_prefixes_to_ignore);
	    }
	    else
	    {
	        return false;
	    }
	}

	public function log($log_category, $message1,        $message2 = null, $message3 = null, $message4 = null,
	                                   $message5 = null, $message6 = null, $message7 = null, $message8 = null)
	{
        if(!isset($this->controller->Log))
	    {
	        $this->controller->loadModel('Alaxos.Log');
	    }

		$this->controller->Log->create();

		$this->controller->Log->set('log_category_id', $log_category);
		$this->controller->Log->set('message1',        $message1);
		$this->controller->Log->set('message2',        $message2);
		$this->controller->Log->set('message3',        $message3);
		$this->controller->Log->set('message4',        $message4);
		$this->controller->Log->set('message5',        $message5);
		$this->controller->Log->set('message6',        $message6);
		$this->controller->Log->set('message7',        $message7);
		$this->controller->Log->set('message8',        $message8);

		if(!$this->controller->Log->save())
		{
		    $this->controller->Session->setFlash(___('a log record could not be saved', true), 'flash_error');
		}
	}

	/********************************************************************************/

	public function auto_log()
	{
	    if(!$this->is_current_prefix_disabled())
	    {
    		if($this->is_bot_request())
    		{
    			$this->request(AlaxosLoggerComponent :: BOT_REQUEST);
    		}
    		elseif($this->is_rss_request())
    		{
    			$this->request(AlaxosLoggerComponent :: RSS);
    		}
    		elseif($this->is_human_request())
    		{
    			/*
    			 * Count visit only if the request concern a webpage
    			 */
    			if(empty($this->controller->params['url']['ext']) || $this->controller->params['url']['ext'] == 'html')
    			{
    				$this->visit();
    			}

    			$this->request(AlaxosLoggerComponent :: REQUEST);
    		}
    		else
    		{
    			$this->request(AlaxosLoggerComponent :: WARNING);
    		}
	    }
	}

	public function request($log_category = null, $message = null)
	{
		if(!isset($log_category))
		{
			$log_category = AlaxosLoggerComponent :: REQUEST;
		}

		$url            = $this->get_request_url();
		$user_agent     = $_SERVER['HTTP_USER_AGENT'];
		$ip_address     = $_SERVER['REMOTE_ADDR'];
		$hostname       = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$referer        = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null;
		$request_method = $_SERVER['REQUEST_METHOD'];
		$data           = null;

		if(!empty($this->controller->data))
		{
			$data = serialize($this->controller->data);
		}

		$this->log($log_category, $url, $user_agent, $ip_address, $hostname, $referer, $request_method, $data, $message);
	}

	public function visit()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET' && $this->is_human_request() && isset($this->controller->Session))
		{
			/***
			 * Check if visit is already counted
			 */
			if(!$this->controller->Session->check('alaxos.visit_counted'))
			{
				$this->request(AlaxosLoggerComponent :: VISIT);

				$this->controller->Session->write('alaxos.visit_counted', true);
			}
		}
	}

	public function debug($message1, $message2 = null, $message3 = null, $message4 = null, $message5 = null, $message6 = null, $message7 = null, $message8 = null)
	{
		$this->log(AlaxosLoggerComponent :: DEBUG, $message1, $message2, $message3, $message4, $message5, $message6, $message7, $message8);
	}

	public function info($message1, $message2 = null, $message3 = null, $message4 = null, $message5 = null, $message6 = null, $message7 = null, $message8 = null)
	{
		$this->log(AlaxosLoggerComponent :: INFO, $message1, $message2, $message3, $message4, $message5, $message6, $message7, $message8);
	}

	public function warning($message1, $message2 = null, $message3 = null, $message4 = null, $message5 = null, $message6 = null, $message7 = null, $message8 = null)
	{
		$this->log(AlaxosLoggerComponent :: WARNING, $message1, $message2, $message3, $message4, $message5, $message6, $message7, $message8);
	}

	public function error($message1, $message2 = null, $message3 = null, $message4 = null, $message5 = null, $message6 = null, $message7 = null, $message8 = null)
	{
		$this->log(AlaxosLoggerComponent :: ERROR, $message1, $message2, $message3, $message4, $message5, $message6, $message7, $message8);
	}

	public function auto_clean_logs()
	{
		if(isset($this->days_to_keep_logs))
		{
			if(!isset($this->controller->Log))
			{
				$this->controller->loadModel('Alaxos.Log');
			}

			if(!$this->controller->Log->deleteAll(array('Log.created < ' => date('Y-m-d H:i:s', strtotime('-' . $this->days_to_keep_logs . ' days')),
                                                        'NOT' => array('Log.log_category_id' => $this->log_categories_to_keep)),
			                                      false, false)
			  )
			{
				$this->controller->Session->setFlash(___('a log record could not be saved', true), 'flash_error');
			}
		}
	}

	public function beforeRender(&$controller)
	{
		$this->auto_clean_logs();
	}
}