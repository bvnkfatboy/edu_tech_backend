<?php
include_once('config.php');
include_once('./component/security/data_encpt.php');
class User extends DbConnection{
 
    public function __construct(){
 
        parent::__construct();
    }
 
    public function checkLogin($username, $password) {
        $sql = "SELECT * FROM accounts WHERE acc_user = ? AND acc_pass = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row['acc_id'];
        } else {
            return false;
        }
    }
 
    public function details($sql){
        $query = $this->conn->query($sql);
        $row = $query->fetch_array();
        return $row;       
    }
 
    public function escape_string($value){
 
        return $this->conn->real_escape_string($value);
    }




}