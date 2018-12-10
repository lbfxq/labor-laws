<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\DataMember;

class BaseController extends Controller
{
    public $logincheck=true;
    public $loginuserinfo="";

    public function beforeAction($action) {
        if($this->logincheck){
             $session=Yii::$app->getSession();
             $loginuserinfo=$session->get('loginuserinfo');
             if($loginuserinfo){
                $this->loginuserinfo=$loginuserinfo;
             }else{
                return $this->redirect(['login/index'])->send();
             }
        }
        return parent::beforeAction($action);
    }
}
