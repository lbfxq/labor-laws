<?php
$baseurl = dirname(__DIR__);
Yii::setAlias('@common', $baseurl . "/../common");
Yii::setAlias('@bower', dirname(dirname(__DIR__)) . '/common/vendor/bower');
Yii::setAlias('@npm', dirname(dirname(__DIR__)) . '/common/vendor/npm');
Yii::setAlias('@vendor', dirname(dirname(__DIR__)) . '/common/vendor');

Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@assetspath', dirname(dirname(__DIR__)) . '/assets');

$config = [
    'id' => 'backend',
    'name'=>'后台管理',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log'
    ],
    'vendorPath' => "@common/vendor",
    'defaultRoute' => 'site/index',//默认控制器
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'testas',
            'enableCsrfValidation' => false   //跨域提交问题
        ],
        'user' => [
            'identityClass' => '',
            'enableAutoLogin' => false
        ],
        'cache' => [
            'class' => 'yii\redis\Cache'
        ],
        'errorHandler' => [
            'errorAction' => 'error/index'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ],
                    'exportInterval' => 0,
                    'logVars' => [],
                ]
            ],
            'flushInterval' => 0,
        ],
        'db' => require(__DIR__ . '/../../common/config/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ]
        ],
        'redis' => [
            'class' => 'common\utils\MyRedisClient',
        ],
    ],
    'params' => require(__DIR__ . '/../../common/config/params.php'),
    /*'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => ['site/login', 'site/login-out']
    ],*/

];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module'
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module'
    ];
}


return $config;
