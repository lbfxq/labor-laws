<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
/**
 * MemberController implements the CRUD actions for DataArticle model.
 */
class UploadController extends Controller
{

    /**
    * 上传图片
    */
    public function actionIndex(){
        $imagepath="";
        $cb = @$_REQUEST['CKEditorFuncNum']; //获得ck的回调id
        //$cb=empty($cb)?1:$cb;
        $errmsg="上传失败";
        $images = UploadedFile::getInstancesByName("upload");  
        if (count($images) > 0) {  
            $image=$images[0];
            if ($image->size > 2048 * 1024) {   
                $errmsg="图片最大不可超过2M";
            }
            if (!in_array(strtolower($image->extension), array('gif', 'jpg', 'jpeg', 'png'))) {  
                $errmsg="请上传标准图片文件, 支持gif,jpg,png和jpeg.";
            }
            $dir = 'uploads/imgs/'.date("Ymd")."/";  
            //生成唯一uuid用来保存到服务器上图片名称  
            $pickey = uniqid();  
            $filename = $pickey . '.' . $image->getExtension();  

            //如果文件夹不存在，则新建文件夹  
            if (!file_exists(Yii::getAlias('@assetspath') . '/' . $dir)) {  
                FileHelper::createDirectory(Yii::getAlias('@assetspath') . '/' . $dir, 0777);  
            }  
            $filepath = realpath(Yii::getAlias('@assetspath') . '/' . $dir) . '/';  
            $file = $filepath . $filename; 

            if ($image->saveAs($file)) {  
                $baseurl=Yii::$app->params['assets'];
                $imagepath = $baseurl.$dir . $filename; 
            }  
        }  
         
        
        if(!empty($imagepath)){
            $data=['filename'=>$filename,'uploaded'=>1,'url'=>$imagepath];
        }else{
            $data['error']=['number'=>109,'message'=>$errmsg];
        }

        echo json_encode($data);

        /*if(!empty($imagepath)){
            echo "<script>window.parent.CKEDITOR.tools.callFunction(".$cb.", '".$imagepath."', '');</script>";
        }else{
            echo "<script>window.parent.CKEDITOR.tools.callFunction(".$cb.", '', '".$errmsg."');</script>";
        }*/

        exit;
    }
}
