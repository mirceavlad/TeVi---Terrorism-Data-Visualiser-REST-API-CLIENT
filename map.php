<DOCTYPE html>
<html> 
<head> 
</head> 
<body> 
    <div id="map" style="width: 100%; height:100%;">
   </div> 
        <script>
        //octavian + mircea + maria
            function initMap() {
      var mapInitPos = { lat: 25.344, lng: 131.036 };
      var points = [];
      var map = new google.maps.Map(
        document.getElementById('map'), { zoom: 4, center: mapInitPos });
   <?php
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
    $country= str_replace(' ', '%20', $country);
    $weapon= str_replace(' ', '%20', $weapon);
   $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=1&country=$country&year=$year&weapon=$weapon");
//deserialization to array
$resultsArray = json_decode($jsonString, true);
// getting the array size
$responseSize = $resultsArray["dataSz"];
echo "var mapPoints=[];
function createMarker(coordonates,data){
  var content=data;
  var marker=new google.maps.Marker({
    position: coordonates,
    map: map
  });
  google.maps.event.addListener(marker,'click', function() {
    infowindow.setContent(content); 
    infowindow.open(map,marker);
    });
    return marker;
}
";
for($i = 0; $i < $responseSize ; $i ++) {
      $long=$resultsArray[$i]["longitude"];
      $lat=$resultsArray[$i]["latitude"];
      $currentYear=$resultsArray[$i]["iyear"];
      $currentWeapon=$resultsArray[$i]["weaptype1_txt"];
      if($long!=NULL && $lat!=NULL)
     echo " 
     var infowindow = new google.maps.InfoWindow();
     var info=\"Year: ".$currentYear." Weapon: ".$currentWeapon."\"; 
     var coord=new google.maps.LatLng($lat,$long);
     var pt = createMarker(coord,info);
    
        ";
    }

?>}
    
  </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo&callback=initMap"></script>
        </body> 
        </html> 