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
    <a href="CharColour.html" class="txt statsTxt">STATS</a>
  </div>
  <div id="map">
  </div>
  <div id="searchside">
    <a id="close" onclick="closeNav()"><button id="closebtn">X</button></a>
    <div id="select1">
      <label for="countryChoose">Choose a country:</label>
      <select id="countryChoose" onchange="filter()"></select></div>
    <div id="select2">
      <label for="yearChoose">Choose a year:</label>
      <select id="yearChoose" onchange="filter()"></select></div>
    <div id="select3">
      <label for="weaponChoose">Choose a weapon:</label>
      <select id="weaponChoose" onchange="filter()"></select></div>
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
      <button class="btn btn3">PNG</button>

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
   //octavian
    function initMap() {
      var mapPointsGermany = [{ lat: 15.344, lng: 131.036 }, { lat: 35.344, lng: 120.036 }, { lat: 45.344, lng: 140.036 }, { lat: 55.344, lng: 100.036 }, { lat: 65.344, lng: 90.036 }]
      var mapInitPos = { lat: 25.344, lng: 131.036 };
      var points = [];
      var map = new google.maps.Map(
        document.getElementById('map'), { zoom: 4, center: mapInitPos });
      //var marker = new google.maps.Marker({position: mapInitPos, map: map});
      var mark = new google.maps.Marker({ position: mapInitPos, map: map });
      mark.setMap(map);
      for (var i = 0; i < mapPointsGermany.length; i++) {
        var pt = new google.maps.Marker({ position: mapPointsGermany[i] });
        pt.setMap(map);
        points.push(pt);
      }
    }
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo&callback=initMap"></script>
</body>

</html>