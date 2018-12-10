<?php
namespace common\services;
use Yii;

/**
 * 返回客户端状态类型
 * Class ResultStatusServices
 * @package common\services
 */
class BaseDataServices
{
	/**
	*获取复活需要的金币数量
	*/
    public static function getReliveData($time){
        $data=[
            1=>20,
            2=>50,
            3=>100,
            4=>200,
            5=>300
        ];
        if($time >0){
            return $data[$time];
        }else{
            return $data;
        }
    }

    /**
    *获取悔棋需要的金币数量
    */
    public static function getUndoData($time){
        $data=[
            1=>10,
            2=>25,
            3=>50,
            4=>100,
            5=>150
        ];
        if($time >0){
            return $data[$time];
        }else{
            return $data;
        }
    }

    /**
    *获取签到的金币数
    */
    public static function getSignData($time){
        $index=$time % 3;
        if($index==0){
            $index=3;
        }
        $data=[
            1=>5,
            2=>10,
            3=>15,
        ];
        if($time >0){
            return $data[$index];
        }else{
            return $data;
        }
    }
}