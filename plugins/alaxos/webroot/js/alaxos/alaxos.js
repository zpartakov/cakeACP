/********************************************************************
 * Author: Nicolas Rod, nico@alaxos.com 
 * website: www.alaxos.com, www.alaxos.ch
 */

/********************************************************************
 * Global constants 
 */
var INVALID_DATE             = "INVALID_DATE";
var INVALID_DATE_FIELD_COLOR = "#ff0000";
var INVALID_DATE_TEXT_COLOR  = "#ffffff";

/********************************************************************
 * Global variables 
 */
var valid_field_colors = new Array();

/********************************************************************
 * Number fields 
 */

function format_number(textbox, is_float)
{
	var valid_numeric_chars = "0123456789";
	if(is_float)
	{
		valid_numeric_chars += ".";
	}

	value = textbox.value;
	
	newvalue = "";
	non_numeric_found = false;
	dot_found = false;
	var i;
	for(i = 0; i < value.length; i++)
	{
		if(valid_numeric_chars.indexOf(value.charAt(i)) != -1)
		{
			if(dot_found == false || value.charAt(i) != ".")
			{
				newvalue += value.charAt(i);
			}
			
			if(value.charAt(i) == ".")
			{
				dot_found = true;
				non_numeric_found = true; 
			}
		}
		else
		{
			non_numeric_found = true;
		}
	}
	
	if(non_numeric_found)
	{
		textbox.value = newvalue;
	}
}

/********************************************************************
 * Date fields
 */

function format_date(textbox)
{
	 if(valid_field_colors[textbox] == null)
	 {
		 valid_field_colors[textbox]					= new Array();
		 valid_field_colors[textbox]['backgroundColor'] = textbox.style.backgroundColor;
		 valid_field_colors[textbox]['color']           = textbox.style.color;
	 }
	 
	value = textbox.value;

	if(value == null || value.length == 0)
	{
		return;
	}
	
	separator1 = '';
	separator2 = '';
	value1 = '';
	value2 = '';
	value3 = '';

	previous_value = '';
	typed_index = 0;
	var i;
	for(i = 0; i < value.length; i++)
	{
		current_char = value.charAt(i);
		
		if(i == 0 || (previous_value == ' ' && !isNaN(current_char)) || (current_char == ' ' && !isNaN(previous_value)) || (isNaN(current_char) && !isNaN(previous_value)) || (!isNaN(current_char) && isNaN(previous_value)))
		{
			//change from number to separator or from separator to number
			typed_index++;

			//manage the case of a value starting with a separator
			if(i == 0 && isNaN(current_char))
			{
				typed_index = 2;
			}
		}

		switch(typed_index)
		{
			case 1:
				value1 += '' + current_char;
				break;

			case 2:
				separator1 += '' + current_char;
				break;

			case 3:
				value2 += '' + current_char;
				break;

			case 4:
				separator2 += '' + current_char;
				break;

			case 5:
				value3 += '' + current_char;
				break;
		}

		previous_value = current_char;
	}

	/*
	 * Note: date_format is globally scoped
	 */
	
	date_value = get_formatted_date(value1, value2, value3, date_format);
	
	if(date_value != INVALID_DATE)
	{
		textbox.value = get_formatted_date(value1, value2, value3, date_format);
		textbox.style.backgroundColor = valid_field_colors[textbox]['backgroundColor'];
		textbox.style.color = valid_field_colors[textbox]['color'];
	}
	else
	{
		textbox.style.backgroundColor = INVALID_DATE_FIELD_COLOR;
		textbox.style.color           = INVALID_DATE_TEXT_COLOR;
	}
}

