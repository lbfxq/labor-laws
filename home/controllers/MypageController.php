<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use common\models\DataOrder;
use yii\data\Pagination;


class MypageController extends Controller
{
    private $_loginuserinfo=false;

    public function beforeAction($action){
        $this->layout="mypage";
        $session=Yii::$app->getSession();
        $uinfo=$session->get("uinfo");
        if(isset($uinfo['id'])){
            $this->_loginuserinfo=$uinfo;
            return parent::beforeAction($action);
        }else{
            $this->redirect(['login/index']);
            return false;
        }
    }
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index',['userinfo'=>$this->_loginuserinfo]);
    }

    /**
     *
     * @return string
     */
    public function actionOrder()
    {
        $userinfo=$this->_loginuserinfo;
        $obj=DataOrder::find()->where(['user_id'=>$userinfo['id']]);
        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 4]);
        $orders=$obj->orderBy("created desc")->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('order',['orders'=>$orders,'pages'=>$pages]);
    }
}
