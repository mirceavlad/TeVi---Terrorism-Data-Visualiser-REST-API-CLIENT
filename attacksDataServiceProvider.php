<?php
//octavian+mircea
    include 'DBAcess.php';
    if(isset($_GET["flag"]))
    $flag=$_GET["flag"];
    else $flag=1;
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
      switch ($flag) {
      case 1:
        $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
        echo $rez;
      break;
      case 2:
        $rez=DBAcess::getInstance()::selectBetweenJson($nr*3500-3500,$country,$year,$weapon);
        echo $rez;
      break;
      case 3:
        $rez=DBAcess::getInstance()::selectAllAsJson();
        echo $rez;
      break;
      case 4:
        $rez=DBAcess::getInstance()::totalNrJson($country,$year,$weapon);
    echo $rez;
      break;
      default:
      $rez=DBAcess::getInstance()::selectByCoordJson($country, $year, $weapon);
        echo $rez;
      }
?>
