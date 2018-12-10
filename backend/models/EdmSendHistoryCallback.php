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

class EdmSendHistoryCallback extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edm_send_history_callback';
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