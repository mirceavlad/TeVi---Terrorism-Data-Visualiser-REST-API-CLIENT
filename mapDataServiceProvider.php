<?php
//mircea
//gets all attacks as json
    include 'DBAcess.php';
    $rez=DBAcess::getInstance()::selectAllAsJson();
    echo $rez
?>
