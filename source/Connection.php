<?php  
    namespace Source; 
    class Connection
    {
        private $pdo;
        public function connect()
        {
            try
            {                                
                $this->pdo = new \PDO("mysql:host=localhost:3306;dbname=trabalho_php","teste","teste", 
                array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));                 
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $this->pdo;
            }
            catch (\PDOException $ex) {
                return null;
            }   
        }        
    }   
?>