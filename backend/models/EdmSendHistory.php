<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/12
 * Time: 10:36
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class EdmSendHistory extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edm_send_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }
    public function getStatus(){
        if($this->status=='1'){
            return "待发送";
        }elseif($this->status=='2'){
            return "已发送";
        }elseif($this->status=='3'){
            return "发送失败";    
        }else{
            return "删除";
        }
    }
}