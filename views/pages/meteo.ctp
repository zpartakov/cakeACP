<style>
#forecast {
		width: 470px;
		border-top: 4px solid #e3e7e7;
		}
#forecast p {
		clear: both;
		width: 100%;
		margin: 0;
		}
#forecast span {
		float: left;
		padding: 0 10px;
		border-left: 1px solid #e3e7e7;
		border-bottom: 1px solid #e3e7e7;
		}
#forecast span.forecast_1 {
		width: 110px;
		}

	#forecast span.forecast_2 {
		width: 186px;
		}
	#forecast span.forecast_3 {
		width: 186px;
		}
	
	#forecast span.forecast_4 {
		width: 110px;
		border-right: 1px solid #e3e7e7;
		}

</style>
<?php
#Configure::write('debug', 2);


function writeln($string)
{
    echo "{$string}\r\n";
}

function convert($temp)
{
    // Converting Fahrenheit To Celsius, vice versa
    global $config;
    $temperature = $temp;

    if( strtoupper($config['base-temp-unit']) == 'F' && strtoupper($config['display-temp-unit']) == 'C' )
    {
        // Converting Fahrenheit To Celsius
        $temperature = round((5/9)*($temp-32));
    }
    if( strtoupper($config['base-temp-unit']) == 'C' && strtoupper($config['display-temp-unit']) == 'F' )
    {
        // Converting Celsius to Fahrenheit
        $temperature = round((9/5)*$temp+32);

    }
        $temperature = round((5/9)*($temp-32));

    return $temperature;
}



$url = "http://www.google.com";
$location = "genève,suisse"; // <city>,<country code>

$weather_url = "{$url}/ig/api?weather={$location}";
$config['base-temp-unit'] = 'C'; // F=Fahrenheit, C=Celsius
$config['display-temp-unit'] = 'C'; // F=Fahrenheit, C=Celsius


if( $xmlData = file_get_contents($weather_url) )
{
	
    $xml = new SimpleXMLElement(utf8_encode($xmlData));
   
    $eol = "\r\n";
   
    // Display basic information
    // Display basic information
    writeln("<table><tr><td>");
    writeln("<h1>{$xml->weather->forecast_information->city->attributes()}</h1><br/>");
    writeln("  Date : {$xml->weather->forecast_information->forecast_date->attributes()}<br/>");
    writeln("  Time : {$xml->weather->forecast_information->current_date_time->attributes()}<br/>");
   
    // Display current information
    writeln("</td><td>");
    writeln("  <b>Current Information</b><br/>");
    writeln("  Temperature : {$xml->weather->current_conditions->temp_c->attributes()} C / {$xml->weather->current_conditions->temp_c->attributes()} C<br/>");
    writeln("  {$xml->weather->current_conditions->humidity->attributes()}<br/>");
    writeln("  {$xml->weather->current_conditions->wind_condition->attributes()}<br/>");
    writeln("  <img src='{$url}{$xml->weather->current_conditions->icon->attributes()}'><br/>");
    writeln("  {$xml->weather->current_conditions->condition->attributes()}<br/>");
    writeln("</td></tr></table>");
   
    writeln("<div id='forecast'>");
    writeln("  <b>Forecasts - Next ".count($xml->weather->forecast_conditions)." days</b>");
    writeln("</div>");
$j=1;
echo "<table><tr>";
		  
			  
		  
    foreach( $xml->weather->forecast_conditions as $i => $result )
    {
        // Display forecasts (next 4 days)
        writeln("<td>Jour : {$result->day_of_week->attributes()}<br/>");
        writeln("  Min : ".convert($result->low->attributes())." ".strtoupper($config['display-temp-unit'])."<br/>");
        writeln("  Max : ".convert($result->high->attributes())." ".strtoupper($config['display-temp-unit'])."<br/>");
        writeln("  <img src='{$url}{$result->icon->attributes()}'><br/>");
        writeln("  {$result->condition->attributes()}</td>");
       $j++;
    }
}
?>
</tr>
	  </table>
