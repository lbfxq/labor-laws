<?php
$assets_url = Yii::$app->params['assets'];
$title=isset($this->title)?$this->title:"555律师网";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?= $assets_url ?>/home/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $assets_url ?>/home/bootstrap/css/reset.css">
    <link rel="stylesheet" href="<?= $assets_url ?>/home/bootstrap/css/project.css">
    <script src="<?= $assets_url ?>/home/bootstrap/js/jquery.min.js"></script>
    <script src="<?= $assets_url ?>/home/layer/layer.js"></script>
    <script src="<?= $assets_url ?>/home/layer/layui.js"></script>
   <script> var _hmt = _hmt || []; (function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?2b31417dd1cd0f65aaa462ce261dc0f4"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hm, s); })(); </script>

</head>
<body>
<?= $this->render('header.php'); ?>
<?= $content; ?>
<?= $this->render('footer.php'); ?>
<script src="<?= $assets_url ?>/home/bootstrap/js/bootstrap.min.js"></script>
<input type="hidden" id="base_uri" value="<?= Yii::$app->getHomeUrl() ?>">
</body>
</html>