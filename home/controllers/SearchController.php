<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use common\models\DataCategory;
use common\models\DataArticle;
use app\services\CommonServices;
use yii\data\Pagination;

class SearchController extends Controller
{
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $keywords=Yii::$app->request->get("keywords","");


        $obj=DataArticle::find()->where(['status'=>1]);
        if(!empty($keywords)){
            $obj->andwhere("title like '%".$keywords."%'");  
        }

        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 4]);
        $datas=$obj->orderBy("rank desc,id desc")->offset($pages->offset)->limit($pages->limit)->all();

        $ads_hf=CommonServices::getAds("ads_home_hf",1);
        $ads_rf=CommonServices::getAds("ads_home_rf",1);
        return $this->render('index',['datas'=>$datas,'pages'=>$pages,'keywords'=>$keywords,'ads_hf'=>$ads_hf,'ads_rf'=>$ads_rf]);
    }
}
