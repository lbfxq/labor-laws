<?php

namespace app\controllers;

use Yii;
use common\models\DataSetting;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\services\SettingServices;
use common\models\DataData;


/**
 * 闯关关卡设定
 */
class SettingController extends Controller
{

    /**
     * Lists all DataMember models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->request->isPost){
            $pass=Yii::$app->request->post("setting");
            if(count($pass)>0 && is_array($pass)){
                foreach ($pass as $key => $value) {
                    $passid=$value['id'];
                    $passmodel=DataSetting::find()->where(['id'=>$passid])->one();
                    $passmodel->setAttributes($value,false);
                    $passmodel->save();
                }
            }
        }
        
        $data=DataSetting::find()->all();
        return $this->render('index', [
            'data' => $data,
        ]);
    }
    /**
     * Lists all DataMember models.
     * @return mixed
     */
    public function actionData()
    {
        $data=DataData::findOne(1);
        
        return $this->render('data', [
            'data' => $data,
        ]);
    }

}
