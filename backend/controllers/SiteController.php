<?php

namespace app\controllers;

use app\utils\InfoUtil;
use Yii;
use app\controllers\BaseController;


class SiteController extends BaseController
{
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $session=Yii::$app->getSession();
        $members=$session->get("loginuserinfo");

        return $this->render('index');
    }
    /**
     *
     * @return string
     */
    public function actionInfo()
    {
        return $this->render('info');
    }
    /**
     *
     * @return string
     */
    public function actionAdd()
    {
        return $this->render('add');
    }
}
