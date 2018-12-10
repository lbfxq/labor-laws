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
use common\models\DataPosition;
use common\services\AdsServices;

class DataAds extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_ads';
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
            case '0':
                return "禁用";
                break;
             case '1':
                return "启用";
                break;
            default:
                # code...
                break;
        }
    }

    public function getPosition()
    {
        return $this->hasOne(DataPosition::className(), ['id' => 'position_id']);
    }
}