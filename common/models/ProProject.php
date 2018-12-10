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

class ProProject extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_project';
    }
 
    public function getCategory()
    {
        return $this->hasOne(ProCategory::className(), ['id' => 'category_id']);
    }
    
    public function getStatus(){
        if($this->status=='1'){
            return "上线";
        }elseif($this->status=='2'){
            return "下线";
        }else{
            return "删除";
        }
    }
}