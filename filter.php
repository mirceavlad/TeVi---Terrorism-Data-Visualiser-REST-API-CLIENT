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
      $rez=DBAcess::getInstance()::selectBetween($nr*3500-3500,$country,$year,$weapon);
      while($atacuri=$rez->fetch_assoc()){
        $country=$atacuri["country_txt"];
        $year=$atacuri["iyear"];
        $weapon=$atacuri["weaptype1_txt"];
      echo "<li><a class='country'>$country</a><a>$year</a><a>$weapon</a></li>"; 
      }
      ?>
