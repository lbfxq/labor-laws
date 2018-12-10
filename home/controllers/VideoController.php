<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use common\models\DataCategory;
use common\models\DataVideo;
use app\services\CommonServices;

class VideoController extends Controller
{
    
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $id=Yii::$app->request->get("id",0);

        $video=DataVideo::find()->where(['status'=>1,'id'=>$id])->one();
        $ads_hf=CommonServices::getAds("ads_home_hf",1);
        $ads_rf=CommonServices::getAds("ads_home_rf",1);

        $category=DataCategory::findOne($video->category_id);
        $categoryvideos=DataVideo::find()->where(['category_id'=>$video->category_id,'status'=>1])->andwhere("id !=".$id)->limit(8)->all();


        return $this->render('index',['video'=>$video,'ads_hf'=>$ads_hf,'ads_rf'=>$ads_rf,'category'=>$category,'categoryvideos'=>$categoryvideos]);
    }
}
