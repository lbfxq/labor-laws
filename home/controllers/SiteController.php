<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use common\models\DataCategory;
use common\models\DataArticle;
use common\models\DataSetting;
use app\services\CommonServices;

class SiteController extends Controller
{
    /*public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 6000,
                'variations' => [
                    BROWSER,
                ]
            ],
        ];
    }*/


    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $recommend = DataArticle::find()->where(['is_recommand' => 2, 'status' => 1])->orderBy("rank desc,id desc")->limit(12)->all();

        $ads_hf = CommonServices::getAds("ads_home_hf", 1);
        $ads_rf = CommonServices::getAds("ads_home_rf", 1);

        $menus = CommonServices::getMenus();
        $catedata = [];
        foreach ($menus as $key => $value) {
            $cids=DataCategory::getIdsByParent($value->id,$value->id);
            $adata = DataArticle::find()->where(['status' => 1])->andwhere("category_id in (".$cids.")")->orderBy("rank desc,id desc")->limit(6)->all();
            if ($adata) {
                $md = ['name' => $value->name, 'articles' => $adata];
                $catedata[] = $md;
            }
        }
        return $this->render('index', ['recommend' => $recommend, 'catedata' => $catedata, 'ads_hf' => $ads_hf, 'ads_rf' => $ads_rf]);
    }

    public function actionAbout(){
        $aboutdata=DataSetting::find()->where(['item_key'=>"about"])->one();

        $content=isset($aboutdata->item_value)?$aboutdata->item_value:"";
        $ads_hf = CommonServices::getAds("ads_home_hf", 1);
        $ads_rf = CommonServices::getAds("ads_home_rf", 1);
        return $this->render('about', ['data' => $content, 'ads_hf' => $ads_hf, 'ads_rf' => $ads_rf]);
    }
}
