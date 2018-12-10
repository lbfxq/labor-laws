<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use common\models\DataCategory;
use common\models\DataArticle;
use app\services\CommonServices;

class ArticleController extends Controller
{
    
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $id=Yii::$app->request->get("id",0);

        $data=DataArticle::find()->where(['status'=>1,'id'=>$id])->one();
        $ads_hf=CommonServices::getAds("ads_home_hf",1);
        $ads_rf=CommonServices::getAds("ads_home_rf",1);

        $category=DataCategory::findOne($data->category_id);
        $cids=DataCategory::getIdsByParent($data->category_id,$data->category_id);
        $categorydata=DataArticle::find()->where(['status'=>1])->andwhere("category_id in (".$cids.")")->andwhere("id !=".$id)->orderBy("rank desc,id desc")->limit(6)->all();
        if($data){
            $data->clicknum+=1;
            $data->save();
        }

        $this->getView()->title = $data->title;
        return $this->render('index',['data'=>$data,'ads_hf'=>$ads_hf,'ads_rf'=>$ads_rf,'category'=>$category,'categorydata'=>$categorydata]);
    }
}
