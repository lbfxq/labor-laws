<?php
namespace common\services;
use Yii;
use common\services\RedisKeysServices;

use common\models\AdAds;
use common\models\AdChannel;
use common\models\AdPosition;

/**
 * 广告的服务
 * Class AdsServices
 * @package common\services
 */
class AdsServices
{
	/**
	*更新广告缓存
	*/
    public static function updateAds(){
        $positions=AdPosition::find()->select("code,show_num")->where(['status'=>1])->asArray()->all();
        $ads=[
            'ads_data'=>[
                'pc'=>Adads::getAdsByAdType('pc'),
                'android'=>Adads::getAdsByAdType('android'),
                'ios'=>Adads::getAdsByAdType('ios'),
            ],
            [
            'positions'=>$positions
            ],
        ];
        
        $res=json_encode($ads);
        $redis=Yii::$app->redis;
        $redis->set(RedisKeysServices::BASE_ADS,$res);
       
        return $res;
    }
    /**
    *获取广告缓存
    */
    public static function getAdds(){
        $redis=Yii::$app->redis;
        $res=$redis->get(RedisKeysServices::BASE_ADS);
        if(!$res){
            $res=self::updateAds();
        }
        $res=json_decode($res,true);
        return $res;
    }

}