 <?php
//mircea
//filter by selects
   
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
      if(isset($_POST["pages"]))
      {$nr  = $_POST["pages"];
      }
      else $nr=1;
      $country= str_replace(' ', '%20', $country);
      $weapon= str_replace(' ', '%20', $weapon);
$jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=2&pages=$nr&country=$country&year=$year&weapon=$weapon");
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
