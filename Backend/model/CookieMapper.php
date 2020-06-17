<?php
class CookieMapper{
    
    public function mapCookies(){
        $filtersArray = array();
        foreach($_COOKIE as $cookie_name=>$cookie_value){
            if (($pos = strpos($cookie_value, "/")) !== FALSE)
                {
                $value=substr($cookie_value, 0, strpos($cookie_value, '/'));
                $aux=substr($cookie_value, strpos($cookie_value, "/")+1);
                $isInterval=substr($aux, 0, strpos($aux, '/'));
                $otherIntervalId=substr($aux, strpos($aux, "/")+1);
                }
            else 
                {
                $value=NULL;
                $otherIntervalId=NULL;
                $isInterval=0;
                }
            $name=substr($cookie_name, 0, strpos($cookie_name, '/'));
            if($isInterval==1)
                $ok=true;
            else 
                $ok=false;
                $isNumeric=false;
                if($name=="iyear" || $name=="latitude" || $name=="longitude" || $name=="iday" || $name=="imonth")
                $isNumeric=true;

            if($ok==true && $otherIntervalId!=NULL && $cookie_value!='any'){
                $otherCookie=$_COOKIE[$name."/".$otherIntervalId];
                $otherValue=substr($otherCookie, 0, strpos($otherCookie, '/'));
                if($otherValue!='any')
                    {
                        $id=substr($cookie_name, strpos($cookie_name, "/")+1);
                        $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric);
                        $filtersArray[$id]=$filterOne;
                        $filterOne = new FilterDataObj($ok, $otherIntervalId, NULL, $otherValue, $name, $isNumeric);
                        $filtersArray[$otherIntervalId]=$filterOne;
                    }
            }
            else if($ok==false)
{
            $id=substr($cookie_name, strpos($cookie_name, "/")+1);
            $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric);
            $filtersArray[$id]=$filterOne;
        }}
        return $filtersArray;
    }
}

?>