<?php
class CookieMapper{
    
    public function mapCookies(){
        $filtersArray = array();
        foreach($_COOKIE as $cookie_name=>$cookie_value){
            if (($pos = strpos($cookie_value, "/")) !== FALSE)
                {
                $value=substr($cookie_value, 0, strpos($cookie_value, '/'));
                $otherIntervalId=substr($cookie_value, strpos($cookie_value, "/")+1);
                }
            else 
                {
                $value=NULL;
                $otherIntervalId=NULL;
                }
            $name=substr($cookie_name, 0, strpos($cookie_name, '/'));
            if($otherIntervalId!=NULL)
                $ok=true;
            else 
                $ok=false;
                $isNumeric=false;
                if($name=="iyear" || $name=="latitude" || $name=="longitude" || $name=="iday" || $name=="imonth")
                $isNumeric=true;
            $id=substr($cookie_name, strpos($cookie_name, "/")+1);
            $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric);
            $filtersArray[$id]=$filterOne;
        }
        return $filtersArray;
    }
}

?>