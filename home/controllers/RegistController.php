<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use common\utils\ValidateUtil;
use common\models\DataUser;
use common\utils\phpmailer\PHPMailer;

class RegistController extends Controller
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
                if(ValidateUtil::isEmail($email)){
                    $usersnum=DataUser::find()->where(['email'=>$email])->andwhere('status !=1 and status !=9')->count();
                    if($usersnum ==0){
                        $checkcode=time();
                        $data=['email'=>$email,'pwd'=>md5($pwd),'checkcode'=>$checkcode,'status'=>1];

                        $model=DataUser::find()->where(['email'=>$email,'status'=>1])->one();
                        if(!$model){
                            $model=new DataUser();
                        }
                        $model->setAttributes($data,false);
                        if($model->save()){

                            $prefixurl=Yii::$app->request->getHostInfo().Yii::$app->request->getBaseUrl();
                            $activeurl=$prefixurl."/regist/active?email=".urlencode($email)."&code=".$checkcode;

                            $mailer=new PHPMailer();
                            $mailer->isSMTP();
                            $mailer->IsHTML(true);  // send as HTML
                            $mailer->CharSet = "utf-8";   // 这里指定字符集！  
                            $mailer->From = Yii::$app->params['smtp']['mailfrom'];      // 发件人邮箱 
                            $mailer->FromName  = Yii::$app->params['smtp']['mailfromname'];      // 发件人邮箱 
                            $mailer->SMTPAuth = true;
                            $mailer->Host = Yii::$app->params['smtp']['host'];
                            $mailer->Username  = Yii::$app->params['smtp']['account'];
                            $mailer->Password  = Yii::$app->params['smtp']['password'];
                            $mailer->Subject   = "会员注册成功-666律师网";
                            $mailer->Body    = "你已经成功注册了666律师网的会员，请点击以下连接激活账号:<br /><a href='".$activeurl."'>激活</a>";
                            $mailer->addAddress($email);
                            $mailer->send();
        
                            $this->redirect(['login/index']);
                        }else{
                            $errormsg="注册失败!";
                        }
                    }else{
                         $errormsg="邮箱已经存在!";
                    }   
                }else{
                    $errormsg="邮箱格式不正确!";
                }
            }else{
                $errormsg="用户名和密码不能为空!";
            }
        }



        return $this->render('index',['errormsg'=>$errormsg]);
    }
    /**
    * 激活邮箱
    */
    public function actionActive()
    {
        $email=Yii::$app->request->get("email","");
        $code=Yii::$app->request->get("code","");
        $user=DataUser::find()->where(['email'=>$email,'checkcode'=>$code,'status'=>1])->one();
        if($user){
            $user->status =2;
            $user->save();
            $this->redirect(['login/index']);
        }
        return $this->render('active');
    }
    /**
    * 忘记密码
    */
    public function actionForget()
    {
        
        return $this->render('forget');
    }
}
