<?php
/**
 * @author:Alading
 * Date: 2017/10/18 0018
 */

namespace app\modules\api\controllers;

use Yii;
use yii\web\Response;
use app\modules\api\controllers\ApiController;
use common\models\DataContact;
use common\models\DataApply;

class FormController extends ApiController
{
    public $formatType="json";
    /**
     * 联系我们
     */
    public function actionContact()
    {
        $flag="success";
        $data =urldecode(file_get_contents("php://input"));
        $data = str_replace(array("\r\n", "\r", "\n"), " ", $data);
        $data=json_decode($data,true);
    
        //var_dump($data);exit;

        $model= new DataContact();
        $model->setAttributes($data,false);
        $flag=$model->save();
        if(!$flag){
            $flag="fail";
        }
        return ['code'=>$flag];
    }
    /**
     * 会员申请
     */
    public function actionApply()
    {
         $flag="success";
        $data =urldecode(file_get_contents("php://input"));
        $data = str_replace(array("\r\n", "\r", "\n"), " ", $data);  
        $data=json_decode($data,true);
    
        $data['apply_date']=$data['year']."-".$data['month']."-".$data['day'];

        $model= new DataApply();
        $model->setAttributes($data,false);
        $flag=$model->save();
        if(!$flag){
            $flag="fail";
        }
        return ['code'=>$flag];
    }
   
}