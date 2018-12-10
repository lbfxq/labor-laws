<?php
return [
    'assets'=>'http://localhost/zcw_new/assets/',
    'smtp'=>[//发送邮件的配置信息
    			'host'=>'smtp.126.com',
    			'account'=>'hansen102030@126.com',
    			'password'=>'1q2w3e',
    			'mailfrom'=>'hansen102030@126.com',
    			'mailfromname'=>'666律师网',
    		],
    'payment'=>[//支付中心的配置信息
    		'url'=>'http://localhost/pro_payment/trunk/code/api/web/v1',
    		'AppID'=>'xmmtest',
    		'AppKey'=>'a36baa197a2f48ce772dd8bdf923b539',
    		'AppSafeKey'=>'ed46d60add0766a6c272e92fc355fa97',
    ]
];
