<?php
class DBAcess {
    //octavian
    private static $instance = null;
    private static $mysql = null;
    private function __construct()
    {
        if (mysqli_connect_errno()) {
            die ('Conexiunea a esuat...');
        }
        self::$mysql = new mysqli (
                                   'localhost', // locatia serverului (aici, masina locala)
                                   'root',       // numele de cont
                                   '',    // parola (atentie, in clar!)
                                   'terrordb'   // baza de date
                                   );
    }
    
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new DBAcess();
        }
        return self::$instance;
    }
    
    //creates the ATTACKS table, having columns names as given in the $headersArray
    public function createTerrorTable($headersArray) {
        $queryHeaders = "";
        foreach($headersArray as $columnName){
            $queryHeaders = $queryHeaders. " " .$columnName. " TEXT,";
        }
        $queryHeaders = substr($queryHeaders, 0, -1);
        
        if(!self::$mysql -> query('CREATE TABLE ATTACKS ('.$queryHeaders.')')) {
            printf("%s",self::$mysql->error);
        }
    }
    
    //adds an attak to the attaks table
    //@param $attackDataMap, an array acting as a map, mapping the each column name with a value,
    //where the key value(array index) should be a string representing the columnName and the value
    //should be a string representing the value to be added at the respective column
    public function addAttack(array $attakDataMap, $verbose = false) {
        foreach ($attakDataMap as $key => $value) {
            if((strpos($key, '\'') !== false || strpos($value, '\'') !== false)) {
                echo $key."".$value."not alphanumeric";
                return;
            }
        }
        $columnsToInsert = '';
        $valuesToInsert = '';
        foreach ($attakDataMap as $key => $value) {
            $columnsToInsert = $columnsToInsert."".$key.",";
            $valuesToInsert = $valuesToInsert."'".$value."',";
        }
        $columnsToInsert = substr($columnsToInsert, 0, -1);
        $valuesToInsert = substr($valuesToInsert, 0, -1);
        if(!self::$mysql -> query('INSERT INTO ATTACKS('.$columnsToInsert.') VALUES('.$valuesToInsert.')') && !$verbose) {
            printf("%s",self::$mysql->error);
        }
        if($verbose) {
            echo "{\"status\": 200, \"description\":\"object created\"}";
        }
    }
    
    public function getAvailableFilterValuesAsJson($filtersDict) {
        $res = self::getAttacksByFilters($filtersDict);
        return self::mapPosibileFiltersValuesToJson($res);
    }
    
    public function getAllAvailableFilters() {
        $res = self::selectAll();
        return self::mapPosibileFiltersValuesToJson($res);
    }
    
    private function generateWhereClauseFromUserFilters($filtersDict) {
        $whereClause = "WHERE";
        $firstIntervalHead = null;
        $secondIntervalHead = null;
        $isInitial = true;
        $isInitialInterval = true;
        if(isset($filtersDict["intervals"])) {
            $intervals = $filtersDict["intervals"];
            foreach($intervals as $intervalFieldName => $intervalEndpoints) {
                $isInitial = true;
                $isInitialInterval = true;
                foreach($intervalEndpoints as $index => $intervalEndpoint) {
                    if($isInitial) {
                        if($whereClause == "WHERE") {
                            $whereClause = $whereClause." ( ";
                        } else {
                            $whereClause = $whereClause." AND ( ";
                        }
                        $isInitial = false;
                    }
                    if($index % 2 == 0) {
                        $firstIntervalHead = $intervalEndpoint;
                    } else {
                        $secondIntervalHead = $intervalEndpoint;
                        if($secondIntervalHead < $firstIntervalHead) {
                            $swap = $firstIntervalHead;
                            $firstIntervalHead = $secondIntervalHead;
                            $secondIntervalHead = $swap;
                        }
                        if($isInitialInterval) {
                            $whereClause = $whereClause." ".'CAST('.$intervalFieldName.' AS DECIMAL(50))'.' BETWEEN '.$firstIntervalHead.''." AND ".$secondIntervalHead;
                        } else {
                            $whereClause = $whereClause." OR ".'CAST('.$intervalFieldName.' AS DECIMAL(50))'.' BETWEEN '.$firstIntervalHead.''." AND ".$secondIntervalHead;
                        }
                        $isInitialInterval = false;
                        if(array_key_last($intervalEndpoints) == $index) {
                            if(isset($filtersDict[$intervalFieldName])) {
                                foreach($filtersDict[$intervalFieldName] as $filterValue) {
                                    $whereClause = $whereClause." OR ".$intervalFieldName." LIKE '".$filterValue."'";
                                }
                                unset($filtersDict[$intervalFieldName]);
                            }
                            $whereClause = $whereClause.") ";
                        }
                    }
                }
            }
        }
        $isInitial = true;
        foreach($filtersDict as $filterName => $filterValues) {
            if($filterName != "intervals") {
                $isInitial = true;
                foreach($filterValues as $key => $val) {
                    if($isInitial && $whereClause == "WHERE") {
                        $whereClause = $whereClause." ( ".$filterName." LIKE '".$val."'";
                    } else if($isInitial) {
                        $whereClause = $whereClause." AND ( ".$filterName." LIKE '".$val."'";
                    } else {
                        $whereClause = $whereClause." OR ".$filterName." LIKE '".$val."'";
                    }
                    if(array_key_last($filterValues) == $key) {
                        $whereClause = $whereClause.") ";
                    }
                    $isInitial = false;
                }
            }
        }
        return $whereClause;
    }
    
    public function getAttacksByFilters($filtersDict, $limit = null) {
        $whereClause = self::generateWhereClauseFromUserFilters($filtersDict);
        $res = null;
        if($limit == null) {
            $res = self::$mysql->query('SELECT * FROM ATTACKS '.$whereClause);
        } else {
            $res = self::$mysql->query('SELECT * FROM ATTACKS '.$whereClause.' LIMIT '.$limit.',3500');
        }
        return $res;
    }
    
    public function getAttacksByFiltersAsJson($filtersDict, $limit = null) {
        $res = null;
        $res = self::getAttacksByFilters($filtersDict,$limit);
        return self::toJsonString($res);
    }
    
    
    public function selectAll($limit = null) {
        if($limit != null) {
            $res = self::$mysql->query('SELECT * FROM ATTACKS LIMIT '.$limit.',3500');
            return $res;
        }
        $res = self::$mysql->query('SELECT * FROM ATTACKS');
        return $res;
    }

    private function generateSetColumnStatement($withQueryValues) {
        $query = "UPDATE ATTACKS SET ";
        $isInitial = true;
        foreach($withQueryValues as $field => $value) {
            if($isInitial) {
                $query = $query." ".$field." = ".$value;
            } else {
                $query = $query.", ".$field." = ".$value;
            }
        }
        return $query;
    }

    public function deleteAttacks($filtersMap) {
        $whereClause = self::generateWhereClauseFromUserFilters($filtersMap["for_attacks_matching"]);
        $query = "DELETE FROM ATTACKS ".$whereClause;
        echo $query;
        self::$mysql->query($query); 
        if(self::$mysql->error != "") {
            echo "{\"status:\": 404}";
        }
    }

    public function updateAttacks($withQueryValues) {
        $query = self::generateSetColumnStatement($withQueryValues["values_to_update"])." ".self::generateWhereClauseFromUserFilters($withQueryValues["for_attacks_matching"]);
         self::$mysql -> query($query);
         if(self::$mysql -> error != "") {
            echo "{\"status:\": 404}";
         } else {
            echo "{\"status:\": 200, \"description\":\"object updated\"}";
         }
    }
    
    public function generateAndSendCsv($res) {
        $filename = uniqid().".csv";
        $filePointer = fopen($filename, "w+");
        $writeHeaders = 1;
        while($attack = $res -> fetch_assoc()) {
            if($writeHeaders == 1) {
                fputcsv($filePointer, array_keys($attack));
                $writeHeaders = 0;
            }
            fputcsv($filePointer, $attack);
        }

        fclose($filePointer);
        if (file_exists($filename)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            readfile($filename);
        }
        unlink($filename);
    }

    //octavian
    //selects all from the terror db, converts it to a json,
    //returns a string representing data as json
    public function selectAllAsJson($limit = null) {
        $query_results = self::selectAll($limit);
        return self::toJsonString($query_results);
    }
    
    //octavian
    //selects attacks between 2 nr
    //returns a string representin data as json
    public function selectBetweenJson($nr, $country, $year, $weapon) {
        if((strpos($weapon, '\'') !== false || strpos($year, '\'') !== false || strpos($country, '\'') !== false)) {
            echo "status 400 bad request";
            return;
        }
        $queryResult = self::selectBetween($nr, $country, $year, $weapon);
        return self::toJsonString($queryResult);
    }
    

    //milea octavian
    // encodes a db query into a json, (key: int, value-> array of each db select result), and a pair(key: "size", value: "int"))
    // which represents the numberof results;
    private function toJsonString($fromQuery) {
        $resultsCount = 0;
        $resultsArrayMapping = array();
        while($attacks = $fromQuery -> fetch_assoc()) {
            $resultsArrayMapping[$resultsCount] = $attacks;
            $resultsCount = $resultsCount + 1;
        }
        $resultsArrayMapping["dataSz"] = $resultsCount;
        return json_encode($resultsArrayMapping);
    }
    
    private function mapPosibileFiltersValuesToJson($fromQuery) {
        $filtersOutputMap = array();
        $filtersArray = array();
        while($attack = $fromQuery -> fetch_assoc()) {
            foreach($attack as $column => $value) {
                //if(!isset($filtersOutputMap[$column])) {
                //  $filtersOutputMap[$column] = array();
                // }
                if(!isset($filtersOutputMap[$column])) {
                    $filtersOutputMap[$column] = array();
                }
                $filtersOutputMap[$column][$value] = 1;
            }
        }
        return json_encode($filtersOutputMap);
    }
}
?>
