<?php 

class EncryptionHelper {
    private $encryptionKey = '8i3L+wsZ0+M/t2girYsLwTA2F5tBWLE2JFNUxTg875oamsdmGvMUqmfiuPZk/hvm';

    // Function to encrypt the data
    public function encryptData($data) {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($data, $cipher, $this->encryptionKey, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    // Function to decrypt the data
    public function decryptData($data) {
        $cipher = "aes-256-cbc";
        $data = base64_decode($data);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($data, 0, $ivlen);
        $encrypted = substr($data, $ivlen);
        return openssl_decrypt($encrypted, $cipher, $this->encryptionKey, 0, $iv);
    }
}


?>