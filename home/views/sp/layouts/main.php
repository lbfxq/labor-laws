<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$this->title?></title>
</head>
<body>
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?=$this->render('header.php');?>
            </div>
            <div class="wrapper wrapper-content">
                <?=$content;?>
            </div>
    </div>
</div>
</body>
</html>

