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

class ProOrder extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_order';
    }
 
    public function getStatus(){
        if($this->status=='1'){
            return "待支付";
        }elseif($this->status=='2'){
            return "已支付";
        }elseif($this->status=='3'){
            return "已取消";
        }else{
            return "删除";
        }
    }
}