function get_formatted_date(value1, value2, value3, date_format)
{
	date_part1 = date_format.substring(0, 1);
	separator1 = date_format.substring(1, 2);
	date_part2 = date_format.substring(2, 3);
	separator2 = date_format.substring(3, 4);
	date_part3 = date_format.substring(4, 5);
	
	date_part_value1 = get_date_part_value(value1, date_part1);
	date_part_value2 = get_date_part_value(value2, date_part2);
	date_part_value3 = get_date_part_value(value3, date_part3);

	day = null;
	month = null;
	year = null;
	switch(date_part1)
	{
		case 'd':
			day = date_part_value1;
			break;
		case 'm':
			month = date_part_value1;
			break;
		case 'y':
			year = date_part_value1;
			break;
	}
	switch(date_part2)
	{
		case 'd':
			day = date_part_value2;
			break;
		case 'm':
			month = date_part_value2;
			break;
		case 'y':
			year = date_part_value2;
			break;
	}
	switch(date_part3)
	{
		case 'd':
			day = date_part_value3;
			break;
		case 'm':
			month = date_part_value3;
			break;
		case 'y':
			year = date_part_value3;
			break;
	}
	
	if(!check_date_validity(day, month, year))
	{
		return INVALID_DATE;
	}
	else
	{	
		return date_part_value1 + separator1 + date_part_value2 + separator2 + date_part_value3;
	}
}

function get_date_part_value(value, date_part)
{
	switch(date_part)
	{
		case 'd':
			return get_checked_day(value);
			break;
		case 'm':
			return get_checked_month(value);
			break;
		case 'y':
			return get_checked_year(value);
			break;
	}
}

function get_checked_day(value)
{
	day = null;
	if(value != null && value.length > 0 && !isNaN(value) && value >= 1 && value <= 31)
	{
		day = value;
	}
	else
	{
    	date = new Date();
    	day = date.getDate();
	}

	if(day < 10 && day.length != 2)
	{
		day = day * 1; //manage the case of leading zeros (e.g. '0007')
		day = '0' + day;
	}

	return day;
}

function get_checked_month(value)
{
	month = null;
	if(value != null && value.length > 0 && !isNaN(value) && value >= 1 && value <= 12)
	{
		month = value;
	}
	else
	{
    	date = new Date();
    	month = date.getMonth();
    	month = month + 1;
	}

	if(month < 10 && month.length != 2)
	{
		month = month * 1; //manage the case of leading zeros (e.g. '0007')
		month = '0' + month;
	}

	return month;
}

function get_checked_year(value)
{
	if(value != null && value.length > 0 && !isNaN(value))
	{
		complete_year = get_complete_year(value);

		current_date = new Date();
		current_year = current_date.getYear();
		year_diff = complete_year - current_year - 1900;

		if(year_diff > 15)
		{
			return get_complete_year(complete_year - 100);
		}
		else
		{
			return complete_year;
		}
	}
	else
	{
    	date = new Date();
    	year = date.getYear();
    	return year + 1900;
	}
}

function get_complete_year(year)
{
	date = new Date(year, 1, 1);

	full_date = date.getFullYear();

	if(year.length < 4 && full_date < 2000)
	{
		full_date += 100;
	}
	
	return full_date;
}

function check_date_validity(day, month, year)
{
	//alert(year + "-" + month + "-" + day);
	if(month == 2 && day > 28)
	{
		return is_bissextile(year);
	}
	else
	{
		if(!isNaN(day) && day > 0 && day < 31)
		{
			return true;
		}
		else if(day == 31)
		{
			if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12)
			{
				return true;
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
}

function is_bissextile (year)
{
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0));
}

/********************************************************************
 * Start alaxos functions
 */
$j(document).ready(function(){
	
	$j(".inputDate").bind("blur", function(e){
				format_date(this);
			});
	
	$j(".inputFloat").bind("keyup", function(e){
				format_number(this, true);
			});
	
	$j(".inputInteger").bind("keyup", function(e){
				format_number(this, false);
			});
	
	/*
	 * Add double click to administrations lists if a link with id="detail" exists in the row
	 */
	$j("table.administration > tbody > tr").each(function(i){

		if($j("#detail", this).length > 0)
		{
			$j(this).bind("dblclick", function(){

				window.location = $j("#detail", this).attr("href");
				
			});	
		}
	});
	
	/*
	 * Add check before submit on actions on all selected records in admin lists 
	 */
	$j('#chooseActionForm').submit(function() {
		 
		var action = $j('#ActionToPerform').val();
		
		if(action == "deleteAll")
		{
			var ok = confirm(confirmDeleteAllText);
		}
		else if(action == "")
		{
			alert(pleaseChooseActionToPerformText);
			return false;
		}
		
		return ok;
	});
	
	
});

