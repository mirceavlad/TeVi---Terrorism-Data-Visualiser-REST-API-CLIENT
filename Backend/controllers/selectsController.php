<?php
class selectsController{
public function showSelects($cookiesArray){
    foreach($cookiesArray as $item){
        $name=$item->pointingToCategory;
        echo "<form method=\"post\">";
        echo "<label id=".$name.">".$name."</label>";
    echo "<select id=\"$item->id\" name=\"".$item->id."\" value=".$item->id." onchange='this.form.submit()'>";
    echo "<optgroup>";
    if($item->currentSelectedValue!='any')
    
    echo "<option value=\"".$item->currentSelectedValue."\" selected='selected' >".$item->currentSelectedValue."</option>";
    else
    {echo "<option value=\"any\">any</option>";
    sort($item->allPossibleValues);
    foreach($item -> allPossibleValues as $selectValue) {
        echo "<option value=\"".$selectValue."\" >".$selectValue."</option>";
    }}
    echo "</optgroup>";
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
echo "</div>";
}

public function removeInterval($id, $cookiesArray){
    foreach($cookiesArray as $item){
        if($item->id==$id){
            $value=$item->currentSelectedValue;
            setcookie($item->pointingToCategory."ß".$id,"",-1,"/");
            setcookie($item->pointingToCategory."ß".$id,$value."ß"."0ß",time()+(86400*30),"/");
        }
    }
    }


    public function initFilters($filtersMap){
        echo "<form method=\"post\" action=\"filters.php\">";
        echo "<select id=\"filter\" name=\"filter\">";
        echo "<optgroup>";
        foreach($filtersMap as $filterOption => $filterData) {
            echo "<option value=\"".$filterOption."\" >".$filterOption."</option>";
        }
        echo "</optgroup>";
        echo "</select>";
        echo "<input type=\"Submit\" value=\"Submit\"/>";
        echo "</form>";
    }
}

?>