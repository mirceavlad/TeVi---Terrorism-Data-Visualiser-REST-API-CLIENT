<?php
    include 'DBAcess.php';
    $jsonData = DBAcess::getInstance()::selectAllAsJson();
    echo $jsonData;
?>
