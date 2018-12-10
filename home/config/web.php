<?php
$baseurl = dirname(__DIR__);
Yii::setAlias('@common', $baseurl . "/../common");
Yii::setAlias('@bower', dirname(dirname(__DIR__)) . '/common/vendor/bower');
Yii::setAlias('@npm', dirname(dirname(__DIR__)) . '/common/vendor/npm');
Yii::setAlias('@vendor', dirname(dirname(__DIR__)) . '/common/vendor');

$config = [
    'id' => 'home',
    'name'=>'后台管理',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log'
    ],
    'vendorPath' => "@common/vendor",
    'defaultRoute' => 'site/index',//默认控制器
    'timeZone' => 'Asia/Shanghai',
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module', //api模块
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'testas',
            'enableCsrfValidation' => false   //跨域提交问题
        ],
       'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' =>'@app/views/'.BROWSER,//实际模板路径
                ],
            ],
        ],
        'user' => [
            'identityClass' => '',
            'enableAutoLogin' => false
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
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
        ]
    ],
    'params' => require(__DIR__ . '/../../common/config/params.php'),

];


if (YII_ENV_DEV) {
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module'
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs'=>["*"]
    ];
}


return $config;
