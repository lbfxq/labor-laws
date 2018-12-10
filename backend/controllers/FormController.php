<?php

namespace app\controllers;

use Yii;
use common\models\DataContact;
use common\models\DataApply;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\utils\CsvUtil;

/**
 * MemberController implements the CRUD actions for DataUser model.
 */
class FormController extends Controller
{
    /**
     * Lists all DataUser models.
     * @return mixed
     */
    public function actionContact()
    {
        $doflag=\Yii::$app->request->get("doflag");
        $query=\Yii::$app->request->get("serach");
        $obj=DataContact::find()->where("1=1");

        if(@$query['email']){
            $obj=$obj->andwhere(['email'=>$query['email']]);
        }
        if(@$query['company']){
            $obj=$obj->andwhere("company like '%".$query['company']."%'");
        }
        if(@$query['username']){
            $obj=$obj->andwhere("username like '%".$query['username']."%'");
        }

        if($doflag=="export"){
            $data=$obj->all();
            $content="貴社名,部署,職務,お名前,住所,TEL,FAX,EMAIL,ホームページ,認証番号,テーマ,内容"."\n";
            if($data){
                foreach ($data as $key => $value) {
                    $content.='"'.$value->company.'","'.$value->deparment.'","'.$value->post.'","'.$value->username.'","'.$value->address.'","'.$value->tel.'","'.$value->fax.'","'.$value->email.'","'.$value->home.'","'.$value->number1.'","'.$value->theme.'","'.$value->content.'"'."\n";
                }
            }
            CsvUtil::export("contact_data.csv",$content);
        }else{
            $totalCount = $obj->count();
            $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
            $data=$obj->orderBy("created desc")->offset($pages->offset)->limit($pages->limit)->all();
            
            return $this->render('contact', [
                'data' => $data,'pages'=>$pages,'menu1'=>'pass','menu2'=>'dekaron'
            ]);
        }
    }
    /**
    *
    */
    public function actionContactview($id){
        $data=DataContact::findOne($id);
        return $this->render('contactview', [
            'data' => $data
        ]);
    }


    /**
     * Lists all DataUser models.
     * @return mixed
     */
    public function actionApply()
    {
        $doflag=\Yii::$app->request->get("doflag");
        $query=\Yii::$app->request->get("serach");
        $obj=DataApply::find()->where("1=1");

        if(@$query['company']){
            $obj=$obj->andwhere("company like '%".$query['company']."%'");
        }
        if(@$query['tel']){
            $obj=$obj->andwhere("tel like '%".$query['tel']."%'");
        }
        
        if($doflag=="export"){
            $data=$obj->all();
            $content="お申込み日,貴社名,郵便番号,ご住所,TEL,FAX,ご担当者様1-所属部署,ご担当者様1-お名前,ご担当者様1-TEL,ご担当者様1-E-mail,ご担当者様2-所属部署,ご担当者様2-お名前,ご担当者様2-TEL,ご担当者様2-E-mail,ご担当者様3-所属部署,ご担当者様3-お名前,ご担当者様3-TEL,ご担当者様3-E-mail,貴社名,郵便番号,ご住所,所属部署,職務,お名前,TEL,メールマガジン1,メールマガジン2,メールマガジン3,ホームページを見て,セミナーに参加して,セミナー名,知人の紹介 お名前,その他,備考"."\n";
            if($data){
                foreach ($data as $key => $value) {
                    $content.='"'.$value->apply_date.'","'.$value->company.'","'.$value->zipcode.'","'.$value->address.'","'.$value->tel.'","'.$value->fax.'","'.$value->contact_dpt_1.'","'.$value->contact_name_1.'","'.$value->contact_tel_1.'","'.$value->contact_mail_1.'","'.$value->contact_dpt_2.'","'.$value->contact_name_2.'","'.$value->contact_tel_2.'","'.$value->contact_mail_2.'","'.$value->contact_dpt_3.'","'.$value->contact_name_3.'","'.$value->contact_tel_3.'","'.$value->contact_mail_3.'","'.$value->recive_company.'","'.$value->recive_zipcode.'","'.$value->recive_add.'","'.$value->recive_dpt.'","'.$value->recive_job.'","'.$value->recive_name.'","'.$value->recive_tel.'","'.$value->unknow_1.'","'.$value->unknow_2.'","'.$value->unknow_3.'","'.$value->unknow_4.'","'.$value->unknow_m.'-'.$value->unknow_d.'","'.$value->unknow_5.'","'.$value->unknow_6.'","'.$value->unknow_7.'","'.$value->marks.'"'."\n";
                }
            }
            CsvUtil::export("apply_data.csv",$content);
        }else{
            $totalCount = $obj->count();
            $pages = new Pagination(['totalCount' =>$totalCount, 'pageSize' => 20]);
            $data=$obj->orderBy("created desc")->offset($pages->offset)->limit($pages->limit)->all();
            return $this->render('apply', [
                'data' => $data,'pages'=>$pages,'menu1'=>'pass','menu2'=>'dekaron'
            ]); 
        }
    }
    /**
    *
    */
    public function actionApplyview($id){
        $data=DataApply::findOne($id);
        return $this->render('applyview', [
            'data' => $data
        ]);
    }

    /**
     * Deletes an existing EdmUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionApplydelete($id)
    {
        DataApply::findOne($id)->delete();
        return $this->redirect(['apply']);
    }

    /**
     * Deletes an existing EdmUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionContactdelete($id)
    {
        DataContact::findOne($id)->delete();
        return $this->redirect(['contact']);
    }
}