<?php
require_once '../vendor/autoload.php';
include '../model/FilterConfigurator.php';
include '../model/FilterDataObj.php';
include '../model/CookieMapper.php';
include '../model/FilterMapper.php';
include 'selectsController.php';
include 'geoChartController.php';
$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);
$ignoreFilter = null;
if(isset($_POST['filter'])){
    $cookie_name=$_POST['filter'];
    $ignoreFilter = $_POST['filter'];
    setcookie($cookie_name.'ß'.uniqid(),"any"."ß"."0ß",time()+(86400*30),"/");
    setcookie("current",$ignoreFilter,time()+(86400*30),"/");
    header("Refresh:0");
}
if(array_key_exists("current", $_COOKIE)==TRUE)
$cookiesArray=CookieMapper::mapCookies($_COOKIE["current"]);
else $cookiesArray=CookieMapper::mapCookies(NULL);
$cookiesArray=FilterConfigurator::getInstance()::configureFilters($cookiesArray);

foreach($_COOKIE as $cookie_name=>$cookie_value){
    $value=substr($cookie_value, 0, strpos($cookie_value, 'ß'));
    $id=substr($cookie_name, strpos($cookie_name, "ß")+2);
    $name=substr($cookie_name, 0, strpos($cookie_name, "ß"));
    if(isset($_POST[$id])){
        $aux=substr($cookie_value, strpos($cookie_value, "ß")+2);
        $isInterval=substr($aux, 0, strpos($aux, 'ß'));
        $otherIntervalId=substr($aux, strpos($aux, "ß")+2);
        setcookie($cookie_name,$_POST[$id]."ß".$isInterval."ß".$otherIntervalId,time()+(86400*30),"/");
        setcookie("current",null,time()+(86400*30),"/");
        header("Refresh:0");
    }
if(isset($_POST[$id."interval"]))
{   $lastname=substr($cookie_name, strpos($cookie_name, "ß") + 1);
    $newCookieId=uniqid();
    $value=substr($cookie_value, 0, strpos($cookie_value, 'ß'));
    setcookie($cookie_name, $value."ß"."1ß".$newCookieId, time()+(86400*30), "/");
    setcookie($name."ß".$newCookieId, "anyß"."1ß",time()+(86400*30),"/");
    setcookie("current",$name,time()+(86400*30),"/");
    header("Refresh:0");
}
if(isset($_POST[$id."close"])){
    $aux=substr($cookie_value, strpos($cookie_value, "ß")+2);
    $isInterval=substr($aux, 0, strpos($aux, 'ß'));
    if($isInterval==1)
    {
        $secondId=substr($aux, strpos($aux, "ß") + 1);
        if($secondId!=NULL)
        selectsController::removeInterval($secondId,$cookiesArray);
    }
    setcookie($cookie_name,"",-1,"/");
    header("Refresh:0");
}

}


$titles=selectsController::initFilters(FilterConfigurator::getInstance()::getFiltersTitles());

$selects=selectsController::showSelects($cookiesArray);
$filtersArray=FilterMapper::mapFilters($cookiesArray);
$list=null;
if(isset($_POST["Search"]))
{
    $list=$filtersArray;
}
if(isset($_POST["Chart"]))
{
    geoChartController::showList($filtersArray);

}
else if(isset($_POST["Map"]))
{
    echo $twig->render('map.php.twig',['values'=>$titles, 'selects'=>$selects, 'coords'=>$filtersArray]);

}
else echo $twig->render('map.php.twig',['values'=>$titles, 'selects'=>$selects, 'tables'=>$list]);
?>