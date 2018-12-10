<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理系统</title>
    <link href="<?=Yii::$app->getHomeUrl()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=Yii::$app->getHomeUrl()?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- datapicker style -->
    <link href="<?=Yii::$app->getHomeUrl()?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?=Yii::$app->getHomeUrl()?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="<?=Yii::$app->getHomeUrl()?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="<?=Yii::$app->getHomeUrl()?>css/animate.css" rel="stylesheet">
    <link href="<?=Yii::$app->getHomeUrl()?>css/style.css" rel="stylesheet">
    <link href="<?=Yii::$app->getHomeUrl()?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- Mainly scripts -->
    <script src="<?=Yii::$app->getHomeUrl()?>js/jquery-2.1.1.js"></script>
    <script src="<?=Yii::$app->getHomeUrl()?>js/bootstrap.min.js"></script>
    <script src="<?=Yii::$app->getHomeUrl()?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=Yii::$app->getHomeUrl()?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
</head>
<body>
<div id="wrapper">
    <?=$this->render('left.php');?>
    <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?=$this->render('header.php');?>
            </div>
            <div class="wrapper wrapper-content">
                <?=$content;?>
            </div>
    </div>
</div>
<!-- Custom and plugin javascript -->
<script src="<?=Yii::$app->getHomeUrl()?>js/inspinia.js"></script>
<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    function del_confirm() {
        if(confirm("删除数据将无法恢复，请确认！")){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>

