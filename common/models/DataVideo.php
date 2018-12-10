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

class DataVideo extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }
    public function getCategory()
    {
        return $this->hasOne(DataCategory::className(), ['id' => 'category_id']);
    }
    
    public function getStatus(){
        if($this->status=='1'){
            return "启用";
        }elseif($this->status=='2'){
            return "禁用";
        }else{
            return "删除";
        }
    }
}