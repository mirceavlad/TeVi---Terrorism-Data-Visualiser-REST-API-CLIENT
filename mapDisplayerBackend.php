<?php
    //octavian
    // this is the main controller of the mapDisplayer Back code
    
    // makes a request to attacks api, and it sould output an html containing the app frontend
    //performing request
    $jsonString = file_get_contents("http://192.168.64.2/WebTechnologiesProj/attacksDataServiceProvider.php/?country");
    //deserialization to array
    $resultsArray = json_decode($jsonString, true);
    // getting the array size
    $responseSize = $resultsArray["size"];
    for($i = 0; $i < $responseSize ; $i ++) {
        echo $resultsArray[$i]["country_txt"].;
    }
    ?>
