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
use app\models\EdmCategory;

class EdmUsers extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edm_users';
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
            return "待验证";
        }elseif($this->status=='2'){
            return "可用";
        }elseif($this->status=='3'){
            return "停用";
        }elseif($this->status=='4'){
            return "废弃";
        }else{
            return "删除";
        }
    }

    public static function getStatusName($st){
        if($st=='1'){
            return "待验证";
        }elseif($st=='2'){
            return "可用";
        }elseif($st=='3'){
            return "停用";
        }elseif($st=='4'){
            return "废弃";
        }else{
            return "删除";
        }
    }

    /* public function getCategory()
    {
        return $this->hasOne(EdmCategory::className(), ['id' => 'category_id']);
    }*/
}