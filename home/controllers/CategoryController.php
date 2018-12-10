<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use common\models\DataCategory;
use common\models\DataArticle;
use app\services\CommonServices;
use yii\data\Pagination;
use yii\base\Exception;

class CategoryController extends Controller
{
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $category_id=Yii::$app->request->get("cid",0);
        $category= DataCategory::findOne($category_id);
        $datas=[];
        if($category){

            $obj=DataArticle::find()->where(['status'=>1]);
            $cids=DataCategory::getIdsByParent($category_id,$category_id);
            $obj->andwhere("category_id in (".$cids.")");

            $totalCount = $obj->count();
            $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 9]);

            $datas=$obj->orderBy("rank desc,id desc")->offset($pages->offset)->limit($pages->limit)->all();


            $ads_hf=CommonServices::getAds("ads_home_hf",1);
            $ads_rf=CommonServices::getAds("ads_home_rf",1);
            $recommend = DataArticle::find()->where(['is_recommand' => 2, 'status' => 1])->andwhere("category_id in (".$cids.")")->orderBy("rank desc,id desc")->limit(3)->all();
            $this->getView()->title = $category->name;

            return $this->render('index',['datas'=>$datas,'recommend'=>$recommend,'pages'=>$pages,'category'=>$category,'ads_hf'=>$ads_hf,'ads_rf'=>$ads_rf]);
        }else{
            throw new Exception("请求错误", 1);
        }
        
    }
}
