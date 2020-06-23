<?php
class newsController{

function getNews(){
    $stiri=array();
include_once('../model/simple_html_dom.php');
$html=file_get_html('https://www.foxnews.com/category/world/terrorism');
foreach($html->find('article') as $element)
foreach($element->find('div') as $div)
foreach($div->find('header') as $header)
foreach($header->find('h4') as $h4)
foreach($h4->find('a') as $a){
    array_push($stiri,$a->innertext);
}
return $stiri;
}
}
?>