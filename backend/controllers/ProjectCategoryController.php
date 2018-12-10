<?php

namespace app\controllers;

use Yii;
use common\models\ProCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * MemberController implements the CRUD actions for ProCategory model.
 */
class ProjectCategoryController extends Controller
{
    /**
     * Lists all ProCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $obj=ProCategory::find();
        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('index', [
            'data' => $data,'pages'=>$pages
        ]);
    }

    /**
     * Creates a new ProCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProCategory();
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
     * Updates an existing ProCategory model.
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
     * Deletes an existing ProCategory model.
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
     * Finds the ProCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
