<?php

namespace App\Utils;

class TokenGenerator {

    private static function get_key() {
        # key is specified using hexadecimal
        $key = pack('H*', "3bcb04b7e103a0cd8bd54763051cef08bc732d8f055abe029fdebae5e169a40xd417e2ffb2a00a3");
        return $key;
    }

    public static function generate() {

        $plaintext = bin2hex(openssl_random_pseudo_bytes(5)).'.'.TokenGenerator::generate_hash_ip().'.'.bin2hex(openssl_random_pseudo_bytes(5));

        // return TokenGenerator::encrypt($plaintext);
        return base64_encode($plaintext);
    }

    public static function encrypt($plaintext) {
        # create a random IV to use with CBC encoding
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        # creates a cipher text compatible with AES (Rijndael block size = 128)
        # to keep the text confidential 
        # only suitable for encoded input that never ends with value 00h
        # (because of default zero padding)
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, TokenGenerator::get_key(), $plaintext, MCRYPT_MODE_CBC, $iv);

        # prepend the IV for it to be available for decryption
        $ciphertext = $iv . $ciphertext;

        # encode the resulting cipher text so it can be represented by a string
        $ciphertext_base64 = base64_encode($ciphertext);

        return $ciphertext_base64;
    } 

    public static function decrypt($ciphertext_base64) {

        # create a random IV to use with CBC encoding
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

        $ciphertext_dec = base64_decode($ciphertext_base64);
        
        # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
        
        # retrieves the cipher text (everything except the $iv_size in the front)
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);
    
        # may remove 00h valued characters from end of plain text
        $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, TokenGenerator::get_key(), $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

        return $plaintext_dec;
    }

    public static function generate_hash_ip() { 
        $ip = IPUtil::get_ip_address();
        return base64_encode(sha1($ip));
    }

    public static function generate_by_time() { 
        return ((time() + rand(10,100000)).":". time().":".(time() + rand(10,1000)).":".(time() + rand(19999,199900)));
    }

    public static function get_hash_ip($token) {
        $token = explode(".", base64_decode($token));
        if(count($token) > 0) {
            return $token[1];
        } else {
            return "";
        }
    }

    public static function validate($access_token) { 

        // $ip = IPUtil::get_ip_address();
        // $validate = $ip == '127.0.0.1' ? true : IPUtil::validate_ip($ip);

        // if($validate) {
        //     $token = TokenGenerator::generate_hash_ip();
        //     $access_token = str_replace("Bearer ", '', $access_token);
        //     // $plaintext = TokenGenerator::decrypt($access_token);
        //     $plaintext = $access_token;
        //     if (TokenGenerator::get_hash_ip($plaintext) == $token) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // } else {
        //     return false;
        // }

        $access_token = str_replace("Bearer ", '', $access_token);
        if ($access_token == "TjJVM1lXWTFObVFYcE5NMDV0VFhkT1YxbDZUbTFWZDA=") {
            return true;
        }

        return false;

    }


    public static function setCookie($token) {
        // 1 Day expired
        setcookie('_hfjeo', $token, time() + (86400 * 1), "/");
    }

    public static function checkCookie() {
        if(!isset($_COOKIE['_hfjeo'])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}