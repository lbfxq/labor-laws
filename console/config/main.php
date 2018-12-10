<?php
$baseurl=dirname(__DIR__);
Yii::setAlias('@common',$baseurl."/../common");

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\controllers',
    'timeZone' => 'Asia/Shanghai',
    
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/../../common/config/db.php'),
        'mailer' => [  
               'class' => 'yii\swiftmailer\Mailer',  
                'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
               'transport' => [  
                   'class' => 'Swift_SmtpTransport',  
                   'host' => 'smtp.126.com',  //每种邮箱的host配置不一样
                   'username' => 'hansen102030@126.com',  
                   'password' => '1q2w3e',  
                   /*'port' => '25',  
                   'encryption' => 'tls',  */
                   'port' => '465',  
                   'encryption' => 'ssl',
                ],   
               'messageConfig'=>[  
                   'charset'=>'UTF-8',  
                   'from'=>['hansen102030@126.com'=>'admin']
                   ],  
            ],  
        ],
    'params' => require(__DIR__ . '/../../common/config/params.php'),
];

return $config;
