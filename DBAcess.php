<?php
class DBAcess {
    private static $instance = null;
    private static $mysql = null;
    private function __construct()
    {
        if (mysqli_connect_errno()) {
            die ('Conn error');
        }
        $this -> mysql = new mysqli (
                             'localhost', // locatia serverului (aici, masina locala)
                             'root',       // numele de cont
                             '',    // parola (atentie, in clar!)
                             'notes'   // baza de date
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
}
?>
