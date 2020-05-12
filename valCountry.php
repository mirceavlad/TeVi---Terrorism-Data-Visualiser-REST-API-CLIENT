<?php
//mircea
//put all countries in select
$rez=DBAcess::getInstance()::getCountries();
$nr=$rez->fetch_assoc();
echo "<option value=Any selected>Any</option>";
while($atacuri=$rez->fetch_assoc()){
    $country=$atacuri["country_txt"];
    if($country==$_POST['country'])
    $isSelected = ' selected="selected"';
    else{
        $isSelected = '';
    }
    echo "<option value='".$country."'".$isSelected.">$country</option>";
}
?>