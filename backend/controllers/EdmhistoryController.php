<?php

namespace app\controllers;

use Yii;
use app\models\EdmSendHistory;
use app\models\EdmCategory;
use app\models\EdmMails;
use app\models\EdmUsers;
use app\models\EdmUsersCategory;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * MemberController implements the CRUD actions for EdmSendHistory model.
 */
class EdmhistoryController extends Controller
{
    /**
     * Lists all EdmSendHistory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query=Yii::$app->request->get();
        $obj=EdmSendHistory::find();

        if(@$query['status']){
            $status=$query['status'];
            $obj->andwhere(['status'=>$status]);
        }
        if(@$query['status']){
            $status=$query['status'];
            $obj->andwhere(['status'=>$status]);
        }
        if(@$query['mail_id']){
            $obj->andwhere(['mail_id'=>$query['mail_id']]);
        }

        $totalCount = $obj->count();
        $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
        $data=$obj->orderby("created desc")->offset($pages->offset)->limit($pages->limit)->all();

        $unsendnum = EdmSendHistory::find()->where(['status'=>1])->count();
        
        $category=EdmCategory::find()->all();
        $mails=EdmMails::find()->where(['status'=>1])->all();

        return $this->render('index', [
            'data' => $data,'pages'=>$pages,'query'=>$query,'unsendnum'=>$unsendnum,'category'=>$category,'mails'=>$mails
        ]);
    }

    /**
     * Creates a new EdmSendHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EdmSendHistory();
        if(Yii::$app->request->isPost){
            $postdata=Yii::$app->request->post('postdata');

            $category_id=intval($postdata['category_id']);
            $mail_id=intval($postdata['mail_id']);

            $maildata=EdmMails::findOne($mail_id);
            if($maildata){
                $now=date("Y-m-d H:i:s");
                $content= addslashes($maildata->content);
                $subject= addslashes($maildata->subject);
                $sql="insert into edm_send_history(mail_id,category_id,user_id,email_from,email_to,subject,content,status,created,updated) 
select ".$mail_id." as mail_id,".$category_id." as category_id,u.id,'".$maildata->send_from."' as email_from,u.email,'".$subject."' as subject,'".$content."' as content,1 as status,'".$now."' as created,'".$now."' as updated
from edm_users u ";
               if($category_id == 0){
                    $sql .= " where u.status =2";
                }else{
                    $sql .= " inner join edm_users_category uc on uc.user_id=u.id and uc.category_id=".$category_id." where u.status =2";
                }





                Yii::$app->db->createCommand($sql)->execute();
            }
            return $this->redirect(['index']);
        }

        $category=EdmCategory::find()->all();
        $mails=EdmMails::find()->where(['status'=>1])->all();
        
        return $this->render('create', ['category'=>$category,'mails'=>$mails]);
    }

    

    /**
     * Deletes an existing EdmSendHistory model.
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
     * Finds the EdmSendHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EdmSendHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EdmSendHistory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
