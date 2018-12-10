<?php
	use yii\helpers\Url;
    $assets_url=Yii::$app->params['assets'];
    $title=isset($this->title)?$this->title:"555律师网";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?=$assets_url?>/home/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$assets_url?>/home/bootstrap/css/l.css">
    <script src="<?=$assets_url?>/home/bootstrap/js/jquery.min.js"></script>
    <script src="<?=$assets_url?>/home/layer/layer.js"></script>
</head>
<body>
<div class="container">
	<div id="header">
        <h3>555律师网
            <small> 我的账户</small>
        </h3>
        <a href="<?=Url::to(['site/index']) ?>">返回首页</a>
    </div>
	<?=$content;?>
	<?=$this->render('footer.php');?>
</div>
<script src="<?=$assets_url?>/home/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=$assets_url?>/home/layer/video.js"></script>
<input type="hidden" id="base_uri" value="<?=Yii::$app->getHomeUrl()?>">
</body>
</html>