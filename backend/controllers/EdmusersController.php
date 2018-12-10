<?php

namespace app\controllers;

use Yii;
use app\models\EdmUsers;
use app\models\EdmCategory;
use app\models\EdmUsersCategory;

use common\services\AdsServices;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use common\utils\CsvUtil;

/**
 * MemberController implements the CRUD actions for EdmUsers model.
 */
class EdmusersController extends Controller
{
    /**
     * Lists all EdmUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query=Yii::$app->request->get();
        $mt=isset($query['mt'])?$query['mt']:"search";

        
        $obj=EdmUsers::find()->where(['!=','status',9]);

        if(@$query['status']){
            $status=$query['status'];
            $obj->andwhere(['status'=>$status]);
        }
        
        if(@$query['keywords']){
            $keywords=$query['keywords'];
            $obj->andwhere(['email'=>$keywords]);
        }



        if(@$query['category_id']){
            $obj->andwhere("EXISTS (select id from edm_users_category uc  where  uc.category_id=".$query['category_id']." and uc.user_id=edm_users.id)");
        }
        

        if($mt=="export"){
            $data=$obj->orderBy("id asc")->all();
            $str="ID,name,email,status";
            if($data){
                foreach ($data as $key => $value) {
                    $str.="\r\n";
                    $str.='"'.$value->id.'","'.$value->name.'","'.$value->email.'","'.$value->status.'"';
                }
            }
            CsvUtil::export("userdata.csv",$str);
            exit;
        }else{
            $totalCount = $obj->count();
            $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
            $data=$obj->orderBy("id asc")->offset($pages->offset)->limit($pages->limit)->asArray()->all();

            if($data){
                foreach ($data as $key => $value) {
                    $cas=EdmUsersCategory::find()->where(['user_id'=>$value['id']])->all();
                    $cname="";
                    if($cas){
                        foreach ($cas as $v) {
                            $category= EdmCategory::findOne($v->category_id);
                            $cname.=empty($cname)?@$category->name:",".@$category->name;
                        }
                    }
                    $data[$key]['category_name']=$cname;
                    $data[$key]['status_name']=EdmUsers::getStatusName($value['status']);
                }
            }

            $category=EdmCategory::find()->all();
            return $this->render('index', [
                'data' => $data,'pages'=>$pages,'query'=>$query,'category'=>$category]);
        }
    }

    /**
     * Creates a new EdmUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EdmUsers();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');
            $model->setAttributes($postdata,false);
            $model->created=date("Y-m-d H:i:s");
            if($model->save()){
                $categorys=$postdata['categorys'];
                if(count($categorys)>0){
                    $ucmodel= new EdmUsersCategory();
                    foreach ($categorys as $category_id) {
                        $idata=['category_id'=>$category_id,'user_id'=>$model->id];
                        $uc=clone $ucmodel;
                        $uc->setAttributes($idata,false);
                        $uc->save();
                    }
                }
                return $this->redirect(['index']);
            }
        }
        $category=EdmCategory::find()->all();
        
        return $this->render('create', ['category'=>$category]);
    }

    /**
     * Updates an existing EdmUsers model.
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
                EdmUsersCategory::deleteAll(['user_id'=>$model->id]);
                $categorys=$postdata['categorys'];
                if(count($categorys)>0){
                    $ucmodel= new EdmUsersCategory();
                    foreach ($categorys as $category_id) {
                        $idata=['category_id'=>$category_id,'user_id'=>$model->id];
                        $uc=clone $ucmodel;
                        $uc->setAttributes($idata,false);
                        $uc->save();
                    }
                }

                return $this->redirect(['index']);
            }
        }
        $category=EdmCategory::find()->asArray()->all();
        foreach ($category as $key => $value) {
            $cnum=EdmUsersCategory::find()->where(['category_id'=>$value['id'],'user_id'=>$id])->count();
            if($cnum >0){
                $category[$key]['check']=1;
            }else{
                $category[$key]['check']=0;
            }
        }
        return $this->render('update', [
                'model' => $model,'category'=>$category
            ]);
    }

    /**
     * Deletes an existing EdmUsers model.
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
    * 清空用户数据
    */
    public function actionEmptydata(){
        Yii::$app->db->createCommand()->truncateTable('edm_users_category')->execute();
        Yii::$app->db->createCommand()->truncateTable('edm_users')->execute();
        return $this->redirect(['index']);
    }
    /**
    * 导入用户数据
    */
    public function actionImportdata(){
        $filename=@$_FILES['importdata']['tmp_name'];
        $type=@$_FILES['importdata']['type'];
        $error=@$_FILES['importdata']['error'];

        if(!empty($filename) && $type=="application/vnd.ms-excel" && $error==0){
            $data=CsvUtil::read($filename,'utf-8');
           if(count($data)>0 && is_array($data)) {
            $model = new EdmUsers();
            $model2= new EdmUsersCategory();

            $now=date("Y-m-d H:i:s");
            foreach ($data as $v) {
                $email=$v[1];
                $categorys=$v[0];
                $categorys=explode(",", $categorys);
                $usermodel= clone $model;
                $udata=['email'=>$email,'status'=>1,'created'=>$now,'updated'=>$now];
                $usermodel->setAttributes($udata,false);
                $flag=$usermodel->save();
                if($flag){
                    $user_id=$usermodel->id;
                    foreach ($categorys as $c) {
                        if(intval($c)>0){
                            $ucmodel= clone $model2;
                            $ucdata=['user_id'=>$user_id,'category_id'=>$c];
                            $ucmodel->setAttributes($ucdata,false);
                            $ucmodel->save();
                        }
                       
                    }
                }
            }
           }
        }

        return $this->redirect(['index']);
    }
    /**
     * Finds the EdmUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EdmUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EdmUsers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
