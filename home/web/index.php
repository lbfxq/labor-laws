<?php
// comment out the following two lines when deployed to production
require(__DIR__ . '/../../common/vendor/autoload.php');
require(__DIR__ . '/../../common/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/utils/BrowserUtil.php');


defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('ROOT_DIR') or define('ROOT_DIR', __DIR__);
defined('BROWSER') or define('BROWSER', common\utils\BrowserUtil::isMobile()?"sp":"pc");//判断是否是手机端访问


$config = require(__DIR__ . '/../config/web.php');


(new yii\web\Application($config))->run();