<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class StringTool
{
	/**
     * Tests if a string starts with a given string
     *
     * @param     string
     * @param     string
     * @return    bool
     */
    public static function start_with($string, $needle, $case_sensitive = true)
    {
        if($case_sensitive)
        {
            return strpos($string, $needle) === 0;
        }
        else
        {
            return stripos($string, $needle) === 0;
        }
    }
        
    
    /**
     * Tests if a string ends with the given string
     *
     * @param     string
     * @param     string
     * @return    bool
     */
    public static function end_with($string, $needle, $case_sensitive = true)
    {
        if($case_sensitive)
        {
            return strrpos($string, $needle) === strlen($string) - strlen($needle);
        }
        else
        {
            return strripos($string, $needle) === strlen($string) - strlen($needle);
        }
    }
    

    /**
	 * Return the string found between two characters. If an index is given, it returns the
	 * value at the index position
	 *
	 * @param string $opening_char
	 * @param string $closing_char
	 * @param int $index 0 based index
	 * @return string or null
	 */
	public static function get_value_between_chars($haystack, $index = 0, $opening_char = '[', $closing_char = ']')
	{
	    $offset = 0;
	    $found = true;
	    $value = null;
	 
	    for ($i = 0; $i < $index + 1; $i++)
	    {
	        $op_pos = strpos($haystack, $opening_char, $offset);
	        if($op_pos !== false)
	        {
	            $cl_pos = strpos($haystack, $closing_char, $op_pos + strlen($opening_char));
	 
	            if($cl_pos !== false)
	            {
	                $value = substr($haystack, $op_pos + strlen($opening_char), $cl_pos - $op_pos - strlen($opening_char));
	                $offset = $cl_pos + strlen($closing_char);
	            }
	            else
	            {
	                $found = false;
	                break;
	            }
	        }
	        else
	        {
	            $found = false;
	            break;
	        }
	    }
	 
	    if($found)
	    {
	        return $value;
	    }
	    else
	    {
	        return null;
	    }
	}
		
	public static function get_alphanumeric_random_string($length = 10)
	{
	    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    
	    $random_string = '';
	    
	    for($i = 0; $i < $length; $i++)
	    {
	        $index = rand(0, strlen($chars) - 1);
	        $random_string .= $chars{$index};
	    }
	    
	    return $random_string;
	}
	
	/**
     * Ensure a string starts with another given string
     *
     * @param $string The string that must start with a leading string
     * @param $leading_string The string to add at the beginning of the main string if necessary
     * @return string
     */
    public static function ensure_start_with($string, $leading_string)
    {
        if (StringTool :: start_with($string, $leading_string))
        {
            return $string;
        }
        else
        {
            return $leading_string . $string;
        }
    }
    
   /**
    * Ensure a string ends with another given string
    *
    * @param $string The string that must end with a trailing string
    * @param $trailing_string The string to add at the end of the main string if necessary
    * @return string
    */
    public static function ensure_end_with($string, $trailing_string)
    {
        if (StringTool :: end_with($string, $trailing_string))
        {
            return $string;
        }
        else
        {
            return $string . $trailing_string;
        }
    }
    
    
	/**
     * Remove a trailing string from a string if it exists
     * @param $string The string that must be shortened if it ends with a trailing string
     * @param $trailing_string The trailing string
     * @return string
     */
    public static function remove_trailing($string, $trailing_string)
    {
        if (StringTool :: end_with($string, $trailing_string))
        {
            return substr($string, 0, strlen($string) - strlen($trailing_string));
        }
        else
        {
            return $string;
        }
    }
    
    /**
     * Indicates wether the given string is a valid email address
     * @param $email string
     * @return boolean
     */
    public static function is_valid_email($email)
    {
	    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
    }
    

    public static function shorten($string, $max_length = 100, $ellipse = '...', $clever_cut = true)
    {
        if(strlen($string) > $max_length)
        {
            $string = substr($string, 0, $max_length - strlen($ellipse));
            
            if($clever_cut)
            {
                $string = substr($string, 0, strrpos($string, " "));
            }
            
            $string .= $ellipse;
        }
        
        return $string;
    }

}
?>