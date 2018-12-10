<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/12
 * Time: 10:36
 */

namespace common\models;


use Yii;
use yii\db\ActiveRecord;
use common\models\DataUser;

class DataOrder extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_order';
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
        switch ($this->status) {
            case '1':
                return "待支付";
                break;
             case '2':
                return "成功";
                break;
             case '3':
                return "失败";
                break;
             case '4':
                return "取消";
                break;
            case '9':
                return "删除";
                break;
            default:
                # code...
                break;
        }
    }

    public function getUser()
    {
        return $this->hasOne(DataUser::className(), ['id' => 'user_id']);
    }
}