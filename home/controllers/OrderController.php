<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use app\services\PaymentServices;
use common\models\DataVideo;
use common\models\DataOrder;
use common\utils\CommUtil;
use yii\base\Exception;

class OrderController extends Controller
{
    private $_loginuserinfo=false;

    public function beforeAction($action){
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
    public function actionIndex($vid)
    {
       $channels=PaymentServices::getPaymentChannel();
       $video=DataVideo::find()->where(['id'=>$vid,'status'=>1])->one();
       if(!$video){
            throw new Exception("请求错误", 1);
       }
       return $this->render('index',['channels'=>$channels,'video'=>$video]);
    }
    /**
     *
     * @return string
     */
    public function actionTopay(){
        $vid=Yii::$app->request->post("vid","");
        $channel=Yii::$app->request->post("channel","");

        if(empty($channel)){
            throw new Exception("请求错误", 1);
        }else{
            list($channel_id,$channel_name)=explode("-", $channel);
        }

        $video=DataVideo::find()->where(['id'=>$vid,'status'=>1])->one();
        if(!$video){
            throw new Exception("请求错误", 1);
        }


        $orderno=CommUtil::getOrderNo();
        $ordermodel= new DataOrder();
        $userinfo=$this->_loginuserinfo;
        $now=date("Y-m-d H:i:s");
        $data=['user_id'=>$userinfo['id'],'order_no'=>$orderno,'pay_channel_id'=>$channel_id,'pay_channel'=>$channel_name,'pay_money'=>$video->price,'product_id'=>$video->id,'product'=>$video->title,'status'=>1,'created'=>$now,'updated'=>$now];
        $ordermodel->setAttributes($data,false);
        if($ordermodel->save()){
            $parms=[
                'payid'=>$channel_id,
                'app_order_no'=>$orderno,
                'amount'=>$video->price*100,
                'product'=>$video->title,
                'pnote'=>''
            ];
            $payurl=PaymentServices::getPayUrl($parms);
            if(!empty($payurl)){
                $this->redirect($payurl);
            }else{
                throw new Exception("请求错误", 1);
            }
        }else{
            throw new Exception("请求错误", 1);
        }
    }
}
