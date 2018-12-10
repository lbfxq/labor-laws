<?php
/**
 * @author:Alading
 * Date: 2017/10/18 0018
 */

namespace app\modules\api\controllers;

use Yii;
use yii\web\Response;
use yii\rest\Controller;
use yii\filters\Cors;

class ApiController extends Controller
{
    public $formatType="json";

    public function behaviors(){
        $behaviors = parent::behaviors();
        switch($this->formatType)
        {
            default :
            case 'json' :
            case 'jsonp' :
                $formatType = Response::FORMAT_JSON;
                $behaviors['contentNegotiator']['formats'] = [];
                $behaviors['contentNegotiator']['formats']['application/json'] = $formatType;
                break;
            case 'xml' :
                $formatType = Response::FORMAT_XML;
                $behaviors['contentNegotiator']['formats'] = [];
                $behaviors['contentNegotiator']['formats']['application/xml'] = $formatType;
                break;            
            case 'html' :
                $formatType = Response::FORMAT_HTML;
                $behaviors['contentNegotiator']['formats'] = [];
                $behaviors['contentNegotiator']['formats']['html/text'] = $formatType;
                break;
        }

        $behaviors['corsFilter']['class']=Cors::class;
        //return ArrayHelper::merge([['class' => Cors::className()]], $behaviors);
        return $behaviors;
    }
}