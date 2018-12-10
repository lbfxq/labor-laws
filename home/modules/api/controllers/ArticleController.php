<?php
/**
 * @author:Alading
 * Date: 2017/10/18 0018
 */

namespace app\modules\api\controllers;

use Yii;
use yii\web\Response;
use app\modules\api\controllers\ApiController;
use common\models\DataCategory;
use common\models\DataArticle;
use common\models\DataData;
use app\services\CommonServices;

class ArticleController extends ApiController
{
    public $formatType="json";
    /**
     * 最新的分类文章
     */
    public function actionLatest(){
        $flag="success";
        $obj=DataArticle::find()->select("id,title,summary,content,category_id,public_date,nums,is_free,clicknum,des,keywords,created,updated")->where(['status' => 1])->orderBy("public_date desc,rank desc,id desc")->limit(5)->asArray()->all();


        $data=[];
        if($obj){
            foreach ($obj as $key => $value) {
                $md=$value;
                $cid=$value['category_id'];
                $cate=DataCategory::findOne($cid);
                if($cate){
                    if($cate && $cate['parent_id'] != 0){
                        $md['category_id_2']=$cid;
                        $cid=$cate['parent_id'];
                        $cate=DataCategory::findOne($cid);
                        $md['category_id_1']=$cid;

                    }else{
                        $md['category_id_1']=$cid;
                        $md['category_id_2']=0;
                    }

                    $cname=$cate?$cate->name:"";
                    $md['category_name']=$cate->name;
                }else{
                    $md['category_id']=0;
                    $md['category_name']="未設定";
                }
                $data[]=$md;
            }
        }


        $datadata= DataData::findOne(1);
        if($datadata){
            $datadata->setAttribute("index_browse",intval($datadata->index_browse)+1);
            $datadata->save();
        }
        


         return ['code'=>$flag,'data'=>$data];
    }

    /**
     * 分类文章列表
     */
    public function actionClist(){
        $flag="success";
        $category_id=Yii::$app->request->get("cid",0);
        $page_size=Yii::$app->request->get("page_size",4);
        $category=DataCategory::find()->where(['parent_id'=>$category_id])->orderBy("rank desc")->asArray()->all();

        $data=[];
        if($category){
            foreach ($category as $key => $value) {
                $cid=$value['id'];
                $cids=DataCategory::getIdsByParent($cid,$cid);
                $md=$value;
                $articles=DataArticle::find()->select("id,title,summary,category_id,public_date,nums,is_free,clicknum,created,updated")->where(['status' => 1])->andwhere("category_id in (".$cids.")")->orderBy("public_date desc,rank desc,id desc")->limit(4)->asArray()->all();
                foreach ($articles as $k => $v) {
                    $cdata=DataCategory::findOne($v['category_id']);
                    if($cdata){
                        $articles[$k]['category_name']=$cdata->name;
                    }else{
                        $articles[$k]['category_name']="未設定";
                    }
                }
                $md['articles']=$articles;
                $data[$key]=$md;
            }
        }
        return ['code'=>$flag,'data'=>$data];
    }
    /**
     * 文章分类列表信息
     */
    public function actionList()
    {
        $flag="success";
        $category_id=Yii::$app->request->get("cid",0);
        $recommend=Yii::$app->request->get("recommend",0);
        $page_no=Yii::$app->request->get("page_no",1);
        $page_size=Yii::$app->request->get("page_size",10);
        if($page_size > 30){
            $page_size=30;
        }
        $offset=($page_no-1)*$page_size;

        $cids=DataCategory::getIdsByParent($category_id,$category_id);

        $obj=DataArticle::find()->select("id,title,summary,category_id,public_date,nums,is_free,clicknum,created,updated")->where(['status' => 1]);
        if($recommend){
            $obj->andwhere(['is_recommand'=>2]);
        }
        if($category_id > 0){
            $obj->andwhere("category_id in (".$cids.")");
        }
        $totalCount = $obj->count();
        $data=$obj->orderBy("public_date desc,rank desc,id desc")->offset($offset)->limit($page_size)->asArray()->all();
        if($data){
            foreach ($data as $key => $value) {
                $category=DataCategory::findOne($value['category_id']);
                if($category){
                    $data[$key]['category_name']=$category->name;
                }else{
                    $data[$key]['category_name']="未設定";
                }
            }
        }
        
        return ['code'=>$flag,'data'=>['total'=>$totalCount,'articles'=>$data]];
    }
    /**
     * 文章搜索
     */
    public function actionSearch(){
        $flag="success";
        $keywords=Yii::$app->request->get("keywords","");
        $page_no=Yii::$app->request->get("page_no",1);
        $page_size=Yii::$app->request->get("page_size",10);

        $obj=DataArticle::find()->select("id,title,summary,category_id,public_date,nums,is_free,clicknum,created,updated")->where(['status'=>1]);
        if(!empty($keywords)){
            $obj->andwhere("title like '%".$keywords."%'");  
        }
        $totalCount = $obj->count();
        $offset=($page_no-1)*$page_size;
        $data=$obj->orderBy("public_date desc,rank desc")->offset($offset)->limit($page_size)->asArray()->all();
        if($data){
            foreach ($data as $key => $value) {
                $category=DataCategory::findOne($value['category_id']);
                if($category){
                    $data[$key]['category_name']=$category->name;
                }else{
                    $data[$key]['category_name']="未設定";
                }
            }
        }
        return ['code'=>$flag,'data'=>['total'=>$totalCount,'articles'=>$data]];
    }

    /**
     * 文章详细信息
     */
    public function actionView()
    {
        $flag="success";
        $id=Yii::$app->request->get("id",0);
        $data=DataArticle::find()->where(['status'=>1,'id'=>$id])->one();
        return ['code'=>$flag,'data'=>$data];
    }
   
}