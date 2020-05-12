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

//mircea
//get all countries
public function getCountries(){
    if(!self::$mysql -> query('SELECT DISTINCT country_txt FROM ATTACKS ORDER BY country_txt')) 
            printf("%s",self::$mysql->error);
        else return self::$mysql->query('SELECT DISTINCT country_txt FROM ATTACKS ORDER BY country_txt');
}

//mircea
//get all years
public function getYears(){
    if(!self::$mysql -> query('SELECT DISTINCT iyear FROM ATTACKS ORDER BY iyear')) 
            printf("%s",self::$mysql->error);
        else return self::$mysql->query('SELECT DISTINCT iyear FROM ATTACKS ORDER BY iyear');
}

//mircea
//get all weapons
public function getWeapons(){
    if(!self::$mysql -> query('SELECT DISTINCT weaptype1_txt FROM ATTACKS ORDER BY weaptype1_txt')) 
            printf("%s",self::$mysql->error);
        else return self::$mysql->query('SELECT DISTINCT weaptype1_txt FROM ATTACKS ORDER BY weaptype1_txt');
}

}
?>
