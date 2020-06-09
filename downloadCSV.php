
<?php
//mircea
//script takes select values and calls the api to return the csv
 if(isset($_POST["country"]))
 {$country  = $_POST["country"];
 }
 else $country="Any";
 if(isset($_POST["year"]))
 {$year  = $_POST["year"];
 }
 else $year="Any";
 if(isset($_POST["weapon"]))
 {$weapon  = $_POST["weapon"];
 }
 else $weapon="Any"; 
 $country= str_replace(' ', '%20', $country);
 $weapon= str_replace(' ', '%20', $weapon);
$outputName="terrorData.csv";
header('Content-Disposition: attachment; filename="terrorData.csv"');
header("Content-Type: text/csv");
echo (file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?country=$country&year=$year&weapon=$weapon&csv=1"));

?>