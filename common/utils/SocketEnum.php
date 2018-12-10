<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/15
 * Time: 11:08
 */

namespace common\utils;

/**命令
 * Class CommandEnum
 * @package comm
 */
class SocketEnum
{
    //command
    const COMMAND_ERROR_R = 0;//有错误返回

    //登录
    const COMMAND_LOGIN = 1;//登录
    const COMMAND_LOGIN_R = 2;//登录返回

    //消息
    const COMMAND_MESSAGE_R = 4;//个人消息

    //全服小喇叭消息
    const COMMAND_ALL_SUONA_MESSAGE_R = 6;

    //Task
    const TASK_ALL_BROADCAST_MESSAGE = 'broadcastMessage';//全服广播

}