<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/6/14
 * Time: 14:08
 */

namespace common\utils;


use RedisClient\RedisClient;
use Yii;

class MyRedisClient extends RedisClient
{
    //redis更新了key列表
    private $_redisSaveKeyList = [];

    public function __construct(array $config = null)
    {
        $config = parent::$defaultConfig;

        if (!empty(Yii::$app->params['redis_server']))
            $config[parent::CONFIG_SERVER] = sprintf('%s:%s', Yii::$app->params['redis_server'], Yii::$app->params['redis_port']);

        if (!empty(Yii::$app->params['redis_password']))
            $config[parent::CONFIG_PASSWORD] = Yii::$app->params['redis_password'];

        $this->setConfig($config);
    }

    /**
     * 添加修改过的key
     * @param $key
     */
    public function addKey($key)
    {
        array_push($this->_redisSaveKeyList, $key);
    }

    /**
     * 删除脏数据
     */
    public function clearDirtyKey()
    {
        if (count($this->_redisSaveKeyList) > 0)
            $this->del($this->_redisSaveKeyList);
    }
}