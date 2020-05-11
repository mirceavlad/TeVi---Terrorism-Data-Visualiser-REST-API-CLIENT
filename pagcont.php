<?php
    if(isset($_POST["pages"]))
    {$nr  = $_POST["pages"];
    }
    else 
      $rez=DBAcess::getInstance()::selectBy("United States","Any","Any");
      while($atacuri=$rez->fetch_assoc()){
        $country=$atacuri["country_txt"];
        $year=$atacuri["iyear"];
        $weapon=$atacuri["weaptype1_txt"];
      echo "<li><a class='country'>$country</a><a>$year</a><a>$weapon</a></li>"; 
      }
      ?>