<?php
namespace app\services;
use Yii;
use common\models\DataUser;


/**
 * 客户的处理
 * Class UserServices
 * @package common\services
 */
class UserServices
{
    /**
    *判断登录状态
    */
    public static function getLoginInfo(){
        $session=Yii::$app->getSession();
        $uinfo=$session->get("uinfo");
        
        if($uinfo){
            return $uinfo;
        }else{
            return false;
        }
    }
}