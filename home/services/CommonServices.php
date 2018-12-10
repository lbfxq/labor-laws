<?php
namespace app\services;
use Yii;
use common\models\DataCategory;
use common\models\DataAds;
use common\models\DataPosition;
use common\models\DataVideo;
use common\models\DataUserVideo;
use common\models\DataArticle;


/**
 * 客户的处理
 * Class UserServices
 * @package common\services
 */
class CommonServices
{
    /**
    *获取支付渠道
    * @parm $client
    */
    public static function getMenus(){
        $menus=DataCategory::find()->where(['parent_id'=>0])->all();
        return $menus;
    }
    /**
    * 获取广告信息
    * @parm $client
    */
    public static function getAds($position,$limit=""){
        $ads=[];
        $posdata=DataPosition::find()->where(['code'=>$position,'status'=>1])->one();
        if($posdata){
            if(empty($limit)){
                $ads=DataAds::find()->where(['position_id'=>$posdata->id,'status'=>1])->all();
            }elseif($limit==1){
                $ads=DataAds::find()->where(['position_id'=>$posdata->id,'status'=>1])->one();
            }else{
                $ads=DataAds::find()->where(['position_id'=>$posdata->id,'status'=>1])->limit($limit)->all();
            }
        }
        return $ads;
    }
    /**
    * 获取热门视屏信息
    * @parm $client
    */
    public static function getHotVideos($category_id="",$limit=10){
        $obj=DataVideo::find()->where(['status'=>1,'is_hot'=>2]);
        if(intval($category_id)>0){
            $obj->andwhere(['category_id'=>$category_id]);
        }
        $data=$obj->limit($limit)->all();
        return $data;
    }

    /**
    * 获取热门文章信息
    * @parm $client
    */
    public static function getHotArticles($category_id="",$limit=10){
        $obj=DataArticle::find()->where(['status'=>1,'is_hot'=>2]);
        if(intval($category_id)>0){
            $obj->andwhere(['category_id'=>$category_id]);
        }
        $data=$obj->orderBy("rank desc,id desc")->limit($limit)->all();
        return $data;
    }

    /**
    * 获取推荐视屏信息
    * @parm $client
    */
    public static function getRecommandVideos($category_id="",$limit=10){
        $obj=DataVideo::find()->where(['status'=>1,'is_recommand'=>2]);
        if(intval($category_id)>0){
            $obj->andwhere(['category_id'=>$category_id]);
        }
        $data=$obj->limit($limit)->all();
        return $data;
    }

    /**
    * 获取推荐文章信息
    * @parm $client
    */
    public static function getRecommandArticles($category_id="",$limit=10){
        $obj=DataArticle::find()->where(['status'=>1,'is_recommand'=>2]);
        if(intval($category_id)>0){
            $obj->andwhere(['category_id'=>$category_id]);
        }
        $data=$obj->orderBy("rank desc,id desc")->limit($limit)->all();
        return $data;
    }
    /**
    * 判断是否有阅读视频权限
    * @parm $client
    */
    public static function checkVideo($user_id,$viedo_id){
        $num=DataUserVideo::find()->where(['user_id'=>$user_id,'video_id'=>$viedo_id])->count();
        if($num >0){
            return true;
        }else{
            return false;
        }
    }
    
}