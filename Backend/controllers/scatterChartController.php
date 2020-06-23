<?php
class scatterChartController
{
    
    function showList($filtersArray){

        $years_map  = array();
        $years_array = array();
        $i              = 0;
        
        
        if (is_array($filtersArray) || is_object($filtersArray)) {
            
            foreach ($filtersArray as $item) {
                if (is_array($item) || is_object($item))
                    foreach ($item as $key => $value) {
                        $key_string = $key ;
                
                        if (strcmp($key_string, 'iyear') == 0) {
                            
                            if (array_key_exists($value, $years_map)) {
                                $years_map[$value] = $years_map[$value] + 1;
                            } else {
                                
                                $years_map[$value] = 1;
                                $years_array[$i]         = $value;
                                $i                          = $i + 1;
                            }
                        }
                    }
            }
        }

        if (is_array($filtersArray) || is_object($filtersArray)) {
        echo " <script> google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(function drawChart(){

          var data = google.visualization.arrayToDataTable([
            ['Year', 'Attacks'],";

            echo "[" . $years_array[0]  . "," . $years_map[$years_array[0]]. ']';
            for ($i = 1; $i < sizeof($years_array); $i++) {
                echo ",[" . $years_array[$i] . "," . $years_map[$years_array[$i]] . ']';
            }
           
          echo "]);
  
          var options = {
            title: 'Year vs. Attacks comparison',
            width: 1000,
                height: 700,
            hAxis: {title: 'Year', minValue: 0, maxValue: 2010},
            vAxis: {title: 'Attacks', minValue: 0, maxValue: 10000},
            legend: 'none'
          };
  
          var chart = new google.visualization.ScatterChart(document.getElementById('map'));
  
          chart.draw(data, options);});
          </script>
          ";
        }
    }
}

?>