<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosCalendarHelper extends HtmlHelper
{
	var $helpers = array('Html', 'Alaxos.AlaxosHtml', 'Js' => 'Jquery');
	
	var $cell_options = array();
	var $cell_template = null;
	
	/**
	 * Height of the hours when hours are displayed
	 * @var int
	 */
	var $time_display_height = 20;
	
	public function set_cell_options($cell_options)
	{
		$this->cell_options = $cell_options;
	}
	
	public function set_cell_template($cell_template)
	{
		$this->cell_template = $cell_template;
	}
	
	public function display($calendar_data)
	{
		//debug($calendar_data);
		
		e('<div id="alaxos_calendar">');
		
		$this->display_header($calendar_data);
		$this->display_calendar($calendar_data);
		
		e('</div>');
	}
	
	private function display_header($calendar_data)
	{
		$cells = array();
		
		if($calendar_data['navigation_mode'] == 'ajax')
		{
		    /*
		     * The Jquery library is needed to navigate with AJAX
		     */
			$this->AlaxosHtml->include_js_jquery();
			$this->AlaxosHtml->include_js_jquery_no_conflict();
			$this->Js->JqueryEngine->jQueryObject = '$j';
			
			$cells[] = array('content' => '<div id="agenda_working_left" style="float:right;display:none;">' . $this->AlaxosHtml->image('/alaxos/img/ajax/waiting24.gif') . '</div>', 'cell_options' => array('class' => 'agenda_indicator'));
		}
		
		if(isset($calendar_data['previous_event_date']) && strlen($calendar_data['previous_event_date']) > 0)
		{
			if($calendar_data['navigation_mode'] == 'ajax')
			{
				$cells[] = array(
								'content' => $this->Js->link('<<', 
																array('action' => 'get_calendar', 'date_to_show' => $calendar_data['previous_event_date'], 'display_mode' => $calendar_data['display_mode']), 
																array( 'update' => '#alaxos_calendar', 
																		'before' => '$j("#agenda_working_left").css("display", "block");',
																		'complete' => '$j("#agenda_working_left").css("display", "none");', 
																		'alt' => __d('alaxos', 'previous event', true), 
																		'title' => __d('alaxos', 'previous event', true))
															  ), 
								'cell_options' => array('class' => 'agenda_navigate_event')
								);
			}
			else
			{
				$cells[] = array('content' => $this->AlaxosHtml->link('<<', array('date_to_show' => $calendar_data['previous_event_date'], 'display_mode' => $calendar_data['display_mode']), array('alt' => __d('alaxos', 'previous event', true), 'title' => __d('alaxos', 'previous event', true))), 'cell_options' => array('class' => 'agenda_navigate_event'));
				
			}
		}
		else
		{
			$cells[] = array();
		}
		
		if($calendar_data['navigation_mode'] == 'ajax')
		{
			$cells[] = array(
								'content' => $this->Js->link('<', 
																array('action' => 'get_calendar', 'date_to_show' => $calendar_data['previous_date'], 'display_mode' => $calendar_data['display_mode']), 
																array( 'update' => '#alaxos_calendar', 
																	   'before' => '$j("#agenda_working_left").css("display", "block");',
																		'complete' => '$j("#agenda_working_left").css("display", "none");')
															  ), 
								'cell_options' => array('class' => 'agenda_navigate_event')
								);
		}
		elseif($calendar_data['navigation_mode'] == 'url')
		{
			$cells[] = array('content' => $this->AlaxosHtml->link('<', array('date_to_show' => $calendar_data['previous_date'], 'display_mode' => $calendar_data['display_mode']), array( 'update' => 'alaxos_calendar', 'indicator' => 'agenda_working_left')), 'cell_options' => array('class' => 'agenda_navigate_date'));
			
		}
		
		$cells[] = array('content' => ucfirst($calendar_data['title']), 'cell_options' => array('class' => 'agenda_title'));
		
		if($calendar_data['navigation_mode'] == 'ajax')
		{
			$cells[] = array(
								'content' => $this->Js->link('>', 
																array('action' => 'get_calendar', 'date_to_show' => $calendar_data['next_date'], 'display_mode' => $calendar_data['display_mode']), 
																array( 'update' => '#alaxos_calendar', 
																		'before' => '$j("#agenda_working_right").css("display", "block");',
																		'complete' => '$j("#agenda_working_right").css("display", "none");',)
															  ), 
								'cell_options' => array('class' => 'agenda_navigate_event')
								);
		}
		elseif($calendar_data['navigation_mode'] == 'url')
		{
			$cells[] = array('content' => $this->AlaxosHtml->link('>', array('date_to_show' => $calendar_data['next_date'], 'display_mode' => $calendar_data['display_mode']), array( 'update' => 'alaxos_calendar', 'indicator' => 'agenda_working_right')), 'cell_options' => array('class' => 'agenda_navigate_date'));
			
		}
		
		if(isset($calendar_data['next_event_date']) && strlen($calendar_data['next_event_date']) > 0)
		{
			if($calendar_data['navigation_mode'] == 'ajax')
			{
				$cells[] = array(
								'content' => $this->Js->link('>>', 
																array('action' => 'get_calendar', 'date_to_show' => $calendar_data['next_event_date'], 'display_mode' => $calendar_data['display_mode']), 
																array( 'update' => '#alaxos_calendar', 
																		'before' => '$j("#agenda_working_right").css("display", "block");',
																		'complete' => '$j("#agenda_working_right").css("display", "none");', 
																		'alt' => __d('alaxos', 'next event', true), 
																		'title' => __d('alaxos', 'next event', true))
															  ), 
								'cell_options' => array('class' => 'agenda_navigate_event')
								);
			}
			else
			{
				$cells[] = array('content' => $this->AlaxosHtml->link('>>', array('date_to_show' => $calendar_data['next_event_date'], 'display_mode' => $calendar_data['display_mode']), array('alt' => __d('alaxos', 'next event', true), 'title' => __d('alaxos', 'next event', true))), 'cell_options' => array('class' => 'agenda_navigate_event'));
				
			}
		}
		else
		{
			$cells[] = array();
		}
		
		if($calendar_data['navigation_mode'] == 'ajax')
		{
			$cells[] = array('content' => '<div id="agenda_working_right" style="float:right;display:none;">' . $this->AlaxosHtml->image('/alaxos/img/ajax/waiting24.gif') . '</div>', 'cell_options' => array('class' => 'agenda_indicator'));
		}
		
		if($calendar_data['navigation_mode'] == 'ajax')
		{
			$cell_number = 7;
		}
		elseif($calendar_data['navigation_mode'] == 'url')
		{
			$cell_number = 5;
		}
		
		$this->AlaxosHtml->formatTable($cells, $cell_number, null, array('cellspacing' => '0px', 'cellpadding' => '5px', 'align' => 'center', 'class' => 'agenda_header'));
		
		echo $this->Js->writeBuffer();
	}
	
	private function display_calendar($calendar_data)
	{
		switch($calendar_data['display_mode'])
		{
		    case AlaxosCalendarComponent :: DISPLAY_MODE_MONTH:
		        $this->display_month_calendar($calendar_data);
		        break;
		        
		    case AlaxosCalendarComponent :: DISPLAY_MODE_WEEK:
		        $this->display_week_calendar($calendar_data);
		        break;
		   
		    case AlaxosCalendarComponent :: DISPLAY_MODE_WEEK_HOUR:
		        $this->display_week_hour_calendar($calendar_data);
		        break;

		    case AlaxosCalendarComponent :: DISPLAY_MODE_DAY:
		        $this->display_day_calendar($calendar_data);
		        break;
		}
	}
	
	private function display_month_calendar($calendar_data)
	{
	    $cells = $this->get_calendar_cells($calendar_data);
		$this->AlaxosHtml->formatTable($cells, 7, null, array('cellspacing' => '0px', 'cellpadding' => '5px', 'align' => 'center', 'class' => 'agenda_table'));
	}
	
	private function display_week_calendar($calendar_data)
	{
	    $cells = $this->get_calendar_cells($calendar_data);
		$this->AlaxosHtml->formatTable($cells, 7, null, array('cellspacing' => '0px', 'cellpadding' => '5px', 'align' => 'center', 'class' => 'agenda_table'));
	}
	
	
	public function set_time_display_height($height)
	{
	    $this->time_display_height = $height;
	}
	
	private function display_week_hour_calendar($calendar_data)
	{
	    //TEST
		$cells = $this->get_calendar_cells_with_hours($calendar_data, true);
		$this->AlaxosHtml->formatTable($cells, 8, null, array('cellspacing' => '0px', 'cellpadding' => '5px', 'align' => 'center', 'class' => 'agenda_table'));
	}
	
	
	private function display_day_calendar($calendar_data)
	{
	    throw new Exception('day display not implemented');
	}
	
	
	private function get_calendar_cells_with_hours($calendar_data)
	{
	    $dates = $calendar_data['dates'];
	    //debug($dates);
	    
	    $date_keys = array_keys($dates);
	    
	    $cells      = array(array('cell_options' => array('class' => 'dayname')));
	    $days_names = $this->get_day_names_cells($calendar_data);
	    $cells      = array_merge($cells, $days_names);
	    
	    $hours = DateTool :: get_time_array($calendar_data['hour_start'], $calendar_data['hour_end'], $calendar_data['hour_interval']);
	    
	    /*
	     * Hour cell content
	     */
	    $hour_string = '';
	    $total_height = 0;
	    $css_class = 'hour_zone';
	    foreach($hours as $index => $hour)
	    {
	        if($index == count($hours) - 1)
	        {
	            $css_class = 'last_hour_zone';
	        }
	        
	        $hour_string  .= '<div class="' . $css_class . '" style="height:' . $this->time_display_height . 'px;">' . $hour . '</div>';
	        $total_height += $this->time_display_height;
	    }
	    
	    $hour_display_height = $this->time_display_height / $calendar_data['hour_interval'];
	    
	    $cell_content = array();
	    $cell_content['content'] = $hour_string;
	    $cell_content['cell_options'] = array('class' => 'hour_column');
	    
	    $cells[] = $cell_content;
	    
	    for($i = 0; $i < 7; $i++)
	    {
	        $cell_content = array();
	        
	        $current_date = $date_keys[$i];
	        
	        $calendar_start_datetime = '';
	        $calendar_end_datetime   = '';
	        $event_start_date = '';
	        $event_end_date = '';
	        
//	        debug($dates);
//	        debug($date_keys[$i]);
	        
	        if(isset($dates[$date_keys[$i]]['events']))
	        {
	            $cell_content['content'] = '';
	            
    	        foreach($dates[$date_keys[$i]]['events'] as $event)
    	        {
    	             $event_start_date = new Datetime($event['model'][$event['options']['model_name']][$event['options']['start_field']]);
    	             $event_end_date   = new Datetime($event['model'][$event['options']['model_name']][$event['options']['end_field']]);
    	             
//    	             DateTool :: get_time_from_hour($calendar_data['hour_start']);
//    	             DateTool :: get_time_from_hour($calendar_data['hour_end']);
    	             
    	             $calendar_start_datetime = new Datetime($current_date . ' ' . DateTool :: get_time_from_hour($calendar_data['hour_start']));
    	             $calendar_end_datetime   = new Datetime($current_date . ' ' . DateTool :: get_time_from_hour($calendar_data['hour_end']));
    	             
//    	             debug('event start: ' . $event_start_date->format('d.m.Y H:i:s'));
//    	             debug('event end: ' . $event_end_date->format('d.m.Y H:i:s'));
//    	             debug('calendar start: ' . $calendar_start_datetime->format('d.m.Y H:i:s'));
//    	             debug('calendar end: ' . $calendar_end_datetime->format('d.m.Y H:i:s'));
//    	             debug('------------');
    	             
    	             if(
    	             ($event_start_date <= $calendar_start_datetime && $event_end_date > $calendar_start_datetime)
    	             ||
    	             ($event_start_date < $calendar_end_datetime && $event_end_date >= $calendar_end_datetime)
    	             ||
    	             ($event_start_date >= $calendar_start_datetime && $event_end_date <= $calendar_end_datetime)
    	             )
    	             {
    	                 /*
    	                  * Event must be displayed
    	                  */
    	                 
    	                 $top_margin = 2;
    	                 
    	                 $id         = $event['model'][$event['options']['model_name']][$event['options']['id_field']];
                         $controller = $event['options']['link_controller'];
						 $action     = $event['options']['link_action'];
					
    	                 $event_start_timestamp    = strtotime($event['model'][$event['options']['model_name']][$event['options']['start_field']]);
    	                 $event_end_timestamp      = strtotime($event['model'][$event['options']['model_name']][$event['options']['end_field']]);
    	                 $calendar_start_timestamp = strtotime($current_date . ' ' . $calendar_data['hour_start'] . ':00:00');
    	                 $calendar_end_timestamp   = strtotime($current_date . ' ' . $calendar_data['hour_end'] . ':00:00');
    	                 
//    	                 debug($event_start_timestamp);
//    	                 debug($event_end_timestamp);
//    	                 debug($calendar_start_timestamp);
//    	                 debug($calendar_end_timestamp);
    	                 
    	                 if($event_start_date > $calendar_start_datetime)
    	                 {
    	                     /*
    	                      * Calculate top-margin if event doesn't start at the top of the calendar
    	                      */
    	                     $hour_difference = ($event_start_timestamp - $calendar_start_timestamp) / 3600;
                			
    	                     $border_height_compensation = $hour_difference / $calendar_data['hour_interval'];
    	                     $top_margin = $hour_difference * $hour_display_height + (0.75 * $border_height_compensation);
    	                 }
    	                 
    	             	 /*
	                      * Check if event has to start at the top of the calendar
	                      */
    	                 $display_start_before  = false;
    	                 if($event_start_timestamp < $calendar_start_timestamp)
    	                 {
    	                     $event_start_timestamp = $calendar_start_timestamp;
    	                     $event_start_date      = $calendar_start_datetime;
    	                     $display_start_before  = true;
    	                 }
    	                 
    	                 /*
	                      * Check if event has to end at the bottom of the calendar
	                      */
    	                 $display_end_after   = false;
    	                 if($event_end_timestamp > $calendar_end_timestamp)
    	                 {
    	                     $event_end_timestamp = $calendar_end_timestamp;
    	                     $event_end_date      = $calendar_end_datetime;
    	                     $display_end_after   = true;
    	                 }
    	                 
    	                 /*
    	                  * Event height
    	                  */
    	                 $hour_difference = ($event_end_timestamp - $event_start_timestamp) / 3600;
    	                 $border_height_compensation = $hour_difference / $calendar_data['hour_interval'];
    	                 $event_height = $hour_difference * $hour_display_height + (0.75 * $border_height_compensation);
    	                 
    	                 /*
    	                  * Infos to display for the event
    	                  */
    	                 $event_title = $event['model'][$event['options']['model_name']][$event['options']['title_field']];
    	                 
    	                 if($display_start_before)
    	                 {
    	                     $display_start_time = '...';
    	                 }
    	                 else
    	                 {
    	                     $display_start_time = $event_start_date->format('H:i');
    	                 }
    	                 
    	                 if($display_end_after)
    	                 {
    	                     $display_end_time = '...';
    	                 }
    	                 else
    	                 {
    	                     $display_end_time   = $event_end_date->format('H:i');
    	                 }
    	                 
    	                 $event_html = '<div class="' . $event['options']['css_class'] . ' event_hour" style="margin-top:' . $top_margin . 'px;height:' . $event_height . 'px"><div class="event_display_time">' . $display_start_time . '</div><div style="height:' . ($event_height-30)  . 'px;">' . $event_title . '</div><div class="event_display_time">' . $display_end_time . '</div></div>';
    	                 $event_html = $this->AlaxosHtml->link($event_html, array('controller' => $controller, 'action' => $action, $id), array('escape' => false));
    	                 
    	                 //debug($event_height);
    	                 if($event_height < 80)
    	                 {
    	                     /*
    	                      * If the event display is not high enough, better to make the event nowrap
    	                      * to have place in width to put the title
    	                      */
    	                     $cell_content['content'] .= '<td nowrap="nowrap">' . $event_html . '</td>';
    	                 }
    	                 else
    	                 {
    	                     $cell_content['content'] .= '<td>' . $event_html . '</td>';
    	                 }
    	             }
    	        }
	        }
	        
	        //debug($current_date);
	        $cell_content['cell_options'] = array('class' => $dates[$current_date]['cell_options']['class']);
	        
	        if(isset($cell_content['content']))
	        {
	            $cell_content['content'] = '<table class="event_aligner" border="0" cellspacing="0" cellpadding="1"><tr>' . $cell_content['content'] . '</tr></table>';
	        }
	         
	        $cells[] = $cell_content;
	    }
	    
	    return $cells;
	}
	
	
	private function get_day_names_cells($calendar_data)
	{
	    $cells = array();
		
		if(isset($calendar_data['day_names']))
		{
			foreach ($calendar_data['day_names'] as $date => $day_name)
			{
				$cell_content = array();
				$cell_content['date']    = $date;
				$cell_content['content'] = $day_name;
				$cell_content['cell_options'] = array('class' => 'dayname');
				$cells[] = $cell_content;
			}
		}
		
		return $cells;
	}
	
	private function get_calendar_cells($calendar_data)
	{
		$dates = $calendar_data['dates'];
	    //debug($dates);
		
		$cells = $this->get_day_names_cells($calendar_data);
		
		foreach ($dates as $date => $date_infos)
		{
			$cell_content = array();
			
			$cell_content['date']         = $date;
			
			if((!isset($this->cell_template) || strlen($this->cell_template) == 0 || strpos($this->cell_template, '{display_date}') === false)
				&& isset($date_infos['display_date']) && strlen($date_infos['display_date']) > 0)
			{
				$cell_content['content'] = '<span class="event_date">' . $date_infos['display_date'] . '</span><br/><br/>';
			}
			
			$cell_content['cell_options'] = array_merge($date_infos['cell_options'], $this->cell_options);
			
			foreach ($cell_content['cell_options'] as $key => $option)
			{
				if(strpos($option, '{date}') !== false)
				{
					$option = str_replace('{date}', $date, $option);
					$cell_content['cell_options'][$key] = $option;
				}
			}
			
			if(isset($date_infos['events']))
			{
				$cell_content['events'] = $date_infos['events'];
				
				foreach ($date_infos['events'] as $event)
				{
					//debug($event);
					$id         = $event['model'][$event['options']['model_name']][$event['options']['id_field']];
					$controller = $event['options']['link_controller'];
					$action     = $event['options']['link_action'];
	
					$event_html = '<div class="' . $event['options']['css_class'] . '">';
					if(isset($event['options']['processed_title_template']) && strlen($event['options']['processed_title_template']) > 0)
					{
						$event_html .= $event['options']['processed_title_template'];
					}
					elseif(isset($event['options']['title_field']) && strlen($event['options']['title_field']) > 0 && isset($event['model'][$event['options']['model_name']][$event['options']['title_field']]))
					{
						$event_html .= $event['model'][$event['options']['model_name']][$event['options']['title_field']];
					}
					else
					{
						$event_html .= '<em>' . __d('alaxos', 'undefined event title', true). '</em>';
					}
					$event_html .= '</div>';
					
					if(isset($cell_content['content']))
					{
						$cell_content['content'] .= $this->AlaxosHtml->link($event_html, array('controller' => $controller, 'action' => $action, $id), array('escape' => false));
					}
					else
					{
						$cell_content['content'] = $this->AlaxosHtml->link($event_html, array('controller' => $controller, 'action' => $action, $id), array('escape' => false));
					}
				}
			}
			
			if(isset($this->cell_template) && strlen($this->cell_template) > 0)
			{
				$template_content = str_replace('{display_date}', $date_infos['display_date'], $this->cell_template);
				$template_content = str_replace('{date}', $date, $template_content);
				
				if(isset($cell_content['content']))
				{
					$template_content = str_replace('{content}', $cell_content['content'], $template_content);
				}
				else
				{
					$template_content = str_replace('{content}', '', $template_content);
				}
				
				$cell_content['content'] = $template_content;
			}
			
			//$cell_content['cell_css_class'] = $date_infos['cell_css_class'];
			
			
			$cells[] = $cell_content;
		}
		
		//debug($cells);
		
		return $cells;
	}

	
	private function get_hour_cells($calendar_data, $display_hour = false)
	{
	    if(isset($calendar_data['hour_start']) && isset($calendar_data['hour_end']))
	    {
	        $cells = array();
	        
	        for($i = $calendar_data['hour_start']; $i <= $calendar_data['hour_end']; $i++)
	        {
	            $cell_content = array();
	            
	            if($display_hour)
	            {
    				$cell_content['content'] = $i;
    				$cell_content['cell_options'] = array('class' => 'hour_display');
	            }
	            
				$cells[] = $cell_content;
	        }
	        
	        return $cells;
	    }
	}
	

}
?>
