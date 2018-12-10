<?php

namespace app\controllers;

use Yii;
use common\models\ProProject;
use common\models\ProCategory;
use common\models\ProBase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * MemberController implements the CRUD actions for ProProject model.
 */
class ProjectController extends Controller
{

    public function actionBase(){
        
        if(Yii::$app->request->isPost){
            $id=Yii::$app->request->post('id');
            if(empty($id)){
                $model= new ProBase();
            }else{
                $model=ProBase::findOne($id);
            }
            $postdata=Yii::$app->request->post('postdata');
            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['base']);
            }
        }
        $data = ProBase::find()->one();
        return $this->render('base', [
            'data' => $data
        ]);
    }
    /**
     * Lists all ProProject models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query=Yii::$app->request->get();
        $obj=ProProject::find();

        if(@$query['status']){
            $status=$query['status'];
            $obj->andwhere(['status'=>$status]);
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
        
        $categorys=ProCategory::getTreeOption(0,"",@$query['category_id']);

        return $this->render('index', [
            'data' => $data,'pages'=>$pages,'categorys'=>$categorys,'query'=>$query
        ]);
    }

    /**
     * Creates a new ProProject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProProject();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        $categorys=ProCategory::getTreeOption(0,"");
        
        return $this->render('create', ['categorys'=>$categorys]);
    }

    /**
     * Updates an existing ProProject model.
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
         $categorys=ProCategory::getTreeOption(0,"",$model->category_id);
        
        return $this->render('update', [
                'model' => $model,'categorys'=>$categorys
            ]);
    }

    /**
     * Deletes an existing ProProject model.
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
     * Finds the ProProject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProProject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProProject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
