<?php
namespace common\services;
use Yii;
use common\services\RedisKeysServices;
use common\services\SettingServices;
use common\models\DataPass;
use common\models\DataSetting;

/**
 * 返回客户端状态类型
 * Class ResultStatusServices
 * @package common\services
 */
class GameServices
{
	/**
	*获取闯关关卡得分
	*/
    public static function getPassScore($level,$time,$step,$sum){
        $passSetting=SettingServices::getPassSetting();
        $score_ratio=0;
        $exfalg=false;
        foreach ($passSetting as $key => $value) {
            if($value['level']==$level){
                $score_ratio=$value['base_score'];
                $exfalg=true;
                break;
            }
        }
        if($exfalg){
            $basescore=$score_ratio*$level;
            //关卡得分 = 关卡基础分 -  关卡计时/3 - (基础关卡分数/初始棋盘数字相加总和)*步数 
            $score = $basescore - ceil($time/3) - ceil(($basescore/$sum)*$step);
            if($score <0){$score=0;}
        }else{
            $score=-1;
        }
       
    	return $score;
    }

    /**
    *获取挑战关卡得分
    */
    public static function getDekaronScore($dekaron_id,$time,$step,$sum){
        $currendekaron=SettingServices::getCurrentDekaronSetting();
        if($currendekaron && $currendekaron['id']==$dekaron_id){
            $score_ratio=0;
            $start_sum=isset($currendekaron['sum'])?intval($currendekaron['sum']):0;
            $base_score=isset($currendekaron['base_score'])?intval($currendekaron['base_score']):0;

            //挑战得分 = 关卡基础分 - (基础关卡分数/初始棋盘数字相加总和) * 剩余棋盘数字总和 - 关卡计时/3 -关卡步数 *3
            if($start_sum ==0){
                $score=$base_score-0-round($time*2)-$step*5;
            }else{
                $score=$base_score-ceil(($base_score/$start_sum)*$sum)-round($time*2)-$step*5;
            }
            
            if($score <0){$score=0;}
        }else{
            $score=-1;
        }
        return $score;
    }
    /**
    *获取地图内容
    */
    public static function getMapFormat($mapdata){
        $res= json_encode($mapdata);
        $res=str_replace('"', '', $res);
        return $res;
    }
}