<?php
class listController{
    function showList($filtersArray){
        //var_dump($filtersArray);
        
        echo "<table id=\"list\">";
        echo "<tr id=\"cap\">";
        if (is_array($filtersArray) || is_object($filtersArray))   
        foreach($filtersArray[0] as $key=>$value){

                echo "<th>".$key."</th>";
        }
        if (is_array($filtersArray) || is_object($filtersArray)) 
        foreach($filtersArray as $item){
            echo "<tr>";
            if (is_array($item) || is_object($item))
            foreach($item as $key=>$value){
                echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</tr>";
        echo "</table>";
    }
}

?>