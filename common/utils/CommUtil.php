<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/5/16
 * Time: 19:04
 */

namespace common\utils;


class CommUtil
{
    /**
     * 通过路径方式读取数组参数
     * @param $dataList array源数据
     * @param $keyPath  参数取值路径，使用点号分割 "init.gold"
     * @param null $defaultValue
     * @return null
     */
    public static function getArrayParamByPath($dataList, $keyPath, $defaultValue = null)
    {
        if (!isset($keyPath)) return $defaultValue;

        $keyPathList = explode(".", $keyPath);

        $lastData = $dataList;
        foreach ($keyPathList as $key) {
            if (!isset($lastData[$key])) return $defaultValue;//字段不存在返回

            $lastData = $lastData[$key];
        }

        return $lastData;
    }

    /**
     * 生成订单号
     *
     * @return string
     */
    public static function getOrderNo()
    {
        //建议用uuid，用bigint型，uniquid
        $orderno=date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8).rand(100, 999);
    
        return $orderno;
    }

    /**
     * 格式化时间
     * @param $time
     * @return false|string
     */
    public static function formatDate($time)
    {
        return date('Y-m-d H:i:s', $time);
    }

    /**
     * 产生随机数字
     * @param $len
     * @return string
     */
    public static function getRandomNum($len)
    {
        $code = '';
        for ($i = 0; $i < $len; $i++) {
            $code .= rand(0, 9);
        }

        return $code;
    }



    /*
    *    版本号比较  by sam 20170412
    *    @param $version1 版本A 如:5.3.2 
    *    @param $version2 版本B 如:5.3.0 
    *    @return int -1版本A小于版本B , 0版本A等于版本B, 1版本A大于版本B
    *
    *    版本号格式注意：
    *        1.要求只包含:点和大于等于0小于等于2147483646的整数 的组合
    *        2.boole型 true置1，false置0
    *        3.不设位默认补0计算，如：版本号5等于版号5.0.0
    *        4.不包括数字 或 负数 的版本号 ,统一按0处理
    *
    *    @example:
    *       if (versionCompare('5.2.2','5.3.0')<0) {
    *            echo '版本1小于版本2';
    *       }
    */
    public static function versionCompare($versionA,$versionB) {
        if ($versionA>2147483646 || $versionB>2147483646) {
            throw new Exception('版本号,位数太大暂不支持!','101');
        }
        $dm = '.';
        $verListA = explode($dm, (string)$versionA);
        $verListB = explode($dm, (string)$versionB);

        $len = max(count($verListA),count($verListB));
        $i = -1;
        while ($i++<$len) {
            $verListA[$i] = intval(@$verListA[$i]);
            if ($verListA[$i] <0 ) {
                $verListA[$i] = 0;
            }
            $verListB[$i] = intval(@$verListB[$i]);
            if ($verListB[$i] <0 ) {
                $verListB[$i] = 0;
            }

            if ($verListA[$i]>$verListB[$i]) {
                return 1;
            } else if ($verListA[$i]<$verListB[$i]) {
                return -1;
            } else if ($i==($len-1)) {
                return 0;
            }
        }
    }

    //获取ip地址
    public static function getIP() {
            if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
            }
            elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            }
            elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
            }
            elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');

            }
            elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
            }
            else {
            $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
    } 
    /**
    *  字符串截取
    */
    public static function showSubStr($str,$len,$replace="..."){
        $strlen=mb_strlen($str,'utf8');
        if($strlen > $len){
            $str=mb_substr($str,0,$len,'utf8');
            $str.=$replace;
        }
        return $str;
    }

}