<?php
$country = "Any";
$year    = "Any";
$weapon  = "Any";


$jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/?flag=1&country=$country&year=$year&weapon=$weapon");

$resultsArray = json_decode($jsonString, true);

$responseSize = $resultsArray["dataSz"];

$long = array();
$lat  = array();

for ($i = 0; $i < $responseSize; $i++) {
    $long[$i] = $resultsArray[$i]["longitude"];
    $lat[$i]  = $resultsArray[$i]["latitude"];
    
}

$totalMarkers = 'markers=color:red%7Clabel:%7C' . $lat[0] . ',' . $long[0];

for ($i = 1; $i < 100; $i++) {
    if ($long[$i] != NULL && $lat[$i] != NULL) {
        
        $totalMarkers = $totalMarkers . '&markers=color:red%7Clabel:%7C' . $lat[$i] . ',' . $long[$i];
    }
}



$image = file_get_contents("https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=1&size=2024x4048&maptype=roadmap&" . $totalMarkers . "&key=AIzaSyDtKxEnjmFmud3qf7EQAxdvUyDGrbxhXeo");

$file_name = 'GoogleMap.png';

$fp    = fopen($file_name , 'w+');
fputs($fp, $image); 

if (is_file($file_name)) {
    
    if (ini_get('zlib.output_compression')) {
        ini_set('zlib.output_compression', 'Off');
    }
    
    
    switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
        case 'pdf':
            $mime = 'application/pdf';
            break;
        case 'zip':
            $mime = 'application/zip';
            break;
        case 'jpeg':
        case 'jpg':
            $mime = 'image/jpg';
            break;
        case 'png':
            $mime = 'image/png';
            break;
        default:
            $mime = 'application/force-download';
    }
    fclose($fp);
    if (file_exists($file_name)) {
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Cache-Control: private', false);
        header('Content-Type: ' . $mime);
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file_name));
        readfile($file_name);
    }
}
?>