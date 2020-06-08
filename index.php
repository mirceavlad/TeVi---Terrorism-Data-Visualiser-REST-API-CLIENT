<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Terrorist Map</title>
</head>

<body>
  <!--mircea
  sidebar with buttons -->
  <div id="sidebar">
    <a onclick="openSearch()" class="txt filterTxt">FILTER</a>
    <a href="pag.php" class="txt listTxt">LIST</a>
    <a onclick="openSave()" class="txt saveTxt">SAVE</a>
    <a href="chartColour.php" class="txt statsTxt">STATS</a>
  </div>
  <div id="map">
  </div>
  <div id="searchside">
    <a id="close" onclick="closeNav()"><button id="closebtn">X</button></a>
    <form method="post" id="selectForm" action="" name="form">  
    <div id="select1">
      <label for="countryChoose">Choose a country:</label>
      <select id="countryChoose" name="country">
       <?php
        include 'valCountry.php';
       ?>
      </select></div>
    <div id="select2">
      <label for="yearChoose">Choose a year:</label>
      <select id="yearChoose" name="year">
      <?php
        include 'valYear.php';
       ?>
      </select></div>
    <div id="select3">
      <label for="weaponChoose">Choose a weapon:</label>
      <select id="weaponChoose" name="weapon">
      <?php
        include 'valWeapon.php';
       ?>
      </select></div>
      <input name="submit" type="submit" value="Submit">
</form>
  </div>
  <div id="listside">
    <a id="close" onclick="closeNav()"><button id="closebtn">X</button></a>
    <ul id="lista1" style="list-style-type:none;">
    
    </ul>

  </div>
  <div id="saveside">
    <a id="close" onclick="closeNav()"><button id="closebtn">X</button></a>
    <div id="butoane">
      <button class="btn btn1">CSV</button>
      <button class="btn btn2">SVG</button>
      <a id="save" onclick="savePNG()"><button class="btn btn3">PNG</button>

    </div>
  </div>
  <script>
    function openSearch() {
      document.getElementById("searchside").style.width = "20rem";
      document.getElementById("listside").style.width = "0%";
      document.getElementById("saveside").style.width = "0%";

    }
    
    function openSave() {
      document.getElementById("saveside").style.width = "20rem";
      document.getElementById("searchside").style.width = "0%";
      document.getElementById("listside").style.width = "0%";
    }
    function closeNav() {
      document.getElementById("searchside").style.width = "0";
      document.getElementById("listside").style.width = "0";
      document.getElementById("saveside").style.width = "0";
 
   }

   function savePNG(){
     //maria
      <?php
      $country="Any";
      $year="Any";
      $weapon="Any"; 


      $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=1&country=$country&year=$year&weapon=$weapon");

      $resultsArray = json_decode($jsonString, true);

      $responseSize = $resultsArray["dataSz"];

    $long = array();
    $lat = array();

    for($i = 0; $i < $responseSize ; $i ++) {
      $long[$i]=$resultsArray[$i]["longitude"];
      $lat[$i]=$resultsArray[$i]["latitude"];
      
    }
    
    $totalMarkers = 'markers=color:red%7Clabel:%7C'.$lat[0].','.$long[0];
    /*$image = file_get_contents
    ('https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=1&size=1024x2048&key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo'); */
    for($i = 1; $i < 100 ; $i ++){
      if($long[$i]!=NULL && $lat[$i]!=NULL){

       $totalMarkers =  $totalMarkers.'&markers=color:red%7Clabel:%7C'.$lat[$i].','.$long[$i];
      }
    }


   
    $image = file_get_contents("https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=1&size=2024x4048&maptype=roadmap&".$totalMarkers."&key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo");
    $fp  = fopen('GoogleMap.png', 'w+'); 

    fputs($fp, $image); 

     ?>

   }

  </script>
    <?php
    include 'map.php';
    ?>
</body>

</html>