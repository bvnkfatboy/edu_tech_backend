<?php
class DbConnection{
 
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'edu_tech_db';
 
    protected $conn;
 
    public function __construct(){
 
        if (!isset($this->conn)) {
 
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
 
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
 
        return $this->conn;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>