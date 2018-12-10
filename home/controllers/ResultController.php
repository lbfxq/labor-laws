<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\UserServices;
use app\services\PaymentServices;
use common\models\DataVideo;
use common\models\DataOrder;
use common\utils\CommUtil;

class ResultController extends Controller
{

    /**
     *
     * @return string
     */
    public function actionIndex($vid)
    {
      
       return $this->render('index',[]);
    }
   
}
