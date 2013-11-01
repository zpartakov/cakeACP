
<?php
    // File: /app/views/orders/csv/export.ctp
header('Content-type: text/x-csv');
header('Content-Disposition: attachment; filename="exportDJ.csv"');
   
    // Loop through the data array
    foreach ($data as $row)
    {
        // Loop through every value in a row
        foreach ($row['JosDemiejourneesDetail'] as &$value)
        {
            // Apply opening and closing text delimiters to every value
            $value = "\"".$value."\"";
        }
        // Echo all values in a row comma separated
        echo implode(";",$row['JosDemiejourneesDetail'])."\n";
    }
?> 
