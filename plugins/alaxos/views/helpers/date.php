<?php
/**
 *
 * @deprecated Use DateTool static functions instead
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class DateHelper extends AppHelper
{
    function format_date($dateStr, $returnValue = false, $locale = null)
    {
    	$formatted_date = DateTool :: sql_to_date($dateStr, $locale, false);
    	
    	if($returnValue)
		{
			return $formatted_date;
		}
		else
		{
			e($formatted_date);
		}
    }
    
	function format_datetime($dateStr, $returnValue = false, $locale = null)
    {
    	$formatted_date = DateTool :: sql_to_datetime($dateStr, $locale);
    	
    	if($returnValue)
		{
			return $formatted_date;
		}
		else
		{
			e($formatted_date);
		}
    }
 
	function format_time($dateStr, $returnValue = false, $locale = null)
    {
    	$dateStr = DateTool :: sql_to_time($dateStr, $locale);

    	if($returnValue)
		{
			return $dateStr;
		}
		else
		{
			e($dateStr);
		}
    }
    
    function format_date_interval($dateStr, $returnValue = false, $separator = ' - ', $locale = null)
    {
    	$dateStr = DateTool :: format_date_interval($dateStr, $separator, $locale);
    	
    	if($returnValue)
		{
			return $dateStr;
		}
		else
		{
			e($dateStr);
		}
    }
    
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

}
?>
