<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\DataCategory;

$keywords = Yii::$app->request->get("keywords", "");
$cid = Yii::$app->request->get("cid", "");
$cid = intval($cid);
$rq_action = $this->context->action->id;
$rq_controller = $this->context->action->controller->id;
if ($rq_action == "index" && $rq_controller == "site") {
    $indexflag = true;
} else {
    $indexflag = false;
}
$title = "555律师网";


if ($rq_controller == "project") {
    $projectflag = true;
    $title="法律顾问";
} else {
    $projectflag = false;
}

if ($rq_controller == "site" && $rq_action=="about") {
    $aboutflag = true;
    $title="律师介绍";
} else {
    $aboutflag = false;
}



$parent_id = 0;
$categoryflag=false;
if (!$indexflag && $cid > 0) {
    $category = DataCategory::findOne($cid);
    $title = $category->name;
    $parent_id = $category->parent_id;

    $categoryflag=true;
}
$menus = DataCategory::getTree();
?>
<header>

    <div class="navbar">

        <div class="collapse navbar-collapse" style="padding:0">
            <nav role="navigation" class="container">
                <div class="page-header mt10 pm0 mb0">
                    <?php
                    if (!$indexflag) {
                        ?>
                        <h1 class="logo">555律师网</h1>
                    <?php } ?>
                    <h3 class="text-center mt0 my-text-color">
                        <?= $title ?>
                    </h3>
                </div>
        </div>
        <div class="collapse navbar-collapse"  style="padding:0">
            <nav role="navigation" class="container">
                <ul class="nav navbar-nav nav-tabs dropdown">
                    <li <?php if ($indexflag) {
                        echo 'class="active dropdown-toggle"';
                    } ?> ><a href="<?= Url::to(['site/index']) ?>">首页</a></li>
                    <?php
                    if ($menus) {
                        foreach ($menus as $menu) {
                            ?>
                            <li <?php if ($cid == $menu['id'] || $parent_id == $menu['id']) {
                                echo 'class="active"';
                            }?> >
                                <a href="<?= Url::to(['category/index', 'cid' => $menu['id']]) ?>"><?= $menu['name'] ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>

                    
                    <li <?php if ($aboutflag) {
                        echo 'class="active dropdown-toggle"';
                    } ?> ><a href="<?= Url::to(['site/about']) ?>">律师介绍</a></li>
                    <li <?php if ($projectflag) {
                        echo 'class="active dropdown-toggle"';
                    } ?> ><a href="<?= Url::to(['project/index']) ?>">法律顾问</a></li>
                </ul>
                <form class="navbar-form navbar-right" method="get" action="<?= Url::to(['search/index']) ?>">
                    <div class="form-group" style="position: relative">
                        <input type="text" class="form-control" placeholder="Search" name="keywords"
                               value="<?= $keywords ?>"
                               style="font-size: 10pt;height: auto;border-radius: 0.5rem;border: 0;padding-right: 33px;background: rgba(80,80,80,1);color: #fff;">
                        <button type="submit" class="btn btn-default btn-submit no-border-shadow no-outline"
                                style="font-size: 10pt;position: absolute;top: 0;right: 0;background: transparent">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </nav>
            

        </div>
        <div class="submenusbox">
             <?php
                if ($menus) {
                    foreach ($menus as $menu) {
                        if ($cid == $menu['id'] || $parent_id == $menu['id']){
                        ?>
                            <ul class="submenus clearfix">
                                <?php
                                if (count(@$menu['childs']) > 0) {
                                    foreach ($menu['childs'] as $key => $m) {
                                        ?>
                                        <li>
                                            <!-- 默认选中第一个 你根据需求自己改哈-->
                                            <a href="<?= Url::to(['category/index', 'cid' => $m['id']]) ?>" <?
                                            if ($cid == $m['id']) {
                                                echo 'class="active"';
                                            } else {
                                                echo 'class=""';
                                            } ?> ><?= $m['name'] ?></a>

                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                    }
                }
                ?>
        </div>
    </div>
    </div>
</header>

<script>
    $(function () {
      var catflag = `<?=$categoryflag?>`
      if(!catflag){
        $('body > .tab-content').css('marginTop',130)
      }else{
        $('body > .tab-content').css('marginTop',160)
      }
    })
</script>