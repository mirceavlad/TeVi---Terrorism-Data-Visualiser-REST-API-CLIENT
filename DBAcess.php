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
        public function addAttack(array $attakDataMap) {
            $columnsToInsert = '';
            $valuesToInsert = '';
            foreach ($attakDataMap as $key => $value) {
                $columnsToInsert = $columnsToInsert."".$key.",";
                $valuesToInsert = $valuesToInsert."'".$value."',";
            }
            $columnsToInsert = substr($columnsToInsert, 0, -1);
            $valuesToInsert = substr($valuesToInsert, 0, -1);
            echo 'INSERT INTO ATTACKS('.$columnsToInsert.') VALUES('.$valuesToInsert.')';
            if(!self::$mysql -> query('INSERT INTO ATTACKS('.$columnsToInsert.') VALUES('.$valuesToInsert.')')) {
                printf("%s",self::$mysql->error);
            }
        }
        //mircea
        //selects all attacks
        public function selectAll(){
            if(!self::$mysql -> query('SELECT country_txt,iyear,weaptype1_txt FROM ATTACKS'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT country_txt,iyear,weaptype1_txt FROM ATTACKS');
        }
        
        //octavian
        //selects all from the terror db, converts it to a json,
        //returns a string representing data as json
        public function selectAllAsJson() {
            $query_results = self::selectAll();
            return self::toJsonString($query_results);
        }
        
        //mircea
        //selects attacks between 2 nr
        public function selectBetween($nr,$country,$year,$weapon){
            if($country=='Any')
                $country='%';
            if($year=='Any')
                $year='%';
            if($weapon=='Any')
                $weapon='%';
            if(!self::$mysql -> query('SELECT country_txt,iyear,weaptype1_txt FROM ATTACKS  WHERE country_txt LIKE "'.$country.'" AND iyear LIKE "'.$year.'" AND weaptype1_txt LIKE "'.$weapon.'"'.'LIMIT '.$nr.',3500'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT country_txt,iyear,weaptype1_txt FROM ATTACKS  WHERE country_txt LIKE "'.$country.'" AND iyear LIKE "'.$year.'" AND weaptype1_txt LIKE "'.$weapon.'"'.'LIMIT '.$nr.',3500');
            
        }
        
        
        //octavian
        //selects attacks between 2 nr
        //returns a string representin data as json
        public function selectBetweenJson($nr, $country, $year, $weapon) {
            $queryResult = self::selectBetween($nr, $country, $year, $weapon);
            return self::toJsonString($queryResult);
        }
        
        //mircea
        //selects total nr of attacks
        public function totalNr($country,$year,$weapon){
            if($country=='Any')
                $country='%';
            if($year=='Any')
                $year='%';
            if($weapon=='Any')
                $weapon='%';
            if(!self::$mysql -> query('SELECT COUNT(*) AS NR ,country_txt,iyear,weaptype1_txt FROM ATTACKS WHERE country_txt LIKE "'.$country.'" AND iyear LIKE "'.$year.'" AND weaptype1_txt LIKE "'.$weapon.'"'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT COUNT(*) AS NR ,country_txt,iyear,weaptype1_txt FROM ATTACKS WHERE country_txt LIKE "'.$country.'" AND iyear LIKE "'.$year.'" AND weaptype1_txt LIKE "'.$weapon.'"');;
        }

        //maria
        //selects total nr of attacks
        //returns a string representin data as json
        public function totalNrJson($country,$year,$weapon){
            $queryResult = self::totalNr($country,$year,$weapon);
            return self::toJsonString($queryResult);
        }
        
        //mircea
        //select by country, year and weapon
        public function selectBy($country,$year,$weapon){
            if($country=='Any')
                $country='%';
            if($year=='Any')
                $year='%';
            if($weapon=='Any')
                $weapon='%';
            if(!self::$mysql -> query('SELECT country_txt,iyear,weaptype1_txt FROM ATTACKS WHERE country_txt LIKE "'.$country.'" AND iyear LIKE "'.$year.'" AND weaptype1_txt LIKE "'.$weapon.'"'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT country_txt,iyear,weaptype1_txt FROM ATTACKS WHERE country_txt LIKE "'.$country.'" AND iyear LIKE "'.$year.'" AND weaptype1_txt LIKE "'.$weapon.'"');
        }

        //maria
         //select by country, year and weapon
        //returns a string representin data as json
        public function selectByJson($country,$year,$weapon){
            $queryResult = self::selectBy($country,$year,$weapon);
            return self::toJsonString($queryResult);
        }
        
        //mircea
        //get all countries
        public function getCountries(){
            if(!self::$mysql -> query('SELECT DISTINCT country_txt FROM ATTACKS ORDER BY country_txt'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT DISTINCT country_txt FROM ATTACKS ORDER BY country_txt');
        }

        //maria
        //get all countries
        //returns a string representin data as json
        public function getCountriesJson(){
            $queryResult = self::getCountries();
            return self::toJsonString($queryResult);
        }
        
        //mircea
        //get all years
        public function getYears(){
            if(!self::$mysql -> query('SELECT DISTINCT iyear FROM ATTACKS ORDER BY iyear'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT DISTINCT iyear FROM ATTACKS ORDER BY iyear');
        }

        //maria
         //get all years
        //returns a string representin data as json
        public function getYearsJson(){
            $queryResult = self::getYears();
            return self::toJsonString($queryResult);
        }
        
        //mircea
        //get all weapons
        public function getWeapons(){
            if(!self::$mysql -> query('SELECT DISTINCT weaptype1_txt FROM ATTACKS ORDER BY weaptype1_txt'))
                printf("%s",self::$mysql->error);
            else return self::$mysql->query('SELECT DISTINCT weaptype1_txt FROM ATTACKS ORDER BY weaptype1_txt');
        }

        //maria
        //get all weapons
       //returns a string representin data as json
       public function getWeaponsJson(){
        $queryResult = self::getWeapons();
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
    }
    ?>
