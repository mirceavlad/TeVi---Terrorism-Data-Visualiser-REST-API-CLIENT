<?php


class selectsController{
public function showSelects($cookiesArray){
    $selects=array();

    foreach($cookiesArray as $item){
        $selects[$item->id]=array();
        $selects[$item->id]["options"]=array();
        $selects[$item->id][0]=$item->pointingToCategory;
        $selects[$item->id][-1]=$item->isNumeric;
        $selects[$item->id][-2]=$item->isInterval;
        $name=$item->pointingToCategory;

    if($item->currentSelectedValue!='any')
    array_push($selects[$item->id]["options"],$item->currentSelectedValue);
    else
    {array_push($selects[$item->id]["options"],"any");
    sort($item->allPossibleValues);
    foreach($item -> allPossibleValues as $selectValue) {
        array_push($selects[$item->id]["options"],$selectValue);
    }}
}
return $selects;
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
        $titles=array();
        foreach($filtersMap as $filterOption => $filterData) {
            array_push($titles,$filterOption);
        }
        sort($titles);
        return $titles;
    }
}

?>