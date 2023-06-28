<?php
    namespace App;
    class connect {
        public $con;
        public function __construct(){
            try {        
            //echo "ok";
            $this->con = new \PDO($_ENV["DSN"].":host=".$_ENV["HOST"].";dbname=".$_ENV["DBNAME"].";user=".$_ENV["USER"]."; password=".$_ENV["PASSWORD"]."; port=".$_ENV["PORT"]);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }    
        }
    }

?>