<?php

namespace app\controllers;

use Yii;
use common\models\DataOrder;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * MemberController implements the CRUD actions for DataMember model.
 */
class OrderController extends Controller
{
    /**
     * Lists all DataMember models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query=\Yii::$app->request->get("serach");
        $obj=DataOrder::find()->where(['!=','status','9']);

        if(@$query['order_no']){
            $obj=$obj->andwhere(['order_no'=>$query['order_no']]);
        }
        if(@$query['payment_order_no']){
            $obj=$obj->andwhere(['payment_order_no'=>$query['payment_order_no']]);
        }
    
        if(@$query['status']){
            $obj=$obj->andwhere(['status'=>$query['status']]);
        }

        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->orderBy("created desc")->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('index', [
            'data' => $data,'pages'=>$pages
        ]);
    }

   
    /**
     * Updates an existing DataMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing DataMember model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status= 9;
        $model->update();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}