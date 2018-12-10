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

class EdmCategory extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edm_category';
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
        }elseif($this->status=='2'){
            return "停用";
        }else{
            return "删除";
        }
    }
}