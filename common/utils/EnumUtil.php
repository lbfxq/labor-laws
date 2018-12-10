<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/12
 * Time: 10:51
 */

namespace common\utils;


use common\services\ResultStatusServices;

class EnumUtil
{
    //游戏名称
    const GAME_NAME = 'farm_hunan';

    //删除
    const DELETE_NOT = 0;
    const DELETE = 1;
    const DELETE_LIST = [
        self::DELETE_NOT,
        self::DELETE
    ];

    //是否激活
    const ACTIVE_NOT = 0;
    const ACTIVE = 1;
    const ACTIVE_LIST = [
        self::ACTIVE_NOT,
        self::ACTIVE
    ];

    //性别
    const SEX_MAN = 0;//男
    const SEX_WOMAN = 1;//女
    const SEX_LIST = [self::SEX_MAN, self::SEX_WOMAN];

    const SEX_LIST_STR = [
        self::SEX_MAN => '男',
        self::SEX_WOMAN => '女',
    ];

    public static function getSexString($sex)
    {
        $list = [
            self::SEX_MAN => '男',
            self::SEX_WOMAN => '女',
        ];

        return $list[$sex];
    }

    //分销返点类型
    const REBATE_TYPE_SELL = 0;//卖
    const REBATE_TYPE_BUY = 1;//买

    const REBATE_TYPE_LIST = [
        self::REBATE_TYPE_SELL,
        self::REBATE_TYPE_BUY,
    ];

    //交易类型
    const DEAL_TYPE_PERSENT_MONEY = 0;//赠送金钱
    const DEAL_TYPE_PERSENT_ITEM = 1;//赠送物品
    const DEAL_TYPE_LIST = [
        self::DEAL_TYPE_PERSENT_MONEY,
        self::DEAL_TYPE_PERSENT_ITEM,
    ];
    const DEAL_TYPE_LIST_STR = [
        self::DEAL_TYPE_PERSENT_MONEY => '赠送金钱',
        self::DEAL_TYPE_PERSENT_ITEM => '赠送物品',
    ];

    //是否确认
    const NOT_CONFIRM = 0;//没确认
    const CONFIRM = 1;//确认
    const CONFIRM_LIST = [self::NOT_CONFIRM, self::CONFIRM];
    const CONFIRM_LIST_STR = [
        self::NOT_CONFIRM => '否',
        self::CONFIRM => '是',
    ];

    //是否完成
    const NOT_COMPETE = 0;//没完成
    const COMPETE = 1;//完成
    const COMPETE_LIST = [self::NOT_COMPETE, self::COMPETE];
    const COMPETE_LIST_STR = [
        self::NOT_COMPETE => '否',
        self::COMPETE => '是',
    ];

    const STATUS_UNTREATED = 0;//未处理
    const STATUS_AGREE = 1;//同意
    const STATUS_REFUSE = 2;//拒绝

    //加好友
    const FRIEND_UNTREATED = 0;//未处理
    const FRIEND_AGREE = 1;//同意
    const FRIEND_REFUSE = 2;//拒绝
    const FRIEND_LIST = [
        self::FRIEND_UNTREATED,
        self::FRIEND_AGREE,
        self::FRIEND_REFUSE,
    ];

    //交互
    const INTERACTION_TYPE_STEAL = 0;//偷菜
    const INTERACTION_TYPE_BUG = 1;//放虫
    const INTERACTION_TYPE_GRASS = 2;//放草
//    const INTERACTION_TYPE_WATERING = 3;//浇水
//    const INTERACTION_TYPE_DISINSECTION = 4;//除虫
//    const INTERACTION_TYPE_WEEDING = 5;//除草

    const INTERACTION_TYPE_LIST = [
        self::INTERACTION_TYPE_STEAL,
        self::INTERACTION_TYPE_BUG,
        self::INTERACTION_TYPE_GRASS,
//        self::INTERACTION_TYPE_WATERING,
//        self::INTERACTION_TYPE_DISINSECTION,
//        self::INTERACTION_TYPE_WEEDING,
    ];

