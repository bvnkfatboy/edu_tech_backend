<?php


$myURL = 'http://' . $_SERVER['HTTP_HOST'] . '/edu_tech_backend/';

#dist/img/logo.png
$favicon = "https://www.oar.ubu.ac.th/new/img/OAR_UBU2.png";
$logo = "https://www.oar.ubu.ac.th/new/img/OAR_UBU2.png";

// if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//     $ip_address = $_SERVER['HTTP_CLIENT_IP'];
// } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//     $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
// } else {
//     $ip_address = $_SERVER['REMOTE_ADDR'];
// }
// echo "IP Address: $ip_address";

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
