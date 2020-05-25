<?php
    include 'DBAcess.php';
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
      if(isset($_GET["pages"]))
      {$nr  = $_GET["pages"];
      }
      else $nr=1;
        $rez=DBAcess::getInstance()::selectBetweenJson($nr*3500-3500,$country,$year,$weapon);
        echo $rez
?>
