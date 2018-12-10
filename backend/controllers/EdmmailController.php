<?php

namespace app\controllers;

use Yii;
use app\models\EdmMails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
/**
 * MemberController implements the CRUD actions for EdmMails model.
 */
class EdmmailController extends Controller
{
    /**
     * Lists all EdmMails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $obj=EdmMails::find();
        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('index', [
            'data' => $data,'pages'=>$pages
        ]);
    }

    /**
     * Creates a new EdmMails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new EdmMails();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        
        return $this->render('create', []);
    }

    /**
     * Updates an existing EdmMails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing EdmMails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the EdmMails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EdmMails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EdmMails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
    * 上传图片
    */
    public function actionUpload(){
        $imagepath="";
        $cb = $_GET['CKEditorFuncNum']; //获得ck的回调id
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
            $dir = 'uploads/mail/';  
            //生成唯一uuid用来保存到服务器上图片名称  
            $pickey = uniqid();  
            $filename = $pickey . '.' . $image->getExtension();  

            //如果文件夹不存在，则新建文件夹  
            if (!file_exists(Yii::getAlias('@backend') . '/web/' . $dir)) {  
                FileHelper::createDirectory(Yii::getAlias('@backend') . '/web/' . $dir, 0777);  
            }  
            $filepath = realpath(Yii::getAlias('@backend') . '/web/' . $dir) . '/';  
            $file = $filepath . $filename; 

            if ($image->saveAs($file)) {  
                $host=Yii::$app->getRequest()->hostInfo;
                $imagepath = $host.Yii::$app->getHomeUrl().$dir . $filename; 
            }  
        }  
         
        if(!empty($imagepath)){
            echo "<script>window.parent.CKEDITOR.tools.callFunction(".$cb.", '".$imagepath."', '');</script>";
        }else{
            echo "<script>window.parent.CKEDITOR.tools.callFunction(".$cb.", '', '".$errmsg."');</script>";
        }

        exit;
    }
}
