<?php
/**
 * @author:Alading
 * Date: 2017/10/18 0018
 */

namespace app\modules\api\controllers;

use Yii;
use yii\web\Response;
use app\modules\api\controllers\ApiController;
use common\models\DataUser;

class LoginController extends ApiController
{
    public $formatType="json";
    /**
     * 登录
     */
    public function actionLogin()
    {
        $uname=Yii::$app->request->get("uname","");
        $pwd=Yii::$app->request->get("pwd","");
        $flag="fail";
        $userinfo=DataUser::find()->where(['email'=>$uname,'status'=>1])->one();
        if($userinfo){
            $repwd=$userinfo->pwd;
            if($repwd==md5($pwd)){
                $session=Yii::$app->getSession();
                $loginusrinfo=['id'=>$userinfo->id,'name'=>$userinfo->name];
                $session->set("loginusrinfo",$loginusrinfo);
                $flag="success";
            }
        }
        return ['code'=>$flag];
    }
    /**
    * 获得登录账号信息
    */
    public function actionInfo(){
        $flag="fail";
        $session=Yii::$app->getSession();
        $userinfo=$session->get("loginusrinfo");
        $data=[];
        if(isset($userinfo['id'])){
            $flag="success";
            $data=['name'=>$userinfo['name']];
        }
        return ['code'=>$flag,'data'=>$data];
    }

    /**
    * 退出登录
    */
    public function actionOut(){
        $flag="success";
        $session = \Yii::$app->session;
        unset($session['loginusrinfo']);
        return ['code'=>$flag];
    }
}