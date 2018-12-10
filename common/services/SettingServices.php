<?php
namespace common\services;
use Yii;
use common\services\RedisKeysServices;
use common\models\DataPass;
use common\models\DataDekaron;
use common\models\DataSetting;
use common\models\DataPassBoard;
use common\models\DataProduct;

/**
 * 返回客户端状态类型
 * Class ResultStatusServices
 * @package common\services
 */
class SettingServices
{
	/**
	*获取基本配置信息
	*/
    public static function getBaseSetting(){
    	$redis=Yii::$app->redis;
    	$res=$redis->get(RedisKeysServices::BASE_SETTING);
    	if(!$res){
    		$res=self::setBaseSetting();
    	}
    	$res=json_decode($res,true);
    	return $res;
    }
    /**
	*获取闯关配置信息
	*/
    public static function getPassSetting(){
    	$redis=Yii::$app->redis;
    	$res=$redis->get(RedisKeysServices::PASS_KEYS);
    	if(!$res){
    		$res=self::setPassSetting();
    	}
    	$res=json_decode($res,true);
    	return $res;
    }
    /**
    *获取当前挑战配置信息
    */
    public static function getCurrentDekaronSetting(){
        $redis=Yii::$app->redis;
        $res=$redis->get(RedisKeysServices::CURRENT_DEKARON_KEYS);
        if(!$res){
            $res=self::setCurrentDekaronSetting();
        }
        $res=json_decode($res,true);
        return $res;
    }
    /**
    *设置基本配置信息
    */
    public static function setBaseSetting(){
        $redis=Yii::$app->redis;
        $data=DataSetting::find()->Select("item_key,item_value")->all();
        foreach ($data as $key => $value) {
            $res[$value->item_key]=$value->item_value;
        }
        $res=json_encode($res);
        $redis->set(RedisKeysServices::BASE_SETTING,$res);
    
        return $res;
    }

    /**
    *设定闯关配置信息
    */
    public static function setPassSetting(){
        $redis=Yii::$app->redis;
        $data=DataPass::find()->Select("id,name,level,base_score,size,max_num,max_num_enum")->asArray()->all();
        
        $res=json_encode($data);
        $redis->set(RedisKeysServices::PASS_KEYS,$res);
        return $res;
    }

    /**
    *设定当前的挑战配置信息 
    */
    public static function setCurrentDekaronSetting(){
        $redis=Yii::$app->redis;
        $today=date("Y-m-d");
        $data=DataDekaron::find()
        ->Select("id,base_score,size,max_num,max_num_enum,sum,content,start_date,end_date,reward1,reward2,reward3,reward4")
        ->where(['status'=>1])
        ->andwhere(['<=','start_date',$today])
        ->andwhere(['>=','end_date',$today])
        ->asArray()
        ->one();
        if($data){

            $content=json_decode($data['content'],true);
            $rescontent=[];
            foreach ($content as $k => $v) {
                $rescontent=array_merge($rescontent,$v);
            }
            $content=$rescontent;
            $data['content']=$content;
            $res=json_encode($data);
        }else{
            $res="";
        }
        
        $redis->set(RedisKeysServices::CURRENT_DEKARON_KEYS,$res);
        return $res;
    }

    /**
    *设定产品信息
    */
    public static function setProduct(){
        $redis=Yii::$app->redis;
        $data=DataProduct::find()->Select("ptype,code,apple_code,google_code,name,price,gold,des")->where(['status'=>1])->orderBy("rank asc")->asArray()->all();
        $res=json_encode($data);
        $redis->set(RedisKeysServices::BASE_PRODUCT,$res);
        return $res;
    }
    /**
    *获取产品信息
    */
    public static function getProduct(){
        $redis=Yii::$app->redis;
        
        $res=$redis->get(RedisKeysServices::BASE_PRODUCT);
        if(!$res){
            $res=self::setProduct();
        }
        $res=json_decode($res,true);
        return $res;
    }


}