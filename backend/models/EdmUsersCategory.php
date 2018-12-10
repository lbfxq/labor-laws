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

class EdmUsersCategory extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edm_users_category';
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