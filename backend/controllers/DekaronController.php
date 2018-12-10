<?php

namespace app\controllers;

use Yii;
use common\models\DataDekaron;
use common\models\DataRecordsDekaron;
use common\models\DataUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\services\SettingServices;
use common\services\GameServices;

/**
 * MemberController implements the CRUD actions for DataMember model.
 */
class DekaronController extends Controller
{
    /**
     * Lists all DataMember models.
     * @return mixed
     */
    public function actionIndex()
    {

        
        $obj=DataDekaron::find();

        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->orderBy("start_date desc")->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        if($data){
            foreach ($data as $key => $value) {
                $play_num = DataRecordsDekaron::find()->where(['dekaron_id'=>$value['id']])->count();
                $play_over_num = DataRecordsDekaron::find()->where(['dekaron_id'=>$value['id'],'passfalg'=>1])->count();
                $play_fail_num = DataRecordsDekaron::find()->where(['dekaron_id'=>$value['id'],'passfalg'=>2])->count();
                $data[$key]['play_num']=$play_num;
                $data[$key]['play_over_num']=$play_over_num;
                $data[$key]['play_fail_num']=$play_fail_num;
            }
        }

        
        return $this->render('index', [
            'data' => $data,'pages'=>$pages
        ]);
    }
    /**
     * 重置当前挑战关卡
     * @return mixed
     */
    public function actionFlush(){
        SettingServices::setCurrentDekaronSetting();
        return $this->redirect(['index']);
    }

    /**
     * Creates a new DataMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataDekaron();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $map=Yii::$app->request->post('map');
            $content=GameServices::getMapFormat($map);

            $model->setAttributes($postdata,false);
            $model->content=$content;
            $model->created=date("Y-m-d H:i:s");
            if($model->save()){

                $rd= new DataRecordsDekaron();
                $users=DataUser::find()->limit(100)->all();
                if($users){
                    foreach ($users as $key => $value) {
                        $nrd=clone $rd;
                        $score=rand(2000,6000);
                        $nrd->setAttributes([
                            'user_id'=>$value->id,
                            'uuid'=>$value->uuid,
                            'nickname'=>$value->nickname,
                            'dekaron_id'=>$model->id,
                            'score'=>$score,
                            'passfalg'=>2,
                            'created'=>date("Y-m-d H:i:s"),
                            'updated'=>date("Y-m-d H:i:s")
                        ],false);
                        $nrd->save();
                    }
                }

                return $this->redirect(['index']);
            }
        }
        
        return $this->render('create', []);
    }

    /**
     * Updates an existing DataMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $map=Yii::$app->request->post('map');
            $content=GameServices::getMapFormat($map);
            $model->setAttributes($postdata,false);
            $model->content=$content;
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
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
        $this->findModel($id)->delete();

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
        if (($model = DataDekaron::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
