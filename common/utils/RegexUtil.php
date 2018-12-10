<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/13
 * Time: 10:54
 */

namespace common\utils;


class RegexUtil
{
    /**
     * @匹配正则公共方法
     */
    public static function PublicMethod($pattern, $v)
    {
        if (preg_match($pattern, $v)) {
            return true;
        }
        return false;
    }

    /**
     * 电话
     * @param $v
     * @return bool
     */
    public static function validatePhone($v)
    {
        $pattern = '/^(0|86|17951)?(13[0-9]|15[012356789]|1[78][0-9]|14[57])[0-9]{8}$/';
        return RegexUtil::PublicMethod($pattern, $v);
    }

    /**邮件
     * @param $v
     * @return bool
     */
    public static function validateEmail($v)
    {
        $pattern = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
        return RegexUtil::PublicMethod($pattern, $v);
    }


}