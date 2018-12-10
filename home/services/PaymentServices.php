<?php
namespace app\services;
use Yii;
use common\models\DataUser;
use common\utils\HttpUtil;


/**
 * 客户的处理
 * Class UserServices
 * @package common\services
 */
class PaymentServices
{
    /**
    *获取支付渠道
    * @parm $client
    */
    public static function getPaymentChannel($client="pc"){
        $url=Yii::$app->params['payment']['url'];
        $url.="/pay/channel?";
        $parms=[
            'AppID'=>Yii::$app->params['payment']['AppID'],
            'client'=>$client,
        ];
        $sign=self::getSign($parms,Yii::$app->params['payment']['AppKey']);
        $parms['sign']=$sign;
        $query=http_build_query($parms);
        $url.=$query;

        $res=HttpUtil::get($url);
        $res=json_decode($res);
        if($res->result == '0x00'){
            return $res->data;
        }else{
            return false;
        }
    }
    /**
    * 获取支付跳转地址
    * @parm $client
    */
    public static function getPayUrl($parm){
        $url=Yii::$app->params['payment']['url'];
        $url.="/pay/pay?";

        $parms=[
            'AppID'=>Yii::$app->params['payment']['AppID'],
            'payid'=>@$parm['payid'],
            'app_order_no'=>@$parm['app_order_no'],
            'amount'=>@$parm['amount'],
            'product'=>@$parm['product'],
            'pnote'=>@$parm['pnote']
        ];
        $sign=self::getSign($parms,Yii::$app->params['payment']['AppKey']);
        $parms['sign']=$sign;

        $query=http_build_query($parms);
        $url.=$query;

        return $url;
    }
    
     /**
    *获取加密字符串
    * @parm $parm
    * @parm $key
    */
    public static function getSign($parm,$key){
        ksort($parm);
        $parm = array_map("urlencode", $parm);
        $str = implode("", $parm);
        $signcode = md5($str . $key);
        return $signcode;
    }
}