<?php

namespace app\controllers;

use Yii;
use common\models\DataVideo;
use common\models\DataCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * MemberController implements the CRUD actions for DataVideo model.
 */
class VideoController extends Controller
{
    /**
     * Lists all DataVideo models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query=Yii::$app->request->get();
        $obj=DataVideo::find();

        if(@$query['status']){
            $status=$query['status'];
            $obj->andwhere(['status'=>$status]);
        }
        if(@$query['is_hot']){
            $is_hot=$query['is_hot'];
            $obj->andwhere(['is_hot'=>$is_hot]);
        }
        if(@$query['is_recommand']){
            $is_recommand=$query['is_recommand'];
            $obj->andwhere(['is_recommand'=>$is_recommand]);
        }
        if(@$query['keywords']){
            $keywords=$query['keywords'];
            $obj->andwhere("title like '%".$keywords."%'");
        }
        if(@$query['category_id']){
            $obj->andwhere(['category_id'=>$query['category_id']]);
        }
        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->offset($pages->offset)->limit($pages->limit)->all();
        
        $categorys=DataCategory::getTreeOption(0,"",@$query['category_id']);

        return $this->render('index', [
            'data' => $data,'pages'=>$pages,'categorys'=>$categorys,'query'=>$query
        ]);
    }

    /**
     * Creates a new DataVideo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataVideo();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            
            $imagepath="";
            $image = UploadedFile::getInstanceByName("imgs");
            if (isset($image->name)) {
                $dir = 'uploads/imgs/'.date("Ymd")."/";  
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
            $postdata['vimg']=$imagepath;

            $model->setAttributes($postdata,false);


            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        $categorys=DataCategory::getTreeOption(0,"");
        
        return $this->render('create', ['categorys'=>$categorys]);
    }

    /**
     * Updates an existing DataVideo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');

            $imagepath="";
            $image = UploadedFile::getInstanceByName("imgs");
            if (isset($image->name)) {
                $dir = 'uploads/imgs/'.date("Ymd")."/";  
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
            $postdata['vimg']=$imagepath;
            
            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
         $categorys=DataCategory::getTreeOption(0,"",$model->category_id);
        
        return $this->render('update', [
                'model' => $model,'categorys'=>$categorys
            ]);
    }

    /**
     * Deletes an existing DataVideo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model=$this->findModel($id);
        $model->status=9;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing DataVideo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionHr($id)
    {

        $k=Yii::$app->request->get('k',"");
        $v=Yii::$app->request->get('v',"");
        $model=$this->findModel($id);
        $model->{$k}=$v;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the DataVideo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataVideo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataVideo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
