<?php
include '../views/pag.php';
include '../model/FilterConfigurator.php';
include '../model/FilterDataObj.php';
include '../model/CookieMapper.php';
include '../model/FilterMapper.php';
include 'selectsController.php';
include 'listController.php';
$ignoreFilter = null;
if(isset($_POST['filter'])){
    $cookie_name=$_POST['filter'];
    $ignoreFilter = $_POST['filter'];
    setcookie($cookie_name.'/'.uniqid(),"any"."/"."0/",time()+(86400*30),"/");
    setcookie("current",$ignoreFilter,time()+(86400*30),"/");
    header("Refresh:0");
}
foreach($_COOKIE as $cookie_name=>$cookie_value){
    $value=substr($cookie_value, 0, strpos($cookie_value, '/'));
    $id=substr($cookie_name, strpos($cookie_name, "/")+1);
    $name=substr($cookie_name, 0, strpos($cookie_name, "/"));
    if(isset($_POST[$id])){
        $aux=substr($cookie_value, strpos($cookie_value, "/")+1);
        $isInterval=substr($aux, 0, strpos($aux, '/'));
        $otherIntervalId=substr($aux, strpos($aux, "/")+1);
        setcookie($cookie_name,$_POST[$id]."/".$isInterval."/".$otherIntervalId,time()+(86400*30),"/");
        setcookie("current",null,time()+(86400*30),"/");
        header("Refresh:0");
    }
if(isset($_POST[$id."interval"]))
{   $lastname=substr($cookie_name, strpos($cookie_name, "/") + 1);
    $newCookieId=uniqid();
    $value=substr($cookie_value, 0, strpos($cookie_value, '/'));
    setcookie($cookie_name, $value."/"."1/".$newCookieId, time()+(86400*30), "/");
    setcookie($name."/".$newCookieId, "any/"."1/",time()+(86400*30),"/");
    setcookie("current",$name,time()+(86400*30),"/");
    header("Refresh:0");
}

if(isset($_POST[$id."close"])){
    $aux=substr($cookie_value, strpos($cookie_value, "/")+1);
    $isInterval=substr($aux, 0, strpos($aux, '/'));
    if($isInterval==1)
    {
        $secondId=substr($aux, strpos($aux, "/") + 1);
        if($secondId!=NULL)
        selectsController::removeInterval($secondId,$cookiesArray);
    }
    setcookie($cookie_name,"",-1,"/");
    header("Refresh:0");
}
}


selectsController::initFilters(FilterConfigurator::getInstance()::getFiltersTitles());
if(array_key_exists("current", $_COOKIE)==TRUE)
$cookiesArray=CookieMapper::mapCookies($_COOKIE["current"]);
else $cookiesArray=CookieMapper::mapCookies(NULL);
$cookiesArray=FilterConfigurator::getInstance()::configureFilters($cookiesArray);
selectsController::showSelects($cookiesArray);
//var_dump($cookiesArray);
$filtersArray=FilterMapper::mapFilters($cookiesArray);
//var_dump($filtersArray);
if(isset($_POST["Search"]))
{
    listController::showList($filtersArray);
}

//////////////////////////////////////
// $name=substr($cookie_name, 0, strpos($cookie_name, '/'));
// echo "<label>".$name."</label>";
// echo "<select value=".$name."></select>";
// $filterOne = new FilterDataObj(true, 2, 1 , "1970", "iyear");
// $filterTwo = new FilterDataObj(true, 1, null, "2000", "iyear");
// $filterThree = new FilterDataObj(false, 3, null, "2010", "iyear");
// $filtersArray = array();
// $filtersArray[2] = $filterOne;
// $filtersArray[1] = $filterTwo;
// $filtersArray[3] = $filterThree;
// var_dump(FilterConfigurator::getInstance()::configureFilters($filtersArray)[1]);
?>