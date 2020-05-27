<?php
//mircea
//put all countries in select

$jsonString = file_get_contents("http://localhost/WebTechnologiesProj/getAllDataServiceProvider.php/");
//deserialization to array
$resultsArray = json_decode($jsonString, true);
// getting the array size
$responseSize = $resultsArray["dataSz"];

//making an array with all the country names
for($i = 0; $i < $responseSize ; $i ++) {
    $country[$i]=$resultsArray[$i]["country_txt"];
    
}
//remove duplicates
$country=array_unique($country);
//sort alphabetically
sort($country);
//put the option in the select
if('Any'==$_POST['country'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
echo "<option value='Any'".$isSelected.">Any</option>";
for($i = 0; $i < $responseSize ; $i ++){
if($country[$i]!=NULL){
if($country[$i]==$_POST['country'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
    echo "<option value='".$country[$i]."'".$isSelected.">".$country[$i]."</option>";
}}
?>