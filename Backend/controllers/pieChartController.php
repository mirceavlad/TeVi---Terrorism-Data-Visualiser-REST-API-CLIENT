<?php
class pieChartController
{
    
    function showList($filtersArray){

        $countries_map  = array();
        $countries_array = array();
        $i              = 0;
        
        
        if (is_array($filtersArray) || is_object($filtersArray)) {
            
            foreach ($filtersArray as $item) {
                if (is_array($item) || is_object($item))
                    foreach ($item as $key => $value) {
                        $key_string = $key ;
                
                        if (strcmp($key_string, 'country_txt') == 0) {
                            
                            if (array_key_exists($value, $countries_map)) {
                                $countries_map[$value] = $countries_map[$value] + 1;
                            } else {
                                
                                $countries_map[$value] = 1;
                                $countries_array[$i]         = $value;
                                $i                          = $i + 1;
                            }
                        }
                    }
            }
        }

        echo "<script>google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(function drawChart(){;
          var data = google.visualization.arrayToDataTable([
            ['Country', 'Attacks'],";
            echo "[\"" . $countries_array[0] . "\"" . "," . $countries_map[$countries_array[0]]. "]";
            for ($i = 1; $i < sizeof($countries_array); $i++) {
                echo ",[\"" . $countries_array[$i] . "\"" . "," . $countries_map[$countries_array[$i]] . "]";
            }
          echo "]);
  
          var options = {
            title: 'My Daily Activities',
            is3D: true,
            height: 200
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('map'));
          chart.draw(data, options);});
          </script>
        ";
    }
}



?>