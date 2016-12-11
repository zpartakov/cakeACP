<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosCalendarComponent extends Object
{
	var $components = array('Session');
	
	const DISPLAY_MODE_MONTH     = 'month';
	const DISPLAY_MODE_WEEK      = 'week';
	const DISPLAY_MODE_WEEK_HOUR = 'week_with_hours';
	const DISPLAY_MODE_DAY       = 'day';
	
	const NAVIG_MODE_AJAX = 'ajax';
	const NAVIG_MODE_URL  = 'url';
	
	const PARAM_CURRENT_DATE = 'date_to_show';
	const PARAM_CURRENT_DATE_FORMAT = 'Y-m-d';
	
	private $display_mode;
	private $navigation_mode;
	private $hide_other_months_dates = false;
	private $display_day_names = true;
	private $week_day_header_format  = '%A %d %B';
	private $month_day_header_format = '%A';
	private $next_event_info;
	private $previous_event_info;
	private $hour_start;
	private $hour_end;
	
	/**
	 * The step of the time to display in the view in hour (eg: 0.5 -> 30 minutes)
	 * @var decimal
	 */
	private $hour_interval;
	
	/**
	 * Name of the calendar instance.
	 * Used to store the last selected date in session in order to differentiate different calendars
	 *
	 * @var string
	 */
	private $calendar_instance_name  = 'alaxos_calendar';
	
	private $controller = null;
	private $dates = null;
	private $locale = null;
	
	private $event_model_name = 'Event';
	private $event_start_date_field = null;
	private $event_end_date_field = null;
	
	private $first_date_to_show;
	private $first_date_of_month;
	private $first_date_of_week;
	private $last_date_to_show;
	private $last_date_of_month;
	private $last_date_of_week;
	
	public function initialize(&$controller)
	{
		$this->controller      = $controller;
		$this->navigation_mode = self :: NAVIG_MODE_URL;
		$this->display_mode    = self :: DISPLAY_MODE_MONTH;
		
		$this->hour_start       = 8;
		$this->hour_end         = 17;
		$this->set_hour_interval(0.5);
		//$this->display_mode = self :: DISPLAY_MODE_WEEK;
		
		
		//debug('initialize');
		//debug($this->get_calendar_data());
	}
	
	public function startup(&$controller)
	{
		$this->initialize_dates_for_view();
		
		if(isset($controller->params['named']['display_mode']))
		{
		    $this->set_display_mode($controller->params['named']['display_mode']);
		}
	}
	
	public function initialize_dates_for_view()
	{
		switch ($this->display_mode)
		{
			case self :: DISPLAY_MODE_DAY:
			    throw new Exception('day display mode not implemented');
			    break;
			    
			case self :: DISPLAY_MODE_WEEK:
			case self :: DISPLAY_MODE_WEEK_HOUR:
				$this->initialize_dates_for_week();
				break;
						
			case self :: DISPLAY_MODE_MONTH:
				$this->initialize_dates_for_month();
			break;
		}
	}
	
	private function get_include_date()
	{
		if(isset($this->controller->passedArgs[self :: PARAM_CURRENT_DATE]))
		{
			$include_date = date(self :: PARAM_CURRENT_DATE_FORMAT, strtotime($this->controller->passedArgs[self :: PARAM_CURRENT_DATE]));
		}

		if(!isset($include_date) || $include_date == '1970-01-01')
		{
			if($this->Session->check('AlaxosCalendar.'. $this->calendar_instance_name . '.selected_date'))
			{
				$include_date = $this->Session->read('AlaxosCalendar.'. $this->calendar_instance_name . '.selected_date');
			}
			else
			{
				$include_date = date('Y-m-d');
			}
		}
		
		$this->Session->write('AlaxosCalendar.'. $this->calendar_instance_name . '.selected_date', $include_date);
		
		return $include_date;
	}
	
	private function do_not_cache_webpage()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
		header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); // HTTP/1.0
	}
	
	private function initialize_dates_for_week()
	{
		$include_date = $this->get_include_date();
		$week_day_number = date('N', strtotime($include_date));
		
		$this->first_date_to_show = date('Y-m-d', strtotime($include_date . ' -' . ($week_day_number - 1) . ' day'));
		$this->last_date_to_show  = date('Y-m-d', strtotime($this->first_date_to_show . ' +6 day'));
		
		$this->dates = array();
		$date_cursor = $this->first_date_to_show;
		while($date_cursor <= $this->last_date_to_show)
		{
			$date_info = array();
			
			$day = date('d', strtotime($date_cursor));
			$day_of_week = date('w', strtotime($date_cursor));
			
			$date_info['cell_options']['class'] = 'event_cell_week';
			
			if($date_cursor == date('Y-m-d'))
			{
				//$date_info['cell_css_class'] = $date_info['cell_css_class'] . ' today';
				$date_info['cell_options']['class'] = $date_info['cell_options']['class'] . ' today';
			}
			
			if($day_of_week == 6 || $day_of_week == 0)
			{
				$date_info['cell_options']['class'] .= ' wweekend';
			}
			
			$date_info['display_date'] = null;
			
			$this->dates[$date_cursor] = $date_info;
			
			$date_cursor = date('Y-m-d', strtotime($date_cursor . ' +1 day'));
		}
	}
	
	private function initialize_dates_for_month()
	{
		$include_date = $this->get_include_date();
		
		/*
		 * Find the first day to show
		 */
		$this->first_date_of_month = date('Y-m-01', strtotime($include_date));
		$first_day_week_day_number = date('N', strtotime($this->first_date_of_month));
		$this->first_date_to_show = date('Y-m-d', strtotime($this->first_date_of_month . ' -' . ($first_day_week_day_number - 1) . ' day'));
		
		$year = date('Y', strtotime($include_date));
		$month = date('m', strtotime($include_date));
		$next_month = $month + 1;
		if($next_month > 12)
		{
			$next_month = 1;
			$year = $year + 1;
		}
		
		/*
		 * Find the last day to show
		 */
		$this->last_date_of_month = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, $next_month, 1, $year)) . '-1 day'));
		$last_day_week_day_number = date('N', strtotime($this->last_date_of_month));
		$this->last_date_to_show = date('Y-m-d', strtotime($this->last_date_of_month . ' +' . (7 - $last_day_week_day_number) . ' day'));
		
		/*
		 * Fill dates to display
		 */
		$this->dates = array();
		$date_cursor = $this->first_date_to_show;
		while($date_cursor <= $this->last_date_to_show)
		{
			$day         = date('d', strtotime($date_cursor));
			$day_of_week = date('w', strtotime($date_cursor));
			
			$date_info = array();
			
			if($date_cursor < $this->first_date_of_month || $date_cursor > $this->last_date_of_month)
			{
				//$date_info['cell_css_class'] = 'event_cell_other_month';
				$date_info['cell_options']['class'] = 'event_cell_other_month';
			}
			else
			{
				//$date_info['cell_css_class'] = 'event_cell_current_month';
				$date_info['cell_options']['class'] = 'event_cell_current_month';
			}
			
			if($date_cursor == date('Y-m-d'))
			{
				//$date_info['cell_css_class'] = $date_info['cell_css_class'] . ' today';
				$date_info['cell_options']['class'] = $date_info['cell_options']['class'] . ' today';
			}
			
			if($day_of_week == 6 || $day_of_week == 0)
			{
				if($this->hide_other_months_dates)
				{
					if($date_cursor >= $this->first_date_of_month && $date_cursor <= $this->last_date_of_month)
					{
						$date_info['cell_options']['class'] .= ' weekend';
					}
				}
				else
				{
					$date_info['cell_options']['class'] .= ' weekend';
				}
			}
			
			if($day == 1)
			{
				DateTool :: set_current_locale($this->locale);
				
				if($this->hide_other_months_dates && ($date_cursor < $this->first_date_of_month || $date_cursor > $this->last_date_of_month))
				{
					$date_info['display_date'] = '';
				}
				else
				{
					$date_info['display_date'] = strftime('%d %B %Y', strtotime($date_cursor));
				}
			}
			else
			{
				if($this->hide_other_months_dates && ($date_cursor < $this->first_date_of_month || $date_cursor > $this->last_date_of_month))
				{
					$date_info['display_date'] = '';
				}
				else
				{
					$date_info['display_date'] = $day;
				}
			}
			
			//$date_info['event_model_name'] = $this->event_model_name;
			
			$this->dates[$date_cursor] = $date_info;
			
			$date_cursor = date('Y-m-d', strtotime($date_cursor . ' +1 day'));
		}
		
		//debug($this->dates);
	}
	
	public function get_dates()
	{
		return $this->dates;
	}
	
	
	public function set_locale($locale)
	{
		$this->locale = $locale;
	}
	
	public function set_navigation_mode($navigation_mode)
	{
		$this->navigation_mode = $navigation_mode;
	}
	
	public function set_display_mode($display_mode)
	{
	    if($display_mode == self :: DISPLAY_MODE_MONTH
	    || $display_mode == self :: DISPLAY_MODE_WEEK
    	|| $display_mode == self :: DISPLAY_MODE_WEEK_HOUR
    	|| $display_mode == self :: DISPLAY_MODE_DAY)
    	{
            $this->display_mode = $display_mode;
            $this->initialize_dates_for_view();
    	}
	}
	
	public function set_hide_other_months_dates($hide)
	{
		$this->hide_other_months_dates = $hide;
		
		$this->remove_other_month_dates();
	}
	
	public function set_display_day_names($enabled)
	{
		$this->display_day_names = $enabled;
	}
	
	public function set_week_day_header_format($format)
	{
		$this->week_day_header_format = $format;
	}
	
	public function set_month_day_header_format($format)
	{
		$this->month_day_header_format = $format;
	}

	public function set_calendar_instance_name($name)
	{
		$this->calendar_instance_name = $name;
	}
	
	public function set_first_hour_displayed($hour)
	{
	    $this->hour_start = $hour;
	}
	public function set_last_hour_displayed($hour)
	{
	    $this->hour_end = $hour;
	}
	
	/**
	 * The time interval to display if the hours are shown in the view
	 *
	 * @param float $interval Interval given in hours (e.g. 0.5 -> 30 min)
	 * @return unknown_type
	 */
	public function set_hour_interval($interval)
	{
	    if(is_numeric($interval))
	    {
	        $this->hour_interval = $interval;
	    }
	}
	
	public function add_events($events, $options = null)
	{
//		debug($events);
		
		$options['model_name']      = isset($options['model_name']) ?      $options['model_name'] :      'Event';
		$options['link_controller'] = isset($options['link_controller']) ? $options['link_controller'] : strtolower($options['model_name'] . 's');
		$options['link_action']     = isset($options['link_action']) ?     $options['link_action'] :     'view';
		$options['model_name']      = isset($options['model_name']) ?      $options['model_name'] :      'Event';
		$options['start_field']     = isset($options['start_field']) ?     $options['start_field'] :     'startDate';
		$options['end_field']       = isset($options['end_field']) ?       $options['end_field'] :       'endDate';
		$options['title_field']     = isset($options['title_field']) ?     $options['title_field'] :     'title';
		$options['id_field']        = isset($options['id_field']) ?        $options['id_field'] :        'id';
		$options['title_template']  = isset($options['title_template']) ?  $options['title_template'] :  '';
		$options['css_class']       = isset($options['css_class']) ?       $options['css_class'] :       'event';
		
		foreach ($events as $event)
		{
			//debug($event);
			//debug($options);
			$event_start_date = date('Y-m-d', strtotime($event[$options['model_name']][$options['start_field']]));
			$event_end_date   = date('Y-m-d', strtotime($event[$options['model_name']][$options['end_field']]));

			$date_cursor = $event_start_date;
			while($date_cursor <= $event_end_date)
			{
				if(array_key_exists($date_cursor, $this->dates))
				{
					if(strlen($options['title_template']) > 0)
					{
						$options['processed_title_template'] = $this->process_template($options['title_template'], $event);
					}
					
					$this->dates[$date_cursor]['events'][] = array('model' => $event, 'options' => $options);
				}
				
				$date_cursor = date('Y-m-d', strtotime($date_cursor . ' +1 day'));
			}
		}
		
		//debug($this->dates);
	}
	
	
	public function set_next_event($event, $model_name, $start_date_fieldname)
	{
	    if(isset($event) && is_array($event))
	    {
    		$event_info = array('start_date_fieldname' => $start_date_fieldname, 'model_name' => $model_name, 'event' => $event);
    		
    		if($this->display_mode == self::DISPLAY_MODE_MONTH)
    		{
    		    $next_period_date = $this->get_next_month_date();
    		}
    		elseif($this->display_mode == self::DISPLAY_MODE_WEEK || $this->display_mode == self::DISPLAY_MODE_WEEK_HOUR)
    		{
    		    $next_period_date = $this->get_next_week_date();
    		}
    		elseif($this->display_mode == self::DISPLAY_MODE_DAY)
    		{
    		    throw new Exception('next event not implemented for day');
    		}
    		
    		if(isset($this->next_event_info))
    		{
    			if( ($event[$model_name][$start_date_fieldname] >= $next_period_date)
    			    &&
    			    ($this->next_event_info['event'][ $this->next_event_info['model_name'] ][ $this->next_event_info['start_date_fieldname'] ] > $event[$model_name][$start_date_fieldname]))
    			{
    				$this->next_event_info = $event_info;
    			}
    		}
    		else
    		{
    			$this->next_event_info = $event_info;
    		}
	    }
	}
	
	public function set_previous_event($event, $model_name, $start_date_fieldname)
	{
	    if(isset($event) && is_array($event))
	    {
    		$event_info = array('start_date_fieldname' => $start_date_fieldname, 'model_name' => $model_name, 'event' => $event);
    		
    		$first_displayed_date = $this->get_first_displayed_date();
    		
    		if(isset($this->previous_event_info))
    		{
    		    if( ($event[$model_name][$start_date_fieldname] <= $first_displayed_date)
    			    &&
    			    ($this->previous_event_info['event'][ $this->previous_event_info['model_name'] ][ $this->previous_event_info['start_date_fieldname'] ] < $event[$model_name][$start_date_fieldname]))
    			{
    				$this->previous_event_info = $event_info;
    			}
    		}
    		else
    		{
    			$this->previous_event_info = $event_info;
		}
	    }
	}
	
	public function clear_events()
	{
		foreach ($this->dates as $index => $date)
		{
			if(isset($date['event']))
			{
				unset($this->dates[$index]['event']);
			}
		}
	}
	
	public function get_next_month_date()
	{
		return date('Y-m-d', strtotime($this->first_date_of_month . '+ 1 month'));
	}
	
	public function get_previous_month_date()
	{
		return date('Y-m-d', strtotime($this->first_date_of_month . '- 1 day'));
	}
	
	
	public function get_first_displayed_date()
	{
	    //debug( $this->first_date_to_show);
	    return $this->first_date_to_show;
	}
	
	public function get_last_displayed_date()
	{
	    //debug( $this->last_date_to_show);
	    return $this->last_date_to_show;
	}
	
	private function remove_other_month_dates()
	{
	    if(isset($this->dates) && is_array($this->dates))
	    {
	        foreach ($this->dates as $date_value => $options)
	        {
	            if($date_value < $this->first_date_of_month || $date_value > $this->last_date_of_month)
	            {
	                $options['display_date'] = null;
	                $this->dates[$date_value] = $options;
	            }
	        }
	    }
	}
	
	private function get_previous_week_date()
	{
		return date('Y-m-d', strtotime($this->first_date_to_show . '- 7 day'));
	}
	
	private function get_next_week_date()
	{
		return date('Y-m-d', strtotime($this->first_date_to_show . '+ 7 day'));
	}
	
	private function get_previous_event_date()
	{
		if(isset($this->previous_event_info['event'][$this->previous_event_info['model_name']][$this->previous_event_info['start_date_fieldname']]))
		{
			return date('Y-m-d', strtotime($this->previous_event_info['event'][$this->previous_event_info['model_name']][$this->previous_event_info['start_date_fieldname']]));
		}
	}
	
	private function get_next_event_date()
	{
		//debug($this->next_event_info);
		
		if(isset($this->next_event_info['event'][$this->next_event_info['model_name']][$this->next_event_info['start_date_fieldname']]))
		{
			return date('Y-m-d', strtotime($this->next_event_info['event'][$this->next_event_info['model_name']][$this->next_event_info['start_date_fieldname']]));
		}
	}
	
	private function get_calendar_title()
	{
		switch ($this->display_mode)
		{
			case self :: DISPLAY_MODE_DAY:
			case self :: DISPLAY_MODE_WEEK:
			case self :: DISPLAY_MODE_WEEK_HOUR:
				
				break;
				
			
			case self :: DISPLAY_MODE_MONTH:
				DateTool :: set_current_locale($this->locale);
				return strftime('%B %Y', strtotime($this->first_date_of_month));
				break;
		}
	}
	
	public function get_calendar_data()
	{
		$data = array();
		
		switch ($this->display_mode)
		{
			case self :: DISPLAY_MODE_DAY:
				break;
				
			case self :: DISPLAY_MODE_WEEK:
			    $data['previous_date'] = $this->get_previous_week_date();
				$data['next_date']     = $this->get_next_week_date();
				break;
				
			case self :: DISPLAY_MODE_WEEK_HOUR:
			    $data['previous_date']    = $this->get_previous_week_date();
				$data['next_date']        = $this->get_next_week_date();
				$data['hour_start']       = $this->hour_start;
				$data['hour_end']         = $this->hour_end;
				$data['hour_interval']    = $this->hour_interval;
				
				break;
			
			case self :: DISPLAY_MODE_MONTH:
				$data['previous_date'] = $this->get_previous_month_date();
				$data['next_date']     = $this->get_next_month_date();
				break;
		}
		
		$data['previous_event_date'] = $this->get_previous_event_date();
		$data['next_event_date']     = $this->get_next_event_date();
		$data['title']               = $this->get_calendar_title();
		$data['navigation_mode']     = $this->navigation_mode;
		$data['display_mode']        = $this->display_mode;
		$data['dates']               = $this->get_dates();
		
		if($this->display_day_names)
		{
			$data['day_names'] = $this->get_day_header_values();
		}

		if($this->navigation_mode == self :: NAVIG_MODE_AJAX)
		{
			/*
			 * Do not cache the page including the calendar to allow correct comportment
			 * when the back button is clicked to come back on the page
			 * -> the calendar is rebuild with the last selected date stored in session
			 */
			$this->do_not_cache_webpage();
		}
		
		return $data;
	}
	
	private function get_day_header_values()
	{
		DateTool :: set_current_locale($this->locale);
		
		$format = '';
		switch($this->display_mode)
		{
			case self :: DISPLAY_MODE_MONTH:
				$format = $this->month_day_header_format;;
				break;
				
			case self :: DISPLAY_MODE_WEEK:
			case self :: DISPLAY_MODE_WEEK_HOUR:
				$format = $this->week_day_header_format;
				break;
		}
		
		
		if($this->display_day_names || $this->display_mode == self :: DISPLAY_MODE_WEEK || $this->display_mode == self :: DISPLAY_MODE_WEEK_HOUR || $this->display_mode == self :: DISPLAY_MODE_MONTH)
		{
			$day_names = array();
			$date_cursor = $this->first_date_to_show;
			for($i = 1;$i <= 7; $i++)
			{
				$day_names[$i] = strftime($format, strtotime($date_cursor));
				
				$date_cursor = date('Y-m-d', strtotime($date_cursor . ' +1 day'));
			}
		}
		
		return $day_names;
	}
	
	private function process_template($template, $models)
	{
		//debug($models);
		
		$loop = true;
		foreach ($models as $model_name => $properties)
		{
			if(!$loop)
			{
				break;
			}
			
			foreach ($properties as $property_name => $property_value)
			{
				//stop to loop if no more properties to replace in template
				if(!strpos($template, '{'))
				{
					$loop = false;
					break;
				}
				
				$template = str_ireplace('{' . $model_name . '.' . $property_name . '}', $property_value, $template);
			}
		}
		
		//debug($template);
		
		return $template;
	}
	
	
}
?>
