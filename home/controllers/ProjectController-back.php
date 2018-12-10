<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use common\models\ProProject;
use common\models\ProCategory;
use common\models\ProOrder;
use common\models\ProOrderDetail;
use common\models\ProBase;
use app\services\CommonServices;
use common\utils\CommUtil;

class ProjectController extends Controller
{
    public function beforeAction($action){
        $this->layout="project";
        $this->getView()->title = "法律培训";  
        return parent::beforeAction($action);
    }
    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->request->isPost){
            $data=Yii::$app->request->post("parm",[]);
            $project=Yii::$app->request->post("project",[]);

            if(count($project) >0){
                $orderno=CommUtil::getOrderNo();
                $ordermodel= new ProOrder();
                $ordermodel->setAttributes($data,false);
                $ordermodel->order_no=$orderno;
                $ordermodel->status=1;
                $ordermodel->created=date("Y-m-d H:i:s");
                $ordermodel->updated=date("Y-m-d H:i:s");
                if($ordermodel->save()){
                    $odmodel= new ProOrderDetail();
                    foreach ($project as $value) {
                        $promodel= ProProject::findOne($value);
        
                        $pd=['order_id'=>$ordermodel->id,'project_id'=>$value,'area'=>$promodel->areas,'pdate'=>$promodel->pdate];
                        $odm=clone $odmodel;
                        $odm->setAttributes($pd,false);
                        $odm->save();
                    }
                    $this->redirect(['project/result?no='.$orderno]);
                }else{
                    $this->redirect(['project/result?error=1']);
                }
            }else{
                $this->redirect(['project/result?error=2']);
            }
        }
        $categorys=ProCategory::getTree(0);
        $data=[];
        if($categorys){
            foreach ($categorys as $category) {
                $items=ProProject::find()->where(['category_id'=>$category['id'],'status'=>1])->asArray()->all();
                $category['items']=$items;
                $data[]=$category;
            }
        }
        $base=ProBase::find()->one();
        if($base){
            $base->vnum+=1;
            $base->save();
        }

        return $this->render('index', ['data' => $data,'base'=>$base]);
    }

    /**
     * 结果页面
     * @return string
     */
    public function actionResult(){
        $no=Yii::$app->request->get("no",[]);
        $error=Yii::$app->request->get("error",[]);
        if(!empty($no)){
            $msg="操作成功,订单号为：".$no;
            $status=1;
        }else{
            switch ($error) {
                case '1':
                    $msg="操作失败,提交失败！";
                    break;
                case '2':
                    $msg="操作失败,请选择项目！";
                    break;
                default:
                    $msg="操作失败！";
                    break;
            }
            $status=0;
        }
        return $this->render('result', ['status' => $status,'msg'=>$msg]);
    }

}
