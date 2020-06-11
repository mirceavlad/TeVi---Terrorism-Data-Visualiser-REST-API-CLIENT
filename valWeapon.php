
<?php
//mircea
//put all weapons in select


//making an array with all the weapons
for($i = 0; $i < $responseSize ; $i ++) {
    $weapon[$i]=$resultsArray[$i]["weaptype1_txt"];
    
}
//remove duplicates
$weapon=array_unique($weapon);
//sort alphabetically
sort($weapon);
if('Any'==$_POST['weapon'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
echo "<option value='Any'".$isSelected.">Any</option>";
//put the option in the select
for($i = 0; $i < $responseSize ; $i ++){
if($weapon[$i]!=NULL){
if($weapon[$i]==$_POST['weapon'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
    echo "<option value='".$weapon[$i]."'".$isSelected.">".$weapon[$i]."</option>";
}}
?>