<?php
//mircea
//all page nr in a select
$rez=DBAcess::getInstance()::totalNr();
$nr=$rez->fetch_assoc();
$total=$nr["NR"]/3500;
for($i=1;$i<=$total;$i++){
    echo "<option value=$i>$i</option>";
}
?>