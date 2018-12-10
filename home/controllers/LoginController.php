<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use common\models\DataUser;

class LoginController extends Controller
{
    public function beforeAction($action){
        
        $this->layout="member";
        return parent::beforeAction($action);
    }
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $errormsg="";
        if(Yii::$app->request->isPost){
            $email=Yii::$app->request->post("email","");
            $pwd=Yii::$app->request->post("pwd","");
            if($email && $pwd){
                $model=DataUser::find()->where(['email'=>$email,'status'=>2])->one();
                if($model && md5($pwd)==$model->pwd){
                    $uinfo=['id'=>$model->id,'email'=>$model->email];
                    $session=Yii::$app->getSession();
                    $session->set("uinfo",$uinfo);
                    $this->redirect(['mypage/index']);
                }else{
                    $errormsg="邮箱或者密码不正确!";
                }
               
            }else{
                $errormsg="用户名和密码不能为空!";
            }
        }
        return $this->render('index',['errormsg'=>$errormsg]);
    }
    /**
    *退出登录
    */
    public function actionOut()
    {
        $session=Yii::$app->getSession();
        $session->remove("uinfo");
        $this->redirect(['login/index']);
    }
}
