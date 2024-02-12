<?php
include_once('./component/security/data_encpt.php');
include_once('config.php');
class User extends DbConnection{
    
    public function __construct(){
 
        parent::__construct();
    }
 
 public function checkMember($username, $password) {
    $passwordEncryptor = new PasswordEncryptor();
    $sql = "SELECT acc_id, acc_pass FROM accounts WHERE acc_user = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($acc_id, $storedPasswordHash);

    while ($stmt->fetch()) {
        // ตรวจสอบรหัสผ่านที่ถูกเข้ารหัส
        if ($passwordEncryptor->decryptPassword($password, $storedPasswordHash)) {
            return $acc_id; // คืนค่า ID ของบัญชีที่ตรงกัน
        }
    }

    return false; // ไม่พบผู้ใช้
}

    
    
    

public function updateMember($username, $newUsername, $newPassword) {
    // ตรวจสอบว่ามีการรับค่ารหัสผ่านใหม่หรือไม่
    if (!empty($newPassword)) {
        $passwordEncryptor = new PasswordEncryptor();
        // เข้ารหัสรหัสผ่านใหม่ก่อนที่จะบันทึกลงในฐานข้อมูล
        $encryptedPassword = $passwordEncryptor->encryptPassword($newPassword);

        $sql = "UPDATE accounts SET acc_name = ?, acc_pass = ? WHERE acc_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $newUsername, $encryptedPassword, $username);
        $stmt->execute();

        // ตรวจสอบว่ามีการอัปเดตข้อมูลหรือไม่
        if ($stmt->affected_rows > 0) {
            return true; // อัปเดตสำเร็จ
        } else {
            return false; // ไม่สามารถอัปเดตข้อมูลได้
        }
    } else {
        // หากไม่มีการรับค่ารหัสผ่านใหม่ ไม่ต้องทำการอัปเดตรหัสผ่าน
        // แต่ยังอัปเดตชื่อบัญชี (acc_name) ได้
        $sql = "UPDATE accounts SET acc_name = ? WHERE acc_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $newUsername, $username);
        $stmt->execute();

        // ตรวจสอบว่ามีการอัปเดตข้อมูลหรือไม่
        if ($stmt->affected_rows > 0) {
            return true; // อัปเดตสำเร็จ
        } else {
            return false; // ไม่สามารถอัปเดตข้อมูลได้
        }
    }
}





    public function checkUsesMember($username) {
        $sql = "SELECT * FROM accounts WHERE acc_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    
        if (!empty($rows)) {
            return $rows; // ถ้ามี username ซ้ำคืนค่าข้อมูลผู้ใช้ทั้งหมด
        } else {
            return false; // ถ้าไม่ซ้ำคืนค่า false
        }
    }
    
    public function responDataSQL($conn, $data, $userid) {
        $sql = "SELECT $data FROM accounts WHERE acc_id = $userid";
        $result = $conn->query($sql);
    
        // ตรวจสอบว่ามีข้อมูลที่ได้รับหรือไม่
        if ($result->num_rows > 0) {
            // ดึงข้อมูลเป็น array
            $row = $result->fetch_assoc();
    
            // คืนค่าข้อมูลที่ดึงได้
            return $row[$data];
        } else {
            // ถ้าไม่พบข้อมูล
            return "ไม่พบข้อมูล";
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



    public function createUser($username, $password,$name) {
    

        // Example SQL statement, modify as needed
        $sql = "INSERT INTO accounts (acc_user, acc_pass, acc_name) VALUES (?, ?, ?)";
        
        // Use prepared statement to prevent SQL injection
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $name);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // User creation successful
        } else {
            return false; // User creation failed
        }
    }


}