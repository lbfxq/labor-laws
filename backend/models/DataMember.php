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

class DataMember extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_member';
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
            return "启用";
        }else{
            return "停用";
        }
    }
}