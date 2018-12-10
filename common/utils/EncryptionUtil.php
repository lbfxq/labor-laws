<?php
/** 
 *加密字符串 
 * 
 * 
 * @author      libin<hansen.li@silksoftware.com> 
 * @version     1.0 
 * @since       1.0 
 */  
namespace common\utils;

use Yii;
use yii\helpers\Json;


class EncryptionUtil
{
   /**
     * 采用HashHmac方法获取加密的字符串
     * @param unknown $data  需要加密的字符串
     * @param string  $secret  加密秘钥
     * @return string|boolean
     */
    public static function encryptHashHmac($data, $secret) {
        $str=hash_hmac('sha256', $data,$secret, $raw = false);
        //$str=base64_encode($str);
        return $str;
    }

    /**
     * 采用md5方法获取加密的字符串
     * @param unknown $data  需要加密的字符串
     * @param string  $secret  加密秘钥
     * @return string|boolean
     */
    public static function encryptMd5($data, $secret="") {
        $str=md5($data.$secret);
        return $str;
    }

    /**
     * 采用AES方式加密
     * @param $data
     * @return 返回数据流
     */
    public static function encryptAES($data)
    {
        //$encryptByteStream=openssl_encrypt(Json::encode($data),'AES-128-CBC',Yii::$app->params['aes_decrypt_key']);
        $encryptByteStream=openssl_encrypt('abcd你好','AES-128-CBC',Yii::$app->params['aes_decrypt_key'], 0,'dsfa9p8y098hasdf');
        return $encryptByteStream;
    }

    /**采用AES方式解密
     * @param $data
     * @return 数组字典
     */
    public static function decryptAES($data)
    {
        $decryptByteStream=openssl_decrypt($data,'AES-128-CBC',Yii::$app->params['aes_decrypt_key'], 0,'dsfa9p8y098hasdf');
        return $decryptByteStream;
        return Json::decode($decryptByteStream);
    }

}
