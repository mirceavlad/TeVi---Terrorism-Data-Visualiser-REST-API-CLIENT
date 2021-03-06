<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="index.css">
  <title>Terrorist Map</title>
</head>

<body>
  <!--mircea
  sidebar with buttons -->
  <div id="sidebar">
    <a onclick="openSearch()" class="txt filterTxt">FILTER</a>
    <a href="pag.php" class="txt listTxt">LIST</a>
    <a onclick="openSave()" class="txt saveTxt">SAVE</a>
    <a onclick="openStats()" class="txt statsTxt">STATS</a>
  </div>
  <div id="map">
  </div>
  <div id="searchside">
    <button class="closebtn" onclick="closeNav()">X</button>
    <form method="post" id="selectForm" name="form">  
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
  
  <div id="saveside">
  <button class="closebtn" onclick="closeNav()">X</button>
    <div class="butoane">
    <form action="downloadCSV.php" method="post">
      <?php
        include 'paramExport.php';
      ?>
      <input type="submit" class="btn btn1" value="CSV">
    </form>
      <button class="btn btn2" >SVG</button>
      <form action="downloadPNG.php" method="post">
      <?php
        include 'paramExport.php';
      ?>
      <input type="submit" class="btn btn3" value="PNG">
    </form>
      

    </div>
    </div>
  <div id="statsside">
  <button class="closebtn" onclick="closeNav()">X</button>
    <div class="butoane">
      <button class="btn btn4" onclick = "location.href='chartSimple.php'">Geo Map Simple</button>
      <button class="btn btn5" onclick = "location.href='barGraph.php'">Bar Chart</button>
      <button class="btn btn6" onclick = "location.href='chartColour.php'">Geo Map Coloured</button>
      

    </div>
</div>
  <script>
    function openSearch() {
      document.getElementById("searchside").style.width = "20rem";
      document.getElementById("saveside").style.width = "0%";
      document.getElementById("statsside").style.width = "0%";

    }

    function openStats() {
      document.getElementById("statsside").style.width = "20rem";
      document.getElementById("saveside").style.width = "0%";
      document.getElementById("searchside").style.width = "0";
    }
    
    function openSave() {
      document.getElementById("saveside").style.width = "20rem";
      document.getElementById("searchside").style.width = "0%";
      document.getElementById("statsside").style.width = "0%";
    }
    function closeNav() {
      document.getElementById("searchside").style.width = "0";
      document.getElementById("saveside").style.width = "0";
      document.getElementById("statsside").style.width = "0%";
 
   }



  </script>
    <?php
include 'map.php';
?>
</body>

</html>