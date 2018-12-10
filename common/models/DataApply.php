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

class DataApply extends ActiveRecord
{
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_apply';
    }

    public function rules()
    {
        return [
            ['created', 'default', 'value' => date("Y-m-d H:i:s")],
        ];
    }
}