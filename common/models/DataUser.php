<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/5/16
 * Time: 14:15
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class DataUser extends ActiveRecord
{
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_user';
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => 1],
            ['created', 'default', 'value' => date("Y-m-d H:i:s")],
            ['updated', 'default', 'value' => date("Y-m-d H:i:s")],
        ];
    }

    public static function findById($id)
    {
        return static::findOne(['id' => $id, 'status' => 1]);
    }

    public function getStatus(){
        if($this->status=='1'){
            return "启用";
        }elseif($this->status=='2'){
            return "禁止";
        }else{
            return "删除";
        }
    }



}