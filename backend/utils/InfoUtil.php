<?php

namespace app\utils;

use Yii;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/15
 * Time: 18:48
 */
class InfoUtil extends \yii\base\Object
{
    /**
     * 显示信息
     * @param Controller $controller
     * @param $info
     * @param string $name
     * @return string
     * @internal param $errorinfo
     */
    public static function Info(Controller $controller, $info)
    {
        $controller->layout =false;

        $backURL = Yii::$app->request->referrer;

        $data['backURL'] = $backURL;
        $data['info'] = $info;
        return $controller->render('/site/info', $data);
    }

    /**
     * 显示错误
     * @param Controller $controller
     * @param $info
     * @return string
     * @internal param string $name
     */
    public static function Error(Controller $controller, $info)
    {
        $controller->layout = false;

        $backURL = Yii::$app->request->referrer;

        $data['backURL'] = $backURL;
        $data['info'] = $info;
        return $controller->render('/site/error', $data);
    }

    /**
     *  后退
     */
    public static function goBack()
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer);
    }


}