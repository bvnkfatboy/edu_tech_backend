<?php
include_once('config.php');
 
class User extends DbConnection{
 
    public function __construct(){
 
        parent::__construct();
    }
 
    public function check_login($username, $password){
        $sql = "SELECT * FROM accounts WHERE acc_user = '$username' AND acc_pass = '$password'";
        $query = $this->conn->query($sql);
 
        if($query->num_rows > 0){
            $row = $query->fetch_array();
            return $row['acc_id'];
        }
        else{
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