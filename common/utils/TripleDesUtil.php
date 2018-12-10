<?php
/**
 * des加密解密
 * 用法如下
 *  use common\utils\CryptDesUtil;
 *  CryptDesUtil::encrypt("test1","sdfas*sd");
 *  echo CryptDesUtil::decrypt("CMoFz8IxAOY=","sdfas*sd");
 */
namespace common\utils;


class TripleDesUtil
{

    public static function genIvParameter() {  
        return mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_TRIPLEDES,MCRYPT_MODE_CBC), MCRYPT_RAND);  
    }  
  
    private static function pkcs5Pad($text, $blocksize) {  
        $pad = $blocksize - (strlen($text) % $blocksize); // in php, strlen returns the bytes of $text  
        return $text . str_repeat(chr($pad), $pad);  
    }  
  
    private static function pkcs5Unpad($text) {  
        $pad = ord($text{strlen($text)-1});  
        if ($pad > strlen($text)) return false;  
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;  
        return substr($text, 0, -1 * $pad);  
    }  
  
    public static function encrypt($plain_text, $key,$iv) {  
        $padded = self::pkcs5Pad($plain_text, mcrypt_get_block_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_CBC));  
        return mcrypt_encrypt(MCRYPT_TRIPLEDES, $key, $padded, MCRYPT_MODE_CBC,$iv);  
    }  
  
    public static function decrypt($cipher_text, $key,$iv) {  
        $plain_text = mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $cipher_text, MCRYPT_MODE_CBC,$iv);  
        return self::pkcs5Unpad($plain_text);  
    }  
}