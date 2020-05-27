<?php
    //octavian
    // this is the main controller of the mapDisplayer Back code
    
    // makes a request to attacks api, and it sould output an html containing the app frontend
    //performing request
    $jsonString = file_get_contents("http://localhost/WebTechnologiesProj/attacksDataServiceProvider.php/");
    //deserialization to array
    $resultsArray = json_decode($jsonString, true);
    // getting the array size
    $responseSize = $resultsArray["dataSz"];
    for($i = 0; $i < $responseSize ; $i ++) {
        echo $resultsArray[$i]["country_txt"];
    }
    ?>
