<?php
//mircea
//gets all attacks as json
    include 'DBAcess.php';

    //maria
    if(isset($_GET["country"]))
      {$country  = $_GET["country"];
      }
      else $country="Any";
      if(isset($_GET["year"]))
      {$year  = $_GET["year"];
      }
      else $year="Any";
      if(isset($_GET["weapon"]))
      {$weapon  = $_GET["weapon"];
      }
      else $weapon="Any";
      
      
    $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
    echo $rez


?>
