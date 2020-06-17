<?php
class selectsController{
public function showSelects($cookiesArray){
    foreach($cookiesArray as $item){
        $name=$item->pointingToCategory;
        echo "<form method=\"post\">";
        echo "<label id=".$name.">".$name."</label>";
    echo "<select id=\"$item->id\" name=\"".$item->id."\" value=".$item->id." onchange='this.form.submit()'>";
    if($item->currentSelectedValue!='any')
    echo "<option value=\"".$item->currentSelectedValue."\" selected='selected' >".$item->currentSelectedValue."</option>";
    else
    {echo "<option value=\"Any\">Any</option>";
    
    foreach($item -> allPossibleValues as $selectValue) {
        echo "<option value=\"".$selectValue."\" >".$selectValue."</option>";
    }}
    echo "</select>";
    echo "</form>";
    echo "<form method=\"post\">";
echo "<input type=\"submit\" class=\"closebtn\" id=".$item->id."close name=".$item->id."close value=\"X\">";
echo "</form>";
$value=$item->currentSelectedValue;
if($item->isNumeric==true)
{
$ok="";
if($item->isInterval==true)
$ok="style=\"color:red\" disabled";
echo "<form action=\"filters.php\" method=\"post\">";
echo "<input type=\"submit\" id=".$item->id."interval name=".$item->id."interval $ok value=\"Between\">";
echo "</form>";

}

}

}

public function removeInterval($id, $cookiesArray){
    foreach($cookiesArray as $item){
        if($item->id==$id){
            setcookie($item->pointingToCategory."/".$id,"ok",time()+(86400*30),"/");
        }
    }
    }


    public function initFilters($filtersMap){
        echo "<form method=\"post\" action=\"filters.php\">";
        echo "<select id=\"filter\" name=\"filter\">";
        foreach($filtersMap as $filterOption => $filterData) {
            $ok="";
            if(isset($_POST["filter"]) && $_POST["filter"]==$filterOption)
$ok=" selected=\"selected\" ";
            echo "<option value=\"".$filterOption."\" $ok >".$filterOption."</option>";
        }
        echo "</select>";
        echo "<input type=\"Submit\" value=\"Submit\"/>";
        echo "</form>";
    }
}

?>