<?php
namespace common\services;
/**
 * 返回客户端状态类型
 * Class ResultStatusServices
 * @package common\services
 */
class RedisKeysServices
{
    const BASE_SETTING = "ckeys_base_setting";//基础设置的下标
    const PASS_KEYS = "ckeys_pass_key";//闯关设定的下标
    const CURRENT_DEKARON_KEYS = "ckeys_current_dekaron_key";//当前挑战关卡的下标
    const BASE_PRODUCT = "ckeys_base_product";//产品的下标
    const BASE_ADS = "ckeys_base_ads";//广告的下标
}
