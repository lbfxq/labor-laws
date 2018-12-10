<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <link href="<?=Yii::$app->getHomeUrl()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=Yii::$app->getHomeUrl()?>css/animate.css" rel="stylesheet">
    <link href="<?=Yii::$app->getHomeUrl()?>css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>管理系统</h3>
            <form class="m-t" role="form" action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password"  name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登录</button>
            </form>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?=Yii::$app->getHomeUrl()?>js/jquery-2.1.1.js"></script>
    <script src="<?=Yii::$app->getHomeUrl()?>js/bootstrap.min.js"></script>
</body>
</html>