    //客户端传输过来的错误操作返回码
    const INTERACTION_OPERATE_TYPE_ERROR_TO_RS_LIST = [
        self::INTERACTION_TYPE_STEAL => ResultStatusServices::RS_INTERACTION_CAN_NOT_STEAL,
        self::INTERACTION_TYPE_BUG => ResultStatusServices::RS_INTERACTION_CAN_NOT_BUG,
        self::INTERACTION_TYPE_GRASS => ResultStatusServices::RS_INTERACTION_CAN_NOT_GRASS,
//        self::INTERACTION_TYPE_WATERING => ResultStatusServices::RS_INTERACTION_CAN_NOT_WATERING,
//        self::INTERACTION_TYPE_DISINSECTION => ResultStatusServices::RS_INTERACTION_CAN_NOT_DISINSECTION,
//        self::INTERACTION_TYPE_WEEDING => ResultStatusServices::RS_INTERACTION_CAN_NOT_WEEDING,
    ];

    //农田
    //最大农田索引
    const LAND_MAX_POSITION = 11;

    //最大农田等级
    const LAND_MAX_LEVEL = 3;

    //病虫害类型
    const LAND_DISEASE_TYPE_DRY = 0;//干旱
    const LAND_DISEASE_TYPE_BUG = 1;//虫
    const LAND_DISEASE_TYPE_GRASS = 2;//草

    const LAND_DISEASE_TYPE_LIST = [
        self::LAND_DISEASE_TYPE_DRY,
        self::LAND_DISEASE_TYPE_BUG,
        self::LAND_DISEASE_TYPE_GRASS,
    ];

    //用户日志
    const USER_LOG_TYPE_BUY = 0;//购买
    const USER_LOG_TYPE_SELL = 1;//卖出
    const USER_LOG_TYPE_SOW_SEED = 2;//播种
    const USER_LOG_TYPE_GATHER = 3;//收获
    const USER_LOG_TYPE_STEAL = 4;//偷取
    const USER_LOG_TYPE_FERTILIZATION = 5;//施肥
    const USER_LOG_TYPE_CLEAN_LAND = 6;//锄地
    const USER_LOG_TYPE_UPGRADE_LAND = 7;//土地升级
    const USER_LOG_TYPE_CHANGE_FARM_STYLE = 8;//切换农场风格
    const USER_LOG_TYPE_FEED_DOG = 9;//喂狗
    const USER_LOG_TYPE_BUG = 10;//放虫
    const USER_LOG_TYPE_GRASS = 11;//放草
    const USER_LOG_TYPE_WATERING = 12;//浇水
    const USER_LOG_TYPE_DISINSECTION = 13;//除虫
    const USER_LOG_TYPE_WEEDING = 14;//除草
    const USER_LOG_TYPE_EXPAND_LAND = 15;//扩展土地
    const USER_LOG_TYPE_UPGRADE_FARM = 16;//升级农场
    const USER_LOG_TYPE_BE_STEAL = 17;//被偷
    const USER_LOG_TYPE_CATCH = 18;//抓贼
    const USER_LOG_TYPE_BE_CATCH = 19;//被抓
    const USER_LOG_TYPE_BE_BUG = 20;//被放虫
    const USER_LOG_TYPE_BE_GRASS = 21;//被放草
    const USER_LOG_TYPE_BE_WATERING = 22;//被浇水
    const USER_LOG_TYPE_BE_DISINSECTION = 23;//被除虫
    const USER_LOG_TYPE_BE_WEEDING = 24;//被除草
    const USER_LOG_TYPE_USE_GIFT = 25;//使用新手礼包

