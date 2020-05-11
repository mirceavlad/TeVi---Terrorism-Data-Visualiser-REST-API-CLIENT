<?php
//mircea
//put all years in select
$rez=DBAcess::getInstance()::getYears();
$nr=$rez->fetch_assoc();
echo "<option value=Any selected>Any</option>";
while($atacuri=$rez->fetch_assoc()){
    $year=$atacuri["iyear"];
    echo "<option value=$year>$year</option>";
}
?>