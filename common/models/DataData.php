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

class DataData extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }
}