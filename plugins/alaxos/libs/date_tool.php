<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class DateTool
{
	/**
	 * Format a date according to the current locale
	 *
	 * @param $sql_date An SQL formatted date
	 * @param $locale string The locale to use. If no locale is given, the current locale is used
	 * @param $with_time boolean Indicates wether the time part must be added if present
	 * @return string A date formatted according to the current locale
	 */
	public static function sql_to_date($sql_date, $locale = null, $with_time = true)
	{
		$sql_date = trim($sql_date);
		
		if(strlen($sql_date) == 0 || $sql_date == '0000-00-00')
		{
			return null;
		}
		
		if($with_time && strpos($sql_date, ' ') !== false)
		{
			$format = DateTool :: get_datetime_format($locale);
		}
		else
		{
			$format = DateTool :: get_date_format($locale);
		}
		
		return date($format, strtotime($sql_date));
	}
	
	
	/**
	 * Format a given date to an SQL formatted date.
	 *
	 * @param $date string The date to format
	 * @param $locale string The locale in which the date is formatted. If no locale is given, the current locale is used
	 * @param $with_time boolean Indicates wether the time part must be added if present
	 * @return string
	 */
	public static function date_to_sql($date, $locale = null, $with_time = true)
	{
		$date = trim($date);
		
		if($with_time && strpos($date, ' ') !== false)
		{
			return DateTool :: datetime_to_sql($date, $locale);
		}
		else
		{
			$format = DateTool :: get_date_format($locale);
		}
		
		$format = str_replace('Y', '%Y', $format);
		$format = str_replace('m', '%m', $format);
		$format = str_replace('d', '%d', $format);

		$date_array = strptime($date, $format);
		
		if($date_array !== false)
		{
			$day   = sprintf("%02d", $date_array['tm_mday']);
			$month = sprintf("%02d", $date_array['tm_mon'] + 1);
			$year  = DateTool :: get_complete_year(1900 + $date_array['tm_year']);
			
			return $year . '-' . $month . '-' . $day;
		}
		else
		{
			return null;
		}
	}
	
	function format_date_interval($dateStr, $separator = ' - ', $locale = null)
    {
    	$dateStr = trim($dateStr);
    	
    	$separator_pos = strpos($dateStr, $separator);
    	if($separator_pos !== false)
    	{
			$first_date  = substr($dateStr, 0, $separator_pos);
    		$second_date = substr($dateStr, $separator_pos + strlen($separator));
    		
    		return DateTool :: sql_to_date($first_date, $locale) . ' - ' . DateTool :: sql_to_date($second_date, $locale);
    	}
    	else
    	{
    		return DateTool :: sql_to_date($dateStr, $locale);
    	}
    }
	
	
	/**
	 * Get the current locale format to parse/format a date string
	 * @return string
	 */
	public static function get_date_format($locale = null)
	{
		if(!isset($locale))
		{
			$locale = strtolower(DateTool :: get_current_locale());
		}
		
		switch($locale)
		{
			case 'fr_ch':
			case 'fr_ch.utf-8':
			case 'fr_fr':
			case 'fr_fr.utf-8':
				return 'd.m.Y';
				break;
				
			case 'en_en':
			case 'en_us':
			case 'en_en.utf-8':
			case 'en_us.utf-8':
				return 'Y-m-d';
				break;
				
			default:
				return 'Y-m-d';
		}
	}
	
	
	/*********************************************************************************************/
	
	public static function sql_to_datetime($sql_date, $locale = null)
	{
		$sql_date = trim($sql_date);
		
		if(strlen($sql_date) == 0 || $sql_date == '0000-00-00' || $sql_date == '0000-00-00 00:00:00')
		{
			return null;
		}
		
		$format = DateTool :: get_datetime_format($locale);
		
		return date($format, strtotime($sql_date));
	}
	
	public static function datetime_to_sql($date, $locale = null, $force_datetime = false)
	{
		$date = trim($date);
		
		$format = DateTool :: get_datetime_format($locale);
		
		/*
		 * Check if the $date should be parsed as a date and not a datetime
		 */
		if(!$force_datetime && stripos($format, ' ') !== false && stripos($date, ' ') === false)
		{
			return DateTool :: date_to_sql($date, $locale);
		}
		else
		{
			if($force_datetime && stripos($date, ' ') === false)
			{
				$date .= ' 00:00:00';
			}
			
			$format = str_replace('Y', '%Y', $format);
			$format = str_replace('m', '%m', $format);
			$format = str_replace('d', '%d', $format);
			$format = str_replace('H', '%H', $format);
			$format = str_replace('i', '%M', $format);
			$format = str_replace('s', '%S', $format);
			
			$date_array = strptime($date, $format);
			
			if($date_array !== false)
			{
				$day   = sprintf("%02d", $date_array['tm_mday']);
				$month = sprintf("%02d", $date_array['tm_mon'] + 1);
				$year  = 1900 + $date_array['tm_year'];
				
				$hour  = sprintf("%02d", $date_array['tm_hour']);
				$min   = sprintf("%02d", $date_array['tm_min']);
				$sec   = sprintf("%02d", $date_array['tm_sec']);
				
				return $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $min . ':' . $sec;
			}
			else
			{
				return null;
			}
		}
	}
	
	public static function get_datetime_format($locale = null)
	{
		if(!isset($locale))
		{
			$locale = strtolower(DateTool :: get_current_locale());
		}
		
		switch($locale)
		{
			case 'fr_ch':
			case 'fr_ch.utf-8':
			case 'fr_fr':
			case 'fr_fr.utf-8':
				return 'd.m.Y H:i:s';
				
			case 'en_en':
			case 'en_us':
			case 'en_en.utf-8':
			case 'en_us.utf-8':
			case 'sql':
				return 'Y-m-d H:i:s';
				
			default:
				return 'Y-m-d H:i:s';
		}
	}
	
	public static function get_current_datetime($locale = null)
	{
	    return DateTool :: sql_to_datetime(date(DateTool :: get_datetime_format($locale)), $locale);
	}
	
	
	/*********************************************************************************************/
	
	/**
	 * Format a time according to the current locale
	 *
	 * @param $sql_date An SQL formatted date
	 * @param $locale string The locale to use. If no locale is given, the current locale is used
	 * @return string A time formatted according to the given locale
	 */
	public static function sql_to_time($sql_date, $locale = null)
	{
		$sql_date = trim($sql_date);
		
		if(strlen($sql_date) == 0 || $sql_date == '0000-00-00' || $sql_date == '0000-00-00 00:00:00')
		{
			return null;
		}
		
		$format = DateTool :: get_time_format($locale);
		
		return date($format, strtotime($sql_date));
	}
	
	function get_time_format($locale = null)
    {
    	if(!isset($locale))
		{
			$locale = strtolower(DateTool :: get_current_locale());
		}
		
    	$locale = strtolower($locale);
    	
    	switch($locale)
    	{
    		case 'fr_ch':
    		case 'fr_ch.utf-8':
    		case 'fr_fr':
    			return 'H:i:s';
    		
    		case 'en_en':
			case 'en_us':
			case 'en_en.utf-8':
			case 'en_us.utf-8':
				return 'H:i:s';
				
    		default:
    			return 'H:i:s';
    	}
    }
	
	
	/**
	 * Complete timeStr if necessary
	 *
	 * 3        -> 03:00:00
	 * 16:35    -> 16:35:00
	 * 16:35:34 -> 16:35:34
	 *
	 * @param $timeStr
	 * @return unknown_type
	 */
	public static function get_complete_time($timeStr)
	{
	    $timeStr = trim($timeStr);
	    
	    $time_array = explode(':', $timeStr);
	    
	    $timeStr = '';
	    
	    for($i = 0; $i < 3; $i++)
	    {
	        if(array_key_exists($i, $time_array))
	        {
	            $time_part = $time_array[$i];
	        }
	        else
	        {
	            $time_part = '00';
	        }
	        
	        $timeStr .= sprintf('%02d', $time_part);
	        
	        if($i < 2)
	        {
	            $timeStr .= ':';
	        }
	    }
	    
	    //debug($timeStr);
	    
//		$timeStr = trim($timeStr);
//
//		if(substr_count($timeStr, ':') == 0)
//		{
//			$timeStr .= ':00:00';
//		}
//		elseif(substr_count($timeStr, ':') == 1)
//		{
//			$timeStr .= ':00';
//		}
		
		return $timeStr;
	}
	
	
	/**
	 * Complete timeStr if necessary
	 *
	 * 3        -> 03:00:00
	 * 16:35    -> 16:35:00
	 * 16:35:34 -> 16:35:34
	 *
	 * @param $timeStr
	 * @return unknown_type
	 */
	public static function get_complete_datetime($timeStr)
	{
	    $timeStr = trim($timeStr);
	    
	    if(substr_count($timeStr, ' ') > 0)
	    {
	        $date = substr($timeStr, 0, strpos($timeStr, ' '));
	        $time = DateTool :: get_complete_time(substr($timeStr, strpos($timeStr, ' ')));
	        
	        return $date . ' ' . $time;
	    }
	    else
	    {
	        return $timeStr . ' 00:00:00';
	    }
	}
	
	public static function get_complete_year($year)
	{
		$year_num = (int)$year;

		if($year_num < 100)
		{
			$current_year = date('y') + 100;
			
			if($current_year - $year_num > 80)
			{
				$year_num += 2000;
			}
			else
			{
				$year_num += 1900;
			}
		}
		
		return $year_num;
	}
	
	
	/**
	 * Return a formatted time string from a number of hours
	 * @param $hour float
	 * @return string
	 */
	public static function get_time_from_hour($hour)
	{
	    $date = new Datetime();
        $date->setTime(floor($hour), ($hour - floor($hour)) * 60, 0);
        return $date->format('H:i');
	}
	
	
	public static function get_hour_as_float($time_string)
	{
		if(stripos($time_string, ' ') !== false)
		{
			$time_string = substr($time_string, stripos($time_string, ' '));
		}
		
		$hour_array = explode(':', $time_string);
		$hour = $hour_array[0];
		$min  = isset($hour_array[1]) ? $hour_array[1] : 0;
		$sec  = isset($hour_array[2]) ? $hour_array[2] : 0;
		
		return $hour + $min / 60 + $sec / 3600;
	}
	
	
	/**
	 *
	 * @param float $start_hour
	 * @param float $end_hour
	 * @param float $step_hour
	 * @return array
	 */
	public static function get_time_array($start_hour, $end_hour, $step_hour, $minimum_hour = null, $maximum_hour = null, $locale = null)
	{
		if(!is_numeric($start_hour) && !is_numeric($end_hour) && $step_hour > 0)
		{
			$sql_date1 = DateTool :: datetime_to_sql($start_hour, $locale);
			$sql_date2 = DateTool :: datetime_to_sql($end_hour, $locale);
			
//			debug($sql_date1);
//			debug($sql_date2);
			
			$timestamp1 = strtotime($sql_date1);
			$timestamp2 = strtotime($sql_date2);
			
			$hour_difference = ($timestamp2 - $timestamp1) / 3600;
			
			//debug($hour_difference);
			
			$start_hour = DateTool :: get_hour_as_float($start_hour);
		}
	    elseif(is_numeric($start_hour) && is_numeric($end_hour) && $start_hour < $end_hour && $step_hour > 0)
	    {
    	    $hour_difference = $end_hour - $start_hour;
    	    
    	    //debug($hour_difference);
	    }

	    if(isset($hour_difference))
	    {
	    	//debug($hour_difference);
	    	
    	    $times = array();
    	    $current_time = $start_hour;
    	    $end_hour = $start_hour + $hour_difference;
    	    
    	    //debug($end_hour);
    	    
    	    while($current_time < $end_hour)
    	    {
    	    	if(isset($minimum_hour) && isset($maximum_hour))
    	    	{
    	    		if($minimum_hour <= $current_time &&  $current_time < $maximum_hour)
    	    		{
    	    			$times[] = DateTool :: get_time_from_hour($current_time);
    	    		}
    	    	}
    	    	elseif(!isset($minimum_hour) && isset($maximum_hour))
    	    	{
    	    		if($current_time < $maximum_hour)
    	    		{
    	    			$times[] = DateTool :: get_time_from_hour($current_time);
    	    		}
    	    		else
    	    		{
    	    			/*
    	    			 * Max time has been overcome
    	    			 */
    	    			break;
    	    		}
    	    	}
    	    	elseif(isset($minimum_hour) && !isset($maximum_hour))
    	    	{
    	    		if($minimum_hour <= $current_time)
    	    		{
    	    			$times[] = DateTool :: get_time_from_hour($current_time);
    	    		}
    	    	}
    	    	else
    	    	{
    	    		$times[] = DateTool :: get_time_from_hour($current_time);
    	    	}
    	    	
    	        $current_time += $step_hour;
    	    }
    	    
    	    //debug($times);
    	    
    	    return $times;
	    }
	    
	}
	
	
	/*********************************************************************************************/
	
	public static function compare_dates($date1, $date2, $locale = null)
	{
	    //debug($date1 . ' <---> ' . $date2);
	    
		$sql_date1 = DateTool :: datetime_to_sql($date1, $locale);
		$sql_date2 = DateTool :: datetime_to_sql($date2, $locale);
		
		//debug($sql_date1 . ' <---> ' . $sql_date2);
		
		$timestamp1 = strtotime($sql_date1);
		$timestamp2 = strtotime($sql_date2);
		
		if($timestamp1 == $timestamp2)
		{
			return '=';
		}
		elseif($timestamp1 > $timestamp2)
		{
			return '>';
		}
		elseif($timestamp1 < $timestamp2)
		{
			return '<';
		}
	}
	
	
	/**
	 *
	 * @param string $start_datetime
	 * @param string $end_datetime
	 * @param string $datetime_to_check
	 * @return bool Indicates wether the time to check is between the two given times
	 */
	public static function datetime_is_in_interval($start_datetime, $end_datetime, $datetime_to_check = null, $locale = 'sql')
	{
	    if(!isset($datetime_to_check))
	    {
	        $datetime_to_check = DateTool :: get_current_datetime($locale);
	    }
	    
	    $start_datetime    = DateTool :: get_complete_datetime($start_datetime);
	    $end_datetime      = DateTool :: get_complete_datetime($end_datetime);
	    $datetime_to_check = DateTool :: get_complete_datetime($datetime_to_check);
	    
	    $comparison1 = DateTool :: compare_dates($start_datetime, $datetime_to_check, $locale);
	    $comparison2 = DateTool :: compare_dates($datetime_to_check, $end_datetime, $locale);
	    
	    if(
	        ($comparison1 == '<' || $comparison1 == '=')
	        &&
	        ($comparison2 == '<')
	       )
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
	
	
	/*********************************************************************************************/
	
	/**
	 * Set the PHP locale and set the CakePHP language
	 *
	 * @param $locale mixed string or array of string
	 * @return string the new current locale
	 */
	public static function set_current_locale($locale)
	{
		if(isset($locale))
		{
			if(is_string($locale))
			{
				$locale = strtolower($locale);
				
				/*
				 * Depending on the server configuration, the locale that the method 'setlocale()'
				 * is waiting for may be different.
				 *
				 * But as the 'setlocale()' can take an array of strings, we try to pass
				 * an array instead of a string
				 */
				switch($locale)
				{
					case 'fr':
        	        case 'fre':
        	        case 'fren':
        	        case 'french':
        	        case 'fr_ch':
        	        case 'fr_fr':
        	        case 'fr_ch.utf-8':
        	        case 'fr_fr.utf-8':
        	        case 'fr-ch':
        	        case 'fr-fr':
        	        case 'fr-ch.utf-8':
        	        case 'fr-fr.utf-8':
						$locale = array('fr_CH.UTF-8', 'fr_CH', 'fr_FR.UTF-8', 'fr_FR');
						break;
	
					case 'en':
					case 'eng':
					case 'english':
					case 'en_en':
					case 'en_us':
					case 'en_us.utf-8':
					case 'en_en.utf-8':
					case 'en-en':
					case 'en-us':
					case 'en-us.utf-8':
					case 'en-en.utf-8':
						$locale = array('en_US.UTF-8', 'en_US', 'en_EN.UTF-8', 'en_EN');
						break;
						
					default:
						$locale = array($locale);
						break;
				}
			}
			
			$new_locale = setlocale(LC_ALL, $locale);
			
			//debug($new_locale);
			
			if(stripos(strtolower($new_locale), 'utf-8') !== false)
			{
				header('Content-Type: text/html; charset=UTF-8');
			}
			
			
			if(StringTool :: start_with(strtolower($new_locale), 'fr_'))
			{
				Configure::write('Config.language', "fr");
			}
			elseif(StringTool :: start_with(strtolower($new_locale), 'en_'))
			{
				Configure::write('Config.language', "en");
			}
			
			return $new_locale;
		}
	}
	
	
	/**
	 *
	 * @return string The current locale code
	 */
	public static function get_current_locale()
	{
		return setlocale(LC_ALL, '0');
	}
	
	
	/*********************************************************************************************/
	
	
}
?>
