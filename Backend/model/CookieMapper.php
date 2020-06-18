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
            // i added an is valid(true/false) field in the filter object, se line 36, 38, 43, 45 -> if u dont set a value there, it will
            // run and it will set default to true
            
            //if one interval is valid
            echo "ok=".$ok;
            echo "otherintervalid=".$otherIntervalId;
            echo "value=".$value;
            if($ok==true && $otherIntervalId!=NULL && $value!='any'){
                $otherCookie=$_COOKIE[$name."/".$otherIntervalId];
                $otherValue=substr($otherCookie, 0, strpos($otherCookie, '/'));
                echo "othervalue=".$otherValue;
                // if the other interval is not valid
                if($otherValue!='any')
                    {
                        //set both interval ends to not valid
                        echo "enters 33";
                        $id=substr($cookie_name, strpos($cookie_name, "/")+1);
                        $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric, true);
                        $filtersArray[$id]=$filterOne;
                        $filterOne = new FilterDataObj($ok, $otherIntervalId, NULL, $otherValue, $name, $isNumeric, true);
                        $filtersArray[$otherIntervalId]=$filterOne;
                        //if other interval valid
                    } else {
                        // set both interval ends to valid
                        echo "enters 40";
                        $id=substr($cookie_name, strpos($cookie_name, "/")+1);
                        $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric, false);
                        $filtersArray[$id]=$filterOne;
                        $filterOne = new FilterDataObj($ok, $otherIntervalId, NULL, $otherValue, $name, $isNumeric, false);
                        $filtersArray[$otherIntervalId]=$filterOne;
                    }
            }
            else if($ok==false)
            {
                echo "enters 50";
            $id=substr($cookie_name, strpos($cookie_name, "/")+1);
            $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric);
            $filtersArray[$id]=$filterOne;
            } 
            // if the first interval not valid, set both intervals as not valid
            else if($ok == true && $otherIntervalId!=NULL && $value == 'any') {
                echo "enters 56";
                $otherCookie=$_COOKIE[$name."/".$otherIntervalId];
                $otherValue=substr($otherCookie, 0, strpos($otherCookie, '/'));
                $id=substr($cookie_name, strpos($cookie_name, "/")+1);
                $filterOne = new FilterDataObj($ok, $id, $otherIntervalId, $value, $name, $isNumeric, false);
                $filtersArray[$id]=$filterOne;
                $filterOne = new FilterDataObj($ok, $otherIntervalId, NULL, $otherValue, $name, $isNumeric, false);
                $filtersArray[$otherIntervalId]=$filterOne;
            }
        }
        return $filtersArray;
    }
}

?>