<?php
//mircea
//all page nr in a select
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

$jsonString = file_get_contents("http://localhost/web/WebTechnologiesProj/countDataServiceProvider.php/?country=$country&year=$year&weapon=$weapon");
//deserialization to array
$resultsArray = json_decode($jsonString, true);
// getting the array size
$responseSize = $resultsArray["dataSz"];
$nr=$resultsArray[0]["NR"];
$total=$nr/3500+1;
for($i=1;$i<=$total;$i++){
    if($i==$_POST['pages'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
    echo "<option value=$i".$isSelected.">$i</option>";
}
?>