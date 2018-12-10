<?php

namespace app\controllers;

use app\utils\InfoUtil;
use Yii;
use yii\web\Controller;
use app\models\DataMember;

class LoginController extends Controller
{
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main-login';
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        if(empty($username)|| empty($password)){
            return $this->render('index');
        }else{
            $members=DataMember::find()->select("id,name")->where(['username'=>$username,'pwd'=>md5($password),'status'=>1])->one();
            if($members){
                $session=Yii::$app->getSession();
                $session->set("loginuserinfo",$members);
                $this->redirect(['site/index']);
            }else{
                return $this->render('index');
            }
        }
    }
    /**
    * 退出登录
     */ 
    public function actionOut()
    {
        $session = \Yii::$app->session;
        unset($session['loginuserinfo']);
        $this->redirect(['login/index']);
    }

}
