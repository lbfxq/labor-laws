<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/14
 * Time: 16:01
 */

namespace common\utils;

/**
 * key
 * Class KeyUtil
 * @package common\utils
 */
class RedisKeyUtil
{
    //服务器worker轮训
    public static function serverTick()
    {
        return sprintf('%s.serverTick', EnumUtil::GAME_NAME);
    }

    //-------------------------------------------消息--------------------------------------------------------------------
    //客户端消息
    public static function clientMessageList()
    {
        return sprintf('%s.message.client.list', EnumUtil::GAME_NAME);
    }

    //广播消息列表
    public static function broadcaseMessageList()
    {
        return sprintf('%s.broadcaseMessageList', EnumUtil::GAME_NAME);
    }

    //-------------------------------------------end--------------------------------------------------------------------


    //-------------------------------------------用户--------------------------------------------------------------------
    //用户名toToken
    public static function userInfoByPhone($username)
    {
        return sprintf('%s.user.info.phone.%s', EnumUtil::GAME_NAME, $username);
    }

    public static function userInfoByToken($token)
    {
        return sprintf('%s.user.info.token.%s', EnumUtil::GAME_NAME, $token);
    }

    public static function userInfoByUserID($userID)
    {
        return sprintf('%s.user.info.userID.%s', EnumUtil::GAME_NAME, $userID);
    }

    public static function userInfoByFD($fd)
    {
        return sprintf('%s.user.fd.%s', EnumUtil::GAME_NAME, $fd);
    }

    public static function userID($userID)
    {
        return sprintf('%s.user.%s', EnumUtil::GAME_NAME, $userID);
    }

    public static function lockUserMoney($userID)
    {
        return sprintf('%s.user.money.lock.%s', EnumUtil::GAME_NAME, $userID);
    }

    public static function userLotteryData($userID)
    {
        return sprintf('%s.user.lastLotteryData%s', EnumUtil::GAME_NAME, $userID);
    }

    //用户抽奖锁定
    public static function lockUserLottery($userID)
    {
        return sprintf('%s.user.lottery.lock.%s', EnumUtil::GAME_NAME, $userID);
    }
    //-------------------------------------------end--------------------------------------------------------------------

    //-------------------------------------------农场--------------------------------------------------------------------
    public static function farmUserID($userID)
    {
        return sprintf('%s.farm.userID.%s', EnumUtil::GAME_NAME, $userID);
    }
    //-------------------------------------------end--------------------------------------------------------------------

    //-------------------------------------------交互--------------------------------------------------------------------
    public static function interaction($fromUserID, $beUserID, $landCreateTime, $position, $type)
    {
        return sprintf('%s.interaction.%s.%s.%d.%d.%d', EnumUtil::GAME_NAME, $fromUserID, $beUserID, $landCreateTime, $position, $type);
    }
    //-------------------------------------------end--------------------------------------------------------------------

    //-------------------------------------------农田--------------------------------------------------------------------
    public static function land($farmID, $position)
    {
        return sprintf('%s.land.%s.%d', EnumUtil::GAME_NAME, $farmID, $position);
    }
    public static function lockLand($farmID, $position)
    {
        return sprintf('%s.land.lock.%s.%d', EnumUtil::GAME_NAME, $farmID, $position);
    }
    //-------------------------------------------end--------------------------------------------------------------------

    //-------------------------------------------交易--------------------------------------------------------------------
    public static function lockDeal($dealID)
    {
        return sprintf('%s.deal.lock.%d', EnumUtil::GAME_NAME, $dealID);
    }
    //-------------------------------------------end--------------------------------------------------------------------

    //-------------------------------------------物品--------------------------------------------------------------------
    public static function lockItem($userID, $itemID)
    {
        return sprintf('%s.item.lock.%s.%s', EnumUtil::GAME_NAME, $userID, $itemID);
    }
    //-------------------------------------------end--------------------------------------------------------------------
}