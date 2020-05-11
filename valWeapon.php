
<?php
//mircea
//put all weapons in select
$rez=DBAcess::getInstance()::getWeapons();
$nr=$rez->fetch_assoc();
echo "<option value=Any selected>Any</option>";
while($atacuri=$rez->fetch_assoc()){
    $weapon=$atacuri["weaptype1_txt"];
    echo "<option value=$weapon>$weapon</option>";
}
?>