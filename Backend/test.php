<DOCTYPE html>
<html> 
<head> 
</head> 
<body> 
<div id="map" style="width: 400px; height:400px;">
   </div> 
        <script>
        function initMap() {
        var myLatlng = new google.maps.LatLng(42.3730492, -71.0499857);
  var mapOptions = {
    zoom: 15,
    center: myLatlng,

  };
  var map = new google.maps.Map(document.getElementById('map'),
    mapOptions);

  var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title: 'Dryft Revere!'
  });
  var infoWindow = new google.maps.InfoWindow({
    content: "Pier 6"
  });
  marker.addListener('click', function(evt) {
    infoWindow.open(map, marker);
  });
  google.maps.event.trigger(marker, "click");
}
    

    
  </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo&callback=initMap"></script>
        </body> 
        </html> 