<?php
namespace common\services;
/**
 * 返回客户端状态类型
 * Class ResultStatusServices
 * @package common\services
 */
class ResultStatusServices
{
    const SUCCESS = 0;//操作成功
    const FAIL = 300;//操作失败
    const NOT_LOGIN = 301;//未登录
    const PARM_ERROR = 302;//参数错误
    const GET_ERROR = 303;//请求失败
    
    const USER_UUID_EXIST = 401;//用户的设备号已经存在
    const USER_UUID_EMPTY = 402;//用户的设备号为空
    const USER_LOGIN_ERROR = 403;//用户登录失败
    const USER_UNLOGIN = 405;//用户被禁止登录
    const USER_NICKNAME_EXIST = 406;//昵称已经存在

    const DEKARON_NOT_EXIST = 501;//挑战关卡不存在
    const PASS_NOT_EXIST = 502;//闯关关卡不存在
    const PASS_RECORED_NOT_EXIST = 503;//闯关的记录不存在，闯关记录是每次玩第一关的时候生成
    const RANK_NOT_IN = 505;//没有进入排行榜

    const PAYMENT_NOT_INSERVICE = 601;//支付渠道停用
    const ORDER_EXISTS = 602;//订单已经存在
    const PRODUCT_NOT_EXISTS = 603;//产品不存在
    const PAYMENT_NOT_EXISTS = 604;//支付渠道不存在
    const PAYMENT_FAIL = 605;//购买失败


    const GAME_NOT_EXIST = 701;//游戏不存在或者已经下线
    const SERVER_NOT_EXIST = 702;//游戏服务器不存在或者已经下线



}
