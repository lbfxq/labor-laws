<?php

namespace app\controllers;

use Yii;
use common\models\ProProject;
use common\models\ProOrder;
use common\models\ProOrderDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * MemberController implements the CRUD actions for ProProject model.
 */
class ProjectOrderController extends Controller
{
    /**
     * Lists all ProProject models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query=Yii::$app->request->get();
        $obj=ProOrder::find()->where('status != 9');

        if(@$query['status']){
            $status=$query['status'];
            $obj->andwhere(['status'=>$status]);
        }

        if(@$query['order_no']){
            $order_no=$query['order_no'];
            $obj->andwhere(['order_no'=>$order_no]);
        }
        
        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->offset($pages->offset)->orderBy("created desc")->limit($pages->limit)->all();
        
       

        return $this->render('index', [
            'data' => $data,'pages'=>$pages,'query'=>$query
        ]);
    }
     /**
     * Lists all ProProject models.
     * @return mixed
     */
    public function actionUpdate($id){
         $order=ProOrder::findOne($id);
        if(Yii::$app->request->isPost){
            $order->status = Yii::$app->request->post("status",1);
            $order->save();
            return $this->redirect(['index']);
        }
       
        $orderdetail=ProOrderDetail::find()->where(['order_id'=>$id])->asArray()->all();
        if($orderdetail){
            foreach ($orderdetail as $key => $value) {
                $project= ProProject::findOne($value['project_id']);
                $orderdetail[$key]['title']=$project->title;
            }
        }
        return $this->render('update', [
            'data' => $order,'details'=>$orderdetail
        ]);
    }
    /**
     * Lists all ProProject models.
     * @return mixed
     */
    public function actionDelete($id){
         $order=ProOrder::findOne($id);
         $order->status = 9;
         $order->save();
        return $this->redirect(['index']);
    }
}
