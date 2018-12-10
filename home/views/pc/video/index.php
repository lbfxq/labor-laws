<?php
use yii\helpers\Html;
use yii\helpers\Url;

$assets_url=Yii::$app->params['assets'];
?>
<div class="tab-content">
    <?php if($ads_hf){?>
    <div class="container carousel">
        <a href="<?=$ads_hf->links?>" class="thumbnail">
            <img src="<?=$ads_hf->vimg?>" alt="">
        </a>
    </div>
    <?php } ?>

    <div class="container mb10">
        <div class="container-fluid">
            <!-- flex -->
            <div class="row ">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div>
                        <h4><?=$video->title?></h4>
                        <div class="thumbnail mb0">
                            <?=$this->render('../common/video.php',['video'=>$video]);?>
                        </div>
                        <div class="my-text-color1 my-flex">
                            <div class="my-flex-1">观看量:<?=$video->nums?></div>
                            <div class="my-flex-1">价格:¥<?=$video->price?></div>
                            <div class="my-flex-1">时长:<?=$video->vlen?>分</div>
                        </div>
                        <div>
                        <div class="bshare-custom icon-medium"><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
                        </div>
                        <p><?=$video->summary?></p>
                    </div>
                    <div>
                        <div class="media">
                            <h5><span class="label label-default">演讲者</span></h5>
                            <div class="video_orator">
                                <?=$video->orator?>
                            </div>
                        </div>
                        <div class="media dashed-line-top">
                            <h5><span class="label label-default">演讲内容</span></h5>
                            <div class="video_content">
                                <?=$video->content?>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <h5>
                            <div class="row ml0">
                                <?=$category->name?>
                                <div class="col-md-10 col-sm-10 p0 ml10" style="display: flex;flex-flow:column nowrap;justify-content:center;align-items:center;align-content:center">
                                    <div class="dashed-line"></div>
                                    <div class="dashed-line"></div>
                                    <div class="dashed-line"></div>
                                </div>
                            </div>
                        </h5>
                        <div class="row my-flex">
                            <?php 
                                if($categoryvideos){
                                    foreach ($categoryvideos as $video) {
                             ?>
                                 <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail mb0">
                                        <?=$this->render('../common/video.php',['video'=>$video]);?>
                                    </div>
                                    <div class="my-text-color1 my-flex">
                                        <small>观看量:<?=$video->nums?></small>
                                        <small>价格:¥<?=$video->price?></small>
                                        <small>时长:<?=$video->vlen?>分</small>
                                    </div>
                                    <div class="caption">
                                        <h6>
                                        <a href="<?=Url::to(['video/index','id'=>$video->id])?>"><?=$video->title?></a>
                                        </h6>
                                        <p><?=$video->summary?></p>
                                    </div>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div>
                        <div class="media">
                            <h5><span class="label label-default my-label-default">版权声明</span></h5>
                            <address>
                                <strong>如因作品内容、版权和其他问题需要同66律师网联系的，请按以下联系方式与我们联络</strong><br>
                                联系人: 张XX<br>
                                电话:+8621-88880000<br>
                                传真:+8621-88880000<br>
                                电邮:XXXXXXXXXX@163.com<br>
                            </address>

                        </div>
                    </div>


                </div>


                <div class="col-sm-4 col-md-4 col-lg-4 my-ol">
                    <div id="myAffix" >
                    <?php 
                        if($categoryvideos){
                            $fvideo=$categoryvideos[0];
                            $svideo=isset($categoryvideos[1])?$categoryvideos[1]:false;
                            $tvideo=isset($categoryvideos[2])?$categoryvideos[2]:false;
                        ?>
                        <div class="my-ol-header">相关视频</div>
                        <div class="thumbnail">
                            <div class="thumbnail mb0">
                                <?=$this->render('../common/video.php',['video'=>$fvideo]);?>
                            </div>
                            <div class="my-text-color1 my-flex">
                                <div class="my-flex-1">观看量:<?=$fvideo->nums?></div>
                                <div class="my-flex-1">价格:¥<?=$fvideo->price?></div>
                                <div class="my-flex-1">时长:<?=$fvideo->vlen?>分</div>
                            </div>
                        </div>
                        <ul class="media-list">
                            <?php if($svideo){?>
                            <li class="media">
                                <div class="media-body media-middle my-media">
                                    <a href="<?=Url::to(['video/index','id'=>$svideo->id]) ?>"><?=$svideo->title?></a>
                                </div>
                            </li>
                            <?php } ?>
                            <?php if($tvideo){?>
                            <li class="media">
                                <div class="media-body media-middle my-media">
                                    <a href="<?=Url::to(['video/index','id'=>$tvideo->id]) ?>"><?=$tvideo->title?></a>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                        <?=$this->render('../common/hot.php');?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>