<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/12
 * Time: 10:36
 */

namespace common\models;


use Yii;
use yii\db\ActiveRecord;

class ProCategory extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_category';
    }
    /**
    * 获得分类树形结构
    */
    public static function getTree($parent_id=0){
        $data=self::find()->where(['parent_id'=>$parent_id])->asArray()->all();
        if(count($data) > 0 ){
            foreach ($data as $key => $value) {
                $cdata=self::getTree($value['id']);
                if(count($cdata)>0){
                     $data[$key]['childs']=$cdata;
                }
            }
            return $data;
        }else{
            return $data;
        }
    }

    /**
    * 获得select的option
    */
    public static function getTreeOption($parent_id=0,$str="",$select=""){
        $data=self::find()->where(['parent_id'=>$parent_id])->asArray()->all();
        if(count($data) > 0 ){
            foreach ($data as $key => $value) {
                $prefix="";
                for($i=1;$i<$value['level'];$i++){
                    $prefix.="----";
                }
                if($select==$value['id']){
                    $str.='<option value="'.$value['id'].'" selected="selected">'.$prefix.$value['name'].'</option>';
                }else{
                    $str.='<option value="'.$value['id'].'">'.$prefix.$value['name'].'</option>';
                }
                $str=self::getTreeOption($value['id'],$str,$select);
            }
        }

        return $str;
    }

    /**
    * 获得列表
    */
    public static function getTreeTables($parent_id=0,$str=""){
        $data=self::find()->where(['parent_id'=>$parent_id])->asArray()->all();
        $prefixurl=Yii::$app->getHomeUrl();
        if(count($data) > 0 ){
            foreach ($data as $key => $value) {
                $prefix="";
                for($i=1;$i<$value['level'];$i++){
                    $prefix.="&nbsp;&nbsp;&nbsp;&nbsp;";
                }

                $str.='<tr class="gradeX">
                            <td>'.$prefix.$value['name'].'</td>
                            <td class="center">
                                <a href="'.$prefixurl.'category/update?id='.$value['id'].'">编辑</a>
                                <a href="'.$prefixurl.'category/delete?id='.$value['id'].'" onclick="return del_confirm()">删除</a>
                            </td>
                        </tr>';

                
                $str=self::getTreeTables($value['id'],$str);
            }
        }
        return $str;
    }

    /**
    * 更新分类级别
    */
    public static function updateLevel($parent_id){
        $parent=$parent_id>0?self::findOne($parent_id):"";
        $child=self::find()->where(['parent_id'=>$parent_id])->all();
        if($child){
            $level=$parent?$parent->level+1:2;
            foreach ($child as $key => $value) {
                $obj=self::findOne($value->id);
                $obj->setAttribute("level",$level);
                $obj->save();
                self::updateLevel($value->id);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }
    public function getStatus(){
        if($this->status=='1'){
            return "启用";
        }elseif($this->status=='2'){
            return "停用";
        }else{
            return "删除";
        }
    }
}