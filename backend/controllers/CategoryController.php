<?php

namespace app\controllers;

use Yii;
use common\models\DataCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * MemberController implements the CRUD actions for DataCategory model.
 */
class CategoryController extends Controller
{
    /**
     * Lists all DataCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $lists=DataCategory::getTreeTables(0);
        return $this->render('index', [
            'lists' => $lists
        ]);
    }

    /**
     * Creates a new DataCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataCategory();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            if($postdata['parent_id'] >0){
                $parent=$this->findModel($postdata['parent_id']);
                $level=$parent->level+1;
            }else{
                $level=1;
            }
            
            $postdata['level']=$level;
            $model->setAttributes($postdata,false);
            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        $cdata=DataCategory::getTreeOption(0,"");
        
        return $this->render('create', ['cdata'=>$cdata]);
    }

    /**
     * Updates an existing DataCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost){
            $prevlevel=$model->level;
            $postdata=Yii::$app->request->post('postdata');
            if($postdata['parent_id'] >0){
                $parent=$this->findModel($postdata['parent_id']);
                $level=$parent->level+1;
            }else{
                $level=1;
            }
            
            $postdata['level']=$level;
            $model->setAttributes($postdata,false);
            if($model->save()){
                if($prevlevel != $level){
                    echo "ab";
                    DataCategory::updateLevel($model->id);
                }
                return $this->redirect(['index']);
            }
        }

        $cdata=DataCategory::getTreeOption(0,"",$model->parent_id);
        return $this->render('update', [
                'model' => $model,'cdata'=>$cdata
            ]);
    }

    /**
     * Deletes an existing DataCategory model.
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
     * Finds the DataCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