    //操作类型列表
    const USER_LOG_TYPE_LIST = [
        self::USER_LOG_TYPE_BUY,
        self::USER_LOG_TYPE_SELL,
        self::USER_LOG_TYPE_SOW_SEED,
        self::USER_LOG_TYPE_GATHER,
        self::USER_LOG_TYPE_STEAL,
        self::USER_LOG_TYPE_FERTILIZATION,
        self::USER_LOG_TYPE_CLEAN_LAND,
        self::USER_LOG_TYPE_UPGRADE_LAND,
        self::USER_LOG_TYPE_CHANGE_FARM_STYLE,
        self::USER_LOG_TYPE_FEED_DOG,
        self::USER_LOG_TYPE_BUG,
        self::USER_LOG_TYPE_GRASS,
        self::USER_LOG_TYPE_WATERING,
        self::USER_LOG_TYPE_DISINSECTION,
        self::USER_LOG_TYPE_WEEDING,
        self::USER_LOG_TYPE_EXPAND_LAND,
        self::USER_LOG_TYPE_UPGRADE_FARM,
        self::USER_LOG_TYPE_BE_STEAL,
        self::USER_LOG_TYPE_CATCH,
        self::USER_LOG_TYPE_BE_CATCH,
        self::USER_LOG_TYPE_BE_BUG,
        self::USER_LOG_TYPE_BE_GRASS,
        self::USER_LOG_TYPE_BE_WATERING,
        self::USER_LOG_TYPE_BE_DISINSECTION,
        self::USER_LOG_TYPE_BE_WEEDING,
        self::USER_LOG_TYPE_USE_GIFT,
    ];

    //是否已读
    const NOT_READ = 0;//未读
    const READED = 1;//已读
    const READ_LIST = [self::NOT_READ, self::READED];

    //消息类型
    const MESSAGE_CONFIRM_BE_USER_DEAL = 0;//受赠方需确认交易
    const MESSAGE_ADD_FRIEND = 1;//请求加好友
    const MESSAGE_ADD_FRIEND_RESPONSE = 2;//请求加好友回复
    const MESSAGE_CONFIRM_FROM_USER_DEAL = 3;//发起方需确认交易
    const MESSAGE_DEAL_COMPLETE = 4;//交易成功
    const MESSAGE_LIST = [
        self::MESSAGE_CONFIRM_BE_USER_DEAL,
        self::MESSAGE_ADD_FRIEND,
        self::MESSAGE_ADD_FRIEND_RESPONSE,
        self::MESSAGE_CONFIRM_FROM_USER_DEAL,
        self::MESSAGE_DEAL_COMPLETE,
    ];

    const MESSAGE_DEAL_LIST = [
        self::MESSAGE_CONFIRM_BE_USER_DEAL,
        self::MESSAGE_CONFIRM_FROM_USER_DEAL,
        self::MESSAGE_DEAL_COMPLETE,
    ];

    //抽奖类型
    const LOTTERY_TYPE_GOLD = 1;//金币
    const LOTTERY_TYPE_GEM = 2;//钻石
    const LOTTERY_TYPE_ITEM = 3;//物品
    const LOTTERY_LIST = [
        self::LOTTERY_TYPE_GOLD,
        self::LOTTERY_TYPE_GEM,
        self::LOTTERY_TYPE_ITEM,
    ];
    const LOTTERY_LIST_STR = [
        self::LOTTERY_TYPE_GOLD => '金币',
        self::LOTTERY_TYPE_GEM => '钻石',
        self::LOTTERY_TYPE_ITEM => '物品',
    ];

    //审核通过
    const VERIFY_WAIT = 0;//待审核
    const VERIFY_PASS = 1;//审核通过
    const VERIFY_REFUSE = 2;//审核未通过
    const VERIFY_LIST = [
        self::VERIFY_WAIT,
        self::VERIFY_PASS,
        self::VERIFY_REFUSE,
    ];
    const VERIFY_LIST_STR = [
        self::VERIFY_WAIT => '待审核',
        self::VERIFY_PASS => '审核通过',
        self::VERIFY_REFUSE => '审核未通过',
    ];

    //农作物生长阶段
    const CROP_PHASE_SEED = 0;//种子
    const CROP_PHASE_SEEDLING = 1;//幼苗
    const CROP_PHASE_GROW = 2;//生长
    const CROP_PHASE_RIPE = 3;//成熟

    //用户系统日志
    const USER_SYSTEM_LOG_DEAL_COMPLETE = 0;//交易成功
    const USER_SYSTEM_LOG_FRIEND = 1;//交友信息
    const USER_SYSTEM_LOG_DRAW_PERCENTAGE = 2;//交易提成
    const USER_SYSTEM_LOG_LIST = [
        self::USER_SYSTEM_LOG_DEAL_COMPLETE,
        self::USER_SYSTEM_LOG_FRIEND,
        self::USER_SYSTEM_LOG_DRAW_PERCENTAGE,
    ];

}