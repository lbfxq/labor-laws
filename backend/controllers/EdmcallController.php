<?php

namespace app\controllers;

use Yii;
use app\models\EdmCategory;
use app\models\EdmSendHistory;
use app\models\EdmSendHistoryCallback;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MemberController implements the CRUD actions for EdmCategory model.
 */
class EdmcallController extends Controller
{
    public function actionIndex(){
        $postdata=Yii::$app->request->post();
        Yii::error("callback:".json_encode($postdata));
        $msgid=isset($postdata['Message-Id'])?$postdata['Message-Id']:"";
        $event=isset($postdata['event'])?$postdata['event']:"";
        $res="fail";
        if(!empty($msgid)){
            $sddata=EdmSendHistory::find()->where(['message_id'=>$msgid])->one();
            if($sddata){
                $sddata->message_status=$event;
                $sddata->save();
                $hcdata=['send_history_id'=>$sddata->id,'message-id'=>$msgid,'event'=>$event,'postdata'=>json_encode($postdata),'created'=>date("Y-m-d H:i:s")];
                $hcmodel= new EdmSendHistoryCallback();
                $hcmodel->setAttributes($hcdata,false);
                $hcmodel->save();
                $res="success";
            }
        }
        echo $res;
    }
}
