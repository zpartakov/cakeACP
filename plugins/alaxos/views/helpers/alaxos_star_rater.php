<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AlaxosStarRaterHelper extends HtmlHelper
{
	var $helpers = array('Html', 'AlaxosHtml');
	
	/**
	 * Display a static star rater
	 *
	 * @param $id string The id used to complete html tags id
	 * @param $value number The value to display
	 * @param $options Array	minimum				=>		value of the first star
	 * 							maximum				=>		value of the last star
	 * 							step				=>		step value between two stars
	 * 							display_counter		=>		wether the value must be displayed
	 * 							vote_number			=>		number of votes to display
	 *
	 * @return mixed string | void
	 */
	function display($id, $value = null, $options = array())
	{
	    if($this->isAjax())
	    {
	        $this->AlaxosHtml->include_js_jquery(true);
	        $this->AlaxosHtml->include_js_jquery_no_conflict(true);
	    }
	    else
	    {
	        $this->AlaxosHtml->include_js_jquery();
	        $this->AlaxosHtml->include_js_jquery_no_conflict();
	    }
	    
	    $rater_id        = isset($id)                         ? $id                         : intval(mt_rand());
	    $value           = isset($value)                      ? $value                      : null;
	    
	    $minimum         = isset($options['minimum'])         ? $options['minimum']         : 1;
	    $maximum         = isset($options['maximum'])         ? $options['maximum']         : 5;
	    $step            = isset($options['step'])            ? $options['step']            : 1;
	    $display_counter = isset($options['display_counter']) ? $options['display_counter'] : true;
	    $vote_number     = isset($options['vote_number'])     ? $options['vote_number']     : null;
	    
	    $rater_string = '<div class="alaxos_star_rater" id="alaxos_rater_' . $rater_id . '">';
	    
    	for($i = $minimum; $i <= $maximum; $i = $i + $step)
        {
            $previous_value = $i - $step;
            
            if(isset($value) && $i <= $value)
            {
                $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/yellow_star.gif', array('id' => 'img_' . $i)) . '</span>';
            }
            else
            {
                if($value > $previous_value && $value < $i)
                {
                    if($value - $previous_value > ($i - $previous_value)/4 && $value - $previous_value < 3*($i - $previous_value)/4)
                    {
                        $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/half_star.gif', array('id' => 'img_' . $i)) . '</span>';
                    }
                    elseif($value - $previous_value <= ($i - $previous_value)/4)
                    {
                        $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/white_star.gif', array('id' => 'img_' . $i)) . '</span>';
                    }
                    else
                    {
                        $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/yellow_star.gif', array('id' => 'img_' . $i)) . '</span>';
                    }
                }
                else
                {
                    $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/white_star.gif', array('id' => 'img_' . $i)) . '</span>';
                }
            }
        }
        
        if($display_counter)
        {
            if(isset($value))
    	    {
    	        $rater_string .= ' <span id="alaxos_rater_total_' . $rater_id . '">' . round($value, 2) . '</span> / ' . $maximum;
    	    }
    	    else
    	    {
    	        $rater_string .= ' <span id="alaxos_rater_total_' . $rater_id . '">-</span> / ' . $maximum;
    	    }
        }
	    
        if(isset($vote_number))
        {
           $rater_string .= ' (' . $options['vote_number'] . ' ' . ($options['vote_number'] > 1 ? __d('alaxos', 'votes', true) : __d('alaxos', 'vote', true)) . ')';
        }
        
	    $rater_string .= '</div>';
	    
	    return $rater_string;
	}
	
	/**
	 * Display a usable star rater
	 *
	 * The value selected is put in a hidden field that can be then submitted.
	 *
	 * @param $name string The name of the hidden field containing the selected value
	 * @param $default_value number The selected value when the form is printed out
	 * @param $options Array	minimum				=>		value of the first star
	 * 							maximum				=>		value of the last star
	 * 							step				=>		step value between two stars
	 * 							display_counter		=>		wether the value must be displayed
	 *
	 * @return mixed string | void
	 */
	function rate($name, $default_value = null, $options = array())
	{
	    if($this->isAjax())
	    {
	        $this->AlaxosHtml->include_js_jquery(true);
	        $this->AlaxosHtml->include_js_jquery_no_conflict(true);
	    }
	    else
	    {
	        $this->AlaxosHtml->include_js_jquery();
	        $this->AlaxosHtml->include_js_jquery_no_conflict();
	    }
	    
	    $rater_id        = isset($name)                       ? $name                       : intval(mt_rand());
	    $minimum         = isset($options['minimum'])         ? $options['minimum']         : 1;
	    $maximum         = isset($options['maximum'])         ? $options['maximum']         : 5;
	    $step            = isset($options['step'])            ? $options['step']            : 1;
	    $display_counter = isset($options['display_counter']) ? $options['display_counter'] : true;
	    $default_value   = isset($default_value)              ? $default_value              : $minimum;
	    
	    $rater_string = '<div class="alaxos_star_rater" id="alaxos_rater_' . $rater_id . '">';
	    
	    if(isset($options['label']))
	    {
	        $rater_string .= '<span class="star_rater_title">' . $options['label'] . '</span>: ';
	    }
	    
	    for($i = $minimum; $i <= $maximum; $i = $i + $step)
        {
            $previous_value = $i - $step;
            
            if(isset($default_value) && $i <= $default_value)
            {
                $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/yellow_star.gif', array('id' => $rater_id . '_img_' . $i)) . '</span>';
            }
            else
            {
                if($default_value > $previous_value && $default_value < $i)
                {
                    if($default_value - $previous_value > ($i - $previous_value)/4 && $default_value - $previous_value < 3*($i - $previous_value)/4)
                    {
                        $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/half_star.gif', array('id' => $rater_id . '_img_' . $i)) . '</span>';
                    }
                    elseif($default_value - $previous_value <= ($i - $previous_value)/4)
                    {
                        $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/white_star.gif', array('id' => $rater_id . '_img_' . $i)) . '</span>';
                    }
                    else
                    {
                        $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/yellow_star.gif', array('id' => $rater_id . '_img_' . $i)) . '</span>';
                    }
                }
                else
                {
                    $rater_string .= '<span id="' . $rater_id . '_' . $i . '">' . $this->Html->image('/alaxos/img/stars/white_star.gif', array('id' => $rater_id . '_img_' . $i)) . '</span>';
                }
            }
        }
	    
        if($display_counter)
        {
    	    if(isset($default_value))
    	    {
    	        $rater_string .= ' <span id="alaxos_rater_total_' . $rater_id . '">' . round($default_value, 2) . '</span> / ' . $maximum;
    	        $rater_string .= '<input type="hidden" name="' . $name . '" id="alaxos_rater_value_' . $rater_id . '" value="' . $default_value . '" />';
    	    }
    	    else
    	    {
    	        $rater_string .= ' <span id="alaxos_rater_total_' . $rater_id . '">-</span> / ' . $maximum;
    	        $rater_string .= '<input type="hidden" name="' . $name . '" id="alaxos_rater_value_' . $rater_id . '" value="" />';
    	    }
        }
	    
	    $rater_string .= '</div>';
	    
	    $rater_string .= $this->add_rate_js($rater_id);
	    
	    return $rater_string;
	}
	
	
	function add_rate_js($rater_id = null)
	{
	    $js = array();
	    $js[] = '$j("#alaxos_rater_' . $rater_id . '").mouseout(function()';
	    $js[] = '{';
	    $js[] = '	set_alaxos_rater_value_' . $rater_id . '("' . $rater_id . '");';
	    $js[] = '});';
	    $js[] = '';
	    $js[] = '$j("#alaxos_rater_' . $rater_id . ' span img").css("cursor", "pointer");';
	    $js[] = '$j("#alaxos_rater_' . $rater_id . ' span img").hover(';
	    $js[] = '	function()';
	    $js[] = '	{';
	    $js[] = '		hover_id = $j(this).attr("id");';
	    $js[] = '		hover_value = hover_id.substring("' . $rater_id . '_img_".length);';
	    $js[] = '		set_alaxos_rater_value_' . $rater_id . '("' . $rater_id . '", hover_value);';
	    $js[] = '		$j(this).attr("src", "' . $this->url('/alaxos/img/stars/yellow_star.gif') . '");';
	    $js[] = '	},';
	    $js[] = '	function()';
	    $js[] = '	{';
	    $js[] = '		//set_alaxos_rater_value_' . $rater_id . '("' . $rater_id . '");';
	    $js[] = '	});';
	    $js[] = '';
	    $js[] = '';
	    $js[] = '$j("#alaxos_rater_' . $rater_id . ' span img").click(function()';
	    $js[] = '{';
	    $js[] = '	img_value = $j(this).attr("id").substring("' . $rater_id . '_img_".length);';
	    $js[] = '	$j("#alaxos_rater_value_' . $rater_id . '").val(img_value);';
	    $js[] = '	$j("#alaxos_rater_total_' . $rater_id . '").html(img_value);';
	    $js[] = '});';
	    $js[] = '';
	    $js[] = '';
	    $js[] = 'function set_alaxos_rater_value_' . $rater_id . '(identifier, value)';
	    $js[] = '{';
	    $js[] = '';
	    $js[] = '	if(value == null)';
	    $js[] = '	{';
	    $js[] = '		val = $j("#alaxos_rater_value_' . $rater_id . '").val();';
	    $js[] = '		if(val != null && val.length > 0)';
	    $js[] = '		{';
	    $js[] = '			value = val;';
	    $js[] = '		}';
	    $js[] = '		else';
	    $js[] = '		{';
	    $js[] = '			value = null;';
	    $js[] = '		}';
	    $js[] = '	}';
	    $js[] = '		';
	    //$js[] = '	$j("#alaxos_debug").html("set_alaxos_rater_value_' . $rater_id . '("+identifier+", "+value+")");';
	    $js[] = '		';
	    $js[] = '	$j.each($j("#alaxos_rater_" + identifier + " span img"), function(i, l)';
	    $js[] = '		{';
	    $js[] = '			img_value = $j(this).attr("id").substring("' . $rater_id . '_img_".length)';
	    $js[] = '			if(img_value <= value)';
	    $js[] = '			{';
	    $js[] = '				$j(this).attr("src", "' . $this->url('/alaxos/img/stars/yellow_star.gif') . '");';
	    $js[] = '			}';
	    $js[] = '			else';
	    $js[] = '			{';
	    $js[] = '				$j(this).attr("src", "' . $this->url('/alaxos/img/stars/white_star.gif') . '");';
	    $js[] = '			}';
	    $js[] = '		});';
	    $js[] = '';
	    $js[] = '	if(value != null)';
	    $js[] = '	{';
	    $js[] = '		$j("#alaxos_rater_total_' . $rater_id . '").html(value);';
	    $js[] = '	}';
	    $js[] = '	else';
	    $js[] = '	{';
	    $js[] = '		$j("#alaxos_rater_total_' . $rater_id . '").html("-");';
	    $js[] = '	}';
	    $js[] = '}';
	    
	   // debug(implode("\r\n", $js));
	    
	    return '<script type="text/javascript">' . implode("\r\n", $js) . '</script>';
	}
	
	/*
     * Check if the query is an Ajax query
     */
    function isAjax()
    {
		return $this->AlaxosHtml->isAjax();
	}
	
}
?>