<?php
include 'pag.php';
if(isset($_POST['filter'])){
    $cookie_name=$_POST['filter'];
    setcookie($cookie_name."/".uniqid(),"ok",time()+(86400*30),"/");
    header("Refresh:0");
}

foreach($_COOKIE as $cookie_name=>$cookie_value){
$name=substr($cookie_name, 0, strpos($cookie_name, '/'));
echo "<label>".$name."</label>";
echo "<select value=".$name."></select>";}

?>