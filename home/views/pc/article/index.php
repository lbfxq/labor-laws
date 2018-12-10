<?php

use yii\helpers\Url;

$assets_url = Yii::$app->params['assets'];
?>
<div class="tab-content">
    <?php if ($ads_hf) {?>
        <div class="container carousel">
            <a href="<?=$ads_hf->links?>" class="thumbnail">
                <img src="<?=$ads_hf->vimg?>" alt="">
            </a>
        </div>
    <?php }?>

    <div class="container mb10">
        <div class="container-fluid">
            <!-- flex -->
            <div class="row ">
                <div class="myleft">
                    <div>
                        <h4><?=$data->title?></h4>
                        <p class="sutime">更新于:<?=substr($data->updated,0,4)?>年<?=substr($data->updated,5,2)?>月<?=substr($data->updated,8,2)?>日 | 阅读量:<?=$data->clicknum?></p>
                        
                    <div class="media" id="article_content">
                        <?=$data->content?>
                    </div>
                    <div class="media">
                        <h5><span class="label label-default my-label-default" style="background-color: #b1171c;">我要咨询律师</span></h5>
                        <address style="color:#b1171c">
                            张春伟 律师 13901760220<br>
                            上海正策律师事务所 合伙人<br>
                            zhangchunwei@joint-win.com<br>
                            上海市浦东新区陆家嘴环路479号上海中心大厦6101室/200122
                        </address>
                    </div>
                    <div class="bshare-custom icon-medium">
                        <a title="分享到QQ空间" class="bshare-qzone"></a>
                        <a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
                        <a title="分享到人人网" class="bshare-renren"></a>
                        <a title="分享到腾讯微博" class="bshare-qqmb"></a>
                        <a title="分享到网易微博" class="bshare-neteasemb"></a>
                        <a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
                        <span class="BSHARE_COUNT bshare-share-count">0</span>
                        <script type="text/javascript" charset="utf-8"
                                src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
                        <script type="text/javascript" charset="utf-8"
                                src="http://static.bshare.cn/b/bshareC0.js"></script>
                    </div>
                </div>
                    <div class="media">
                        <div class="listtitle">
                            <?=$category->name?>
                            <div class="line3">
                                <div class="dashed-line"></div>
                                <div class="dashed-line"></div>
                                <div class="dashed-line"></div>
                            </div>
                        </div>
                        <div class="row my-flex">
                            <?php
if ($categorydata) {
	foreach ($categorydata as $item) {
		?>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail mb0">
                                            <a href="<?=Url::to(['article/index', 'id' => $item->id])?>">
                                                <img src="<?=$item->vimg?>" alt="<?=$item->title?>">
                                            </a>
                                        </div>
                                        <div class="caption">
                                            <h6>
                                                <a href="<?=Url::to(['article/index', 'id' => $item->id])?>" class="fbword"><?=$item->title?></a>
                                            </h6>
                                        </div>
                                    </div>
                                    <?php
}
}
?>
                        </div>
                    </div>

                    <div class="media">
                        <h5><span class="label label-default my-label-default">版权声明</span></h5>
                        <address>
                            <strong>如因作品内容、版权和其他问题需要与555律师网联系的，请按以下联系方式与我们联系：</strong><br>
                            联系人: 黄蓉<br>
                            电话:13901719510<br>
                            电邮:extrawell@hotmail.com<br>
                        </address>
                    </div>

                </div>


                <div class="my-ol">
                    <div id="myAffix">
                        <?php if($ads_rf){?>
                        <a href="<?=$ads_rf->links?>" class="adright">
                            <img src="<?=$ads_rf->vimg?>" alt="" width="100%">
                        </a>
                        <?php } ?>
                        <?=$this->render('../common/hot.php');?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>