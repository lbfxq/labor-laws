<?php

namespace app\controllers;

use Yii;
use common\models\DataUser;
use common\models\DataUserHistory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\services\UserServices;

/**
 * MemberController implements the CRUD actions for DataUser model.
 */
class UsersController extends Controller
{
    /**
     * Lists all DataUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query=\Yii::$app->request->get("serach");
        $obj=DataUser::find()->where(['!=','status','9']);

        if(@$query['email']){
            $obj=$obj->andwhere(['email'=>$query['email']]);
        }
        if(@$query['name']){
            $obj=$obj->andwhere("name like '%".$query['name']."%'");
        }
        if(@$query['last_date']){
            $obj=$obj->andwhere(['last_date'=>$query['last_date']]);
        }

        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->orderBy("created desc")->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('index', [
            'data' => $data,'pages'=>$pages,'menu1'=>'pass','menu2'=>'dekaron'
        ]);
    }

   
    /**
     * Creates a new DataUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataUser();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $model->setAttributes($postdata,false);
            $model->created=date("Y-m-d H:i:s");
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        
        return $this->render('create', []);
    }

    /**
     * Updates an existing DataUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $pwd=@$postdata['pwd'];
            unset($postdata['pwd']);
            $model->setAttributes($postdata,false);
            if(!empty($pwd)){
                $model->pwd=md5($pwd);
            }
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing DataUser model.
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
     * Finds the DataUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}