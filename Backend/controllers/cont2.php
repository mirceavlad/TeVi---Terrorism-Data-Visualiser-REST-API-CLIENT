<?php
class cont2{
public function showSelects($cookiesArray){
    foreach($cookiesArray as $item){
        $name=$item->pointingToCategory;
        echo "<label id=".$name.">".$name."</label>";
    echo "<select value=".$name."></select>";
    echo "<form method=\"post\">";
echo "<input type=\"submit\" class=\"closebtn\" id=".$item->id."close name=".$item->id."close value=\"X\">";
echo "</form>";
    //var_dump($item);
$value=$item->currentSelectedValue;
if($name=="Year" && $value!="bet")
{
$ok="";
if($value=="upd")
$ok="style=\"color:red\" disabled";
echo "<form action=\"cont.php\" method=\"post\">";
echo "<input type=\"submit\" id=".$item->id." name=".$item->id." $ok value=\"Between\">";
echo "</form>";

}
//var_dump($item);
}
}

public function removeInterval($id, $cookiesArray){
    foreach($cookiesArray as $item){
        if($item->id==$id){
            setcookie($item->pointingToCategory."/".$id,"ok",time()+(86400*30),"/");
        }
    }
    }
}

?>