<?php
namespace common\services;
use Yii;
use common\services\RedisKeysServices;
use common\services\BaseDataServices;
use common\services\SettingServices;
use common\models\DataSetting;
use common\models\DataUser;
use common\models\DataUserHistory;
use common\models\DataUserSign;


/**
 * 客户的处理
 * Class UserServices
 * @package common\services
 */
class UserServices
{
    /**
    *判断登录状态
    */
    public static function checkLogin($uuid){
        $redis=Yii::$app->redis;
        $loginuserdata=@$redis->get($uuid);
        
        if($loginuserdata){
            return json_decode($loginuserdata);
        }else{
            return false;
        }
    }
	/**
	*获取基本配置信息
	*/
    public static function setLoginUser($uuid,$loginuser,$token){
    	$redis=Yii::$app->redis;
        $userdata=[
                    'id'=>$loginuser->id,
                    'token'=>$token,
                    'uuid'=>$uuid,
                    'nickname'=>$loginuser->nickname,
                    'gold'=>$loginuser->gold,
                    'pass_score'=>$loginuser->pass_score,
                    'pass_level'=>$loginuser->pass_level,
                    'ad_flag'=>$loginuser->ad_flag,
                    'new_flag'=>$loginuser->new_flag,
                    'count'=>$loginuser->sign_count,  //签到次数-供页面使用
                    'lastCheckInTime'=>$loginuser->sign_latest_time  //最后一次签到时间-供页面使用
            ];

        $redisuserdata=json_encode($userdata);
        $flag=$redis->set($uuid,$redisuserdata);
    	return $flag;
    }
    /**
    * 更新登录用户信息
    */
    public static function updateLoginUser($uuid,$parm){
        $redis=Yii::$app->redis;
        $loginuserinfo=self::checkLogin($uuid);
        if($loginuserinfo){
            foreach ($parm as $key => $value) {
                $loginuserinfo->{$key}=$value;
            }
            $redisuserdata=json_encode($loginuserinfo);
            $flag=$redis->set($uuid,$redisuserdata);
            return $flag;
        }else{
            return false;
        }
    }

    /**
    *用户签到
    */
    public static function userSign($userinfo){
        $data=new DataUserSign();
        $now=date("Y-m-d H:i:s");

        $count=DataUserSign::find()->where(['user_id'=>$userinfo->id])->count();
        $count+=1;
        $gold=BaseDataServices::getSignData($count);

        $indata=['user_id'=>$userinfo->id,'uuid'=>$userinfo->uuid,'gold'=>$gold,'created'=>$now];
        $data->setAttributes($indata,false);
        $flag=$data->save();
        if($flag){

            
            $time=strtotime($now);

            //-----更新用户信息-------------
            $usermodel= DataUser::findOne($userinfo->id);
            $usermodel->sign_count=$count;
            $usermodel->sign_latest_time=$time;
            $usermodel->gold +=$gold;
            $usermodel->save();

            //-----保存历史消费记录-------------
            $userhismodel=new DataUserHistory();
            $hisdata=['user_id'=>$userinfo->id,'rtype'=>1,'rpt'=>2,'gold'=>$gold,'note'=>'签到积分','created'=>$now];
            $userhismodel->setAttributes($hisdata,false);
            $userhismodel->save();

            //-----更新用户缓存信息-------------
            self::updateLoginUser($userinfo->uuid,['count'=>$count,'lastCheckInTime'=>$time,'gold'=>$usermodel->gold]);
            return true;
        }else{
            return false;
        }
    }


    /**
    *用户通关
    */
    public static function updateUserPassScore($userinfo,$level,$score){
        $loginuserinfo=self::checkLogin($userinfo->uuid);
        if($loginuserinfo){
            if($score > $loginuserinfo->pass_score){
                self::updateLoginUser($userinfo->uuid,['pass_score'=>$score,'pass_level'=>$level]);
            }
        }
        return true;
    }

    /**
    * 更改用户的金币
    */
    public static function updateUserGold($userinfo,$gold,$rtype,$rpt){
    
        $falg=self::checkGoldAction($rpt,$userinfo->id);
        if(!$falg){
            return false;
        }

        $usermodel= DataUser::findOne($userinfo->id);
        if($rtype==1){
            $usermodel->gold +=$gold;
        }else{
            $usermodel->gold -=$gold;
        }
        $flag=$usermodel->save();
        if($flag){
            $uhmodel= new DataUserHistory();
            $uhmodel->user_id=$usermodel->id;
            $uhmodel->rtype=$rtype;
            $uhmodel->rpt=$rpt;
            $uhmodel->gold=$gold;
            $uhmodel->created=date("Y-m-d H:i:s");
            $uhmodel->save();
            self::updateLoginUser($usermodel->uuid,['gold'=>$usermodel->gold]);

            return $usermodel;
        }else{
            return false;
        }
    }

    /**
    * 更改用户的广告标识
    */
    public static function updateUserAdFlag($userinfo,$adflag){
        $usermodel= DataUser::findOne($userinfo->id);
        $usermodel->ad_flag = $adflag;
        $flag=$usermodel->save();
        if($flag){
            self::updateLoginUser($usermodel->uuid,['ad_flag'=>$adflag]);
            return $usermodel;
        }else{
            return false;
        }
    }

    /**
    * 更改用户的昵称
    */
    public static function updateNickname($userinfo,$nickname){
        $usermodel= DataUser::findOne($userinfo->id);
        $usermodel->nickname=$nickname;
        $flag=$usermodel->save();
        if($flag){
            self::updateLoginUser($usermodel->uuid,['nickname'=>$nickname]);
            return $usermodel;
        }else{
            return false;
        }
    }

    /**
    * 更改用户的新手引导状态
    */
    public static function updateNewFlag($userinfo,$new){
        $usermodel= DataUser::findOne($userinfo->id);
        $usermodel->new_flag=$new;
        $flag=$usermodel->save();
        if($flag){
            self::updateLoginUser($usermodel->uuid,['new_flag'=>$new]);
            return $usermodel;
        }else{
            return false;
        }
    }

    /**
    * 判断用户购买金币是否合法
    */
    public static function checkGoldAction($rpt,$user_id){
        $now=time();
        $basesetting=SettingServices::getBaseSetting();
        $intval=-1;
        switch ($rpt) {
            case 2:
                $intval=isset($basesetting['sign_intval_time'])?intval($basesetting['sign_intval_time']):0;
                break;
            case 3:
                $intval=isset($basesetting['view_intval_time'])?intval($basesetting['view_intval_time']):0;
                break;
            case 4:
                $intval=isset($basesetting['comment_intval_time'])?intval($basesetting['comment_intval_time']):0;
                break;
            case 5:
                $intval=isset($basesetting['adv_intval_time'])?intval($basesetting['adv_intval_time']):0;
                break;
            default:
                # code...
                break;
        }



        if($intval > 0){
            $cdate=date("Y-m-d H:i:s",$now-$intval);
            $num=DataUserHistory::find()->where(['user_id'=>$user_id,'rpt'=>$rpt])->andwhere(['>','created',$cdate])->count();
            if($num > 0){
                return false;
            }
        }
        return true;
    }
}