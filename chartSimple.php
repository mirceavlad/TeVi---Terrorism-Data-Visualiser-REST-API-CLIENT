<!DOCTYPE html>
<html>
<head>
  <!-- maria -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
  
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);
    

      function drawRegionsMap() {
        <?php
        $year = "Any";
         $weapon = "Any";

         $country = array();
         $value = array();
         $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=3");
         //deserialization to array
         $resultsArray = json_decode($jsonString, true);
         //getting the array size
         $responseSize = $resultsArray["dataSz"];
         

        
         for($i = 0; $i < $responseSize ; $i ++) {
         $country[$i] = $resultsArray[$i]["country_txt"];
         }
         

         //remove duplicates
         $country = array_unique($country);
         //sort alphabetically
         sort($country);
         //put the option in the select
         
         
         for($i = 0; $i < sizeof($country) ; $i ++) {
          
             $curCountry = str_replace(' ', '%20', $country[$i]);
             $jsonStringAttacksNo = 
             file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=4&country=$curCountry&year=$year&weapon=$weapon");
             $resultsArrayAttacksNo = json_decode($jsonStringAttacksNo, true);
             $nr = $resultsArrayAttacksNo[0]["NR"];
             $value[$i] = $nr;
          
         }
        
        echo "
            var data = google.visualization.arrayToDataTable([
          ['Country',   'Terrorist Attacks'],";
          for($i = 0; $i < sizeof($country) - 1; $i ++) {
          echo "[\"".$country[$i]."\", ".$value[$i]."],";
          }
          echo "[\"".$country[sizeof($country) - 1]."\", ".$value[sizeof($country) - 1]."]";
          
        echo" 
        ]);";

          echo "var options = {};

          var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

          chart.draw(data, options);";
          ?>
      }
    </script>
</head>
<body>
    <div id="regions_div" style="width: 100%; height: 100%;"></div>
</body>
</html>