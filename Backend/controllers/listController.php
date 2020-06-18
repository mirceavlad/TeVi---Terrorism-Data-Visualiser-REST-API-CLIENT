<?php
class listController{
    function showList($filtersArray){
        echo "<div id=\"list\">";
        
        foreach($filtersArray as $item){
            echo "<ul>";
            var_dump($filtersArray);
           var_dump($item);
            foreach($item as $camp){
                echo $camp;
            }
            echo "</ul>";
        }
        echo "</div>";
    }
}

?>