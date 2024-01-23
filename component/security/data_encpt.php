<?php 
class PasswordEncryptor {
    public function encryptPassword($password) {
        // สร้าง hash จากรหัสผ่าน
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function decryptPassword($userInputPassword, $storedPasswordHash) {
        // ตรวจสอบรหัสผ่าน
        return password_verify($userInputPassword, $storedPasswordHash);
    }
}


?>