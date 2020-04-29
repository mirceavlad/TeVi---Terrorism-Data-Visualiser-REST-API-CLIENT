<?php
class DBAcess {
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
}
?>
