<?php
namespace common\utils;

use Yii;


class HttpUtil
{
   /**
     * post数据到指定地址
     * @param unknown $url
     * @param string $post_data
     * @return string|boolean
     */
    public static function post($url, $post_data = null) {
        $post_fields = "";
        if (isset($post_data) && is_string($post_data) && strlen($post_data) > 0) $post_fields = $post_data;
        else if (isset($post_data) && is_array($post_data) && count($post_data) > 0) $post_fields = http_build_query($post_data, null, '&', PHP_QUERY_RFC3986);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        $result = curl_exec($ch);
        $curl_info = curl_getinfo($ch);
        $info = $curl_info['url'] . '|' . $curl_info['http_code'] . '|' . $curl_info['total_time'];
        $header_size = $curl_info['header_size'];
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        $success = true;
        $uri = $_SERVER["REQUEST_URI"];
        if ($curl_info['http_code'] == 0 || $curl_info['http_code'] >= 400) {
            $success = false;
        }
        curl_close($ch);
        if ($success) {
            return $body;
        }
        return false;
    }
    
    /**
     * 
     */
    public static function get($url){
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT,20);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}
