<?php
include '../views/pag.php';
include '../model/FilterConfigurator.php';
include '../model/FilterDataObj.php';
if(isset($_POST['filter'])){
    $cookie_name=$_POST['filter'];
    setcookie($cookie_name."/".uniqid(),"ok",time()+(86400*30),"/");
    header("Refresh:0");
}

foreach($_COOKIE as $cookie_name=>$cookie_value){
$name=substr($cookie_name, 0, strpos($cookie_name, '/'));
echo "<label>".$name."</label>";
echo "<select value=".$name."></select>";}
$filterOne = new FilterDataObj(false, 1, null, "any", "country_txt");
$filtersArray = array();
var_dump($filterOne);
array_push($filtersArray, $filterOne);
var_dump(FilterConfigurator::getInstance()::configureFilters($filtersArray)[0] -> allPossibleValues);
?>