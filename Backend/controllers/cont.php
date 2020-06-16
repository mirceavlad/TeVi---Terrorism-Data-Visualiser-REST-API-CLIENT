<?php
include '../views/pag.php';
include '../model/FilterConfigurator.php';
include '../model/FilterDataObj.php';
include '../model/CookieMapper.php';
include 'cont2.php';
if(isset($_POST['filter'])){
    $cookie_name=$_POST['filter'];
    setcookie($cookie_name."/".uniqid(),"ok",time()+(86400*30),"/");
    header("Refresh:0");
}
$cookiesArray=CookieMapper::mapCookies();
//$cookiesArray=FilterConfigurator::getInstance()::configureFilters($cookiesArray);
cont2::showSelects($cookiesArray);

foreach($_COOKIE as $cookie_name=>$cookie_value){
    $value=substr($cookie_value, 0, strpos($cookie_value, '/'));

    $id=substr($cookie_name, strpos($cookie_name, "/")+1);
    $name=substr($cookie_name, 0, strpos($cookie_name, "/"));
if(isset($_POST[$id]))
{   
    $lastname=substr($cookie_name, strpos($cookie_name, "/") + 1);
    $newCookieId=uniqid();
    setcookie($cookie_name, "upd/".$newCookieId, time()+(86400*30), "/");
    setcookie($name."/".$newCookieId,"bet/".$lastname,time()+(86400*30),"/");
    header("Refresh:0");
}

if(isset($_POST[$id."close"])){

    if($name=="Year" && ($value=="bet" || $value=="upd"))
    {
        $secondId=substr($cookie_value, strpos($cookie_value, "/") + 1);
        cont2::removeInterval($secondId,$cookiesArray);
    }
    setcookie($cookie_name,"",-1,"/");
    header("Refresh:0");
}
}

?>