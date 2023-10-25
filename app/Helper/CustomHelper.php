<?php

use App\Models\Booking;

if (!function_exists('encryptId')) {
    function encryptId($id) {
        $key = "developerawam"; // Secret key for encryption
        $cipher = "aes-256-cbc";
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));

        $encryptedId = openssl_encrypt($id, $cipher, $key, 0, $iv);
        $combinedData = $iv . $encryptedId;
        return base64_encode($combinedData);
    }
}

if (!function_exists('decryptId')) {
    function decryptId($encryptedId) {
        $key = "developerawam"; // Secret key for encryption
        $cipher = "aes-256-cbc";
        $data = base64_decode($encryptedId);
        $ivLength = openssl_cipher_iv_length($cipher);
        $iv = substr($data, 0, $ivLength);
        $encryptedData = substr($data, $ivLength);

        $decryptedId = openssl_decrypt($encryptedData, $cipher, $key, 0, $iv);
        return $decryptedId;
    }
}

if (!function_exists('checkHouseStatus')) {
    function checkHouseStatus($house_id, $house_block_id) {

        $data = Booking::where('house_id', $house_id)
                            ->where('house_block_id', $house_block_id)
                            ->first();
        return $data;
    }
}
