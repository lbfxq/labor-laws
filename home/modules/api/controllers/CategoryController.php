<?php
/**
 * @author:Alading
 * Date: 2017/10/18 0018
 */

namespace app\modules\api\controllers;

use Yii;
use yii\web\Response;
use app\modules\api\controllers\ApiController;
use common\models\DataCategory;

class CategoryController extends ApiController
{
    public $formatType="json";
    /**
     * 获得分类信息
     */
    public function actionData()
    {
        $flag="success";
        $category_id=Yii::$app->request->get("cid",0);
        $category= DataCategory::getTree($category_id);
        return ['code'=>$flag,'data'=>$category];
    }
   
}