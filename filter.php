 <?php
//mircea
//filter by selects
   /* if(isset($_POST["country"]))
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
    if(isset($_POST["pages"]))
    {$nr  = $_POST["pages"];
    }
    else $nr=1; 
      $rez=DBAcess::getInstance()::selectBetween($nr*3500-3500,$country,$year,$weapon);
      while($atacuri=$rez->fetch_assoc()){
        $country=$atacuri["country_txt"];
        $year=$atacuri["iyear"];
        $weapon=$atacuri["weaptype1_txt"];
      echo "<li><a class='country'>$country</a><a>$year</a><a>$weapon</a></li>"; 
      }*/
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
      $country= str_replace(' ', '%20', $country);
      $weapon= str_replace(' ', '%20', $weapon);
$jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?pages=$nr&country=$country&year=$year&weapon=$weapon");
    //deserialization to array
    $resultsArray = json_decode($jsonString, true);
    // getting the array size
    $responseSize = $resultsArray["dataSz"];
    for($i = 0; $i < $responseSize ; $i ++) {
      $vcountry=$resultsArray[$i]["country_txt"];
      $vyear=$resultsArray[$i]["iyear"];
      $vweapon=$resultsArray[$i]["weaptype1_txt"];
        echo "<li><a class='country'>$vcountry</a><a>$vyear</a><a>$vweapon</a></li>"; 
    }
      ?>
