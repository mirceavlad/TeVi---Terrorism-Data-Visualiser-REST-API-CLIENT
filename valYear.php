<?php
//mircea
//put all years in select

//making an array with all the years
for($i = 0; $i < $responseSize ; $i ++) {
    $year[$i]=$resultsArray[$i]["iyear"];
    
}
//remove duplicates
$year=array_unique($year);
//sort alphabetically
sort($year);
if('Any'==$_POST['year'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
echo "<option value='Any'".$isSelected.">Any</option>";
//put the option in the select
for($i = 0; $i < $responseSize ; $i ++){
if($year[$i]!=NULL){
if($year[$i]==$_POST['year'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
    echo "<option value='".$year[$i]."'".$isSelected.">".$year[$i]."</option>";
}}
?>
