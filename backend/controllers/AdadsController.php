<?php

namespace app\controllers;

use Yii;
use common\models\DataAds;
use common\models\DataPosition;
use common\services\AdsServices;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
/**
 * MemberController implements the CRUD actions for DataAds model.
 */
class AdadsController extends Controller
{
    /**
     * Lists all DataAds models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query=Yii::$app->request->get();
        
        $obj=DataAds::find()->where(['!=','status',9]);
        if(@$query['status']){
            $status=$query['status']-1;
            $obj->andwhere(['status'=>$status]);
        }
        if(@$query['position_id']){
            $obj->andwhere(['position_id'=>$query['position_id']]);
        }
        if(@$query['ad_id']){
            $obj->andwhere(['ad_id'=>$query['ad_id']]);
        }
        if(@$query['client']){
            $obj->andwhere(['client'=>$query['client']]);
        }


        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->orderBy("created desc")->offset($pages->offset)->limit($pages->limit)->all();

        $position=DataPosition::find()->where(['status'=>1])->all();
        return $this->render('index', [
            'data' => $data,'pages'=>$pages,'query'=>$query,'position'=>$position
        ]);
    }

    /**
     * Creates a new DataAds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataAds();
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
            $model->created=date("Y-m-d H:i:s");
            if($model->save()){

                return $this->redirect(['index']);
            }
        }
        $position=DataPosition::find()->where(['status'=>1])->all();
        
        return $this->render('create', ['position'=>$position]);
    }

    /**
     * Updates an existing DataAds model.
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
                $postdata['vimg']=$imagepath;
            } 

            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        $position=DataPosition::find()->where(['status'=>1])->all();
        return $this->render('update', [
                'model' => $model,'position'=>$position
            ]);
    }

    /**
     * Deletes an existing DataAds model.
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
     * Finds the DataAds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataAds::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
