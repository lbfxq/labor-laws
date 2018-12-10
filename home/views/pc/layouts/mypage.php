<?php
	use yii\helpers\Url;
    $assets_url=Yii::$app->params['assets'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->title?></title>
    <link rel="stylesheet" href="<?=$assets_url?>/home/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$assets_url?>/home/bootstrap/css/l.css">
    <script src="<?=$assets_url?>/home/bootstrap/js/jquery.min.js"></script>
    <script src="<?=$assets_url?>/home/layer/layer.js"></script>
</head>
<body>
<div class="container" id="header">
    <h3>555律师网 <small> 我的账户</small></h3>
    <a href="<?=Url::to(['site/index']) ?>">返回首页</a>
</div>
<div class="container" style="padding: 20px 0px 50px 0px">
    <div class="row">
      <div class="col-md-2">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="<?=Url::to(['mypage/index']) ?>">我的账户</a></li>
            <li role="presentation"><a href="<?=Url::to(['mypage/order']) ?>">我的订单</a></li>
          </ul>
      </div>
      <div class="col-md-10">
            <?=$content;?>
      </div>
    </div>
</div>
<?=$this->render('footer.php');?>
<script src="<?=$assets_url?>/home/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=$assets_url?>/home/layer/video.js"></script>
<input type="hidden" id="base_uri" value="<?=Yii::$app->getHomeUrl()?>">
</body>
</html>