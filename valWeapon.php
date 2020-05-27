
<?php
//mircea
//put all weapons in select
/*$rez=DBAcess::getInstance()::getWeapons();
$nr=$rez->fetch_assoc();
echo "<option value=Any selected>Any</option>";
while($atacuri=$rez->fetch_assoc()){
    $weapon=$atacuri["weaptype1_txt"];
    if($weapon==$_POST['weapon'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
    echo "<option value=$weapon".$isSelected.">$weapon</option>";
}*/

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