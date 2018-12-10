<?php
use yii\helpers\Html;
use yii\helpers\Url;
$assets_url=Yii::$app->params['assets'];
?>
<div class="tab-content">
    <div class="container mb10">
        <div class="container-fluid">
            <!-- flex -->
            <div class="row ">
                <div class="col-sm-8 col-md-7 col-lg-8">
                    <div>
                        <form method="post" action="<?=Url::to(['order/topay']) ?>">
                        <input type="hidden" name="vid" value="<?=$video->id?>">
                        <div class="media">
                            <h5><span class="label label-default">视频信息</span></h5>
                            <div class="video_orator">
                                <?=$video->title?>
                            </div>
                        </div>
                        <div class="media">
                            <h5><span class="label label-default">支付选择</span></h5>
                            <div class="video_content">
                                <?php 
                                    if($channels){
                                        foreach ($channels as $channel) {
                                ?>
                                    <label><input type="radio" name="channel" checked="checked" value="<?=$channel->id?>-<?=$channel->name?>"> <?=$channel->name?></label>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <p><input type="submit" value="购买"></p>
                        </form>
                    </div>
                </div>


                <div class="col-sm-4 col-md-4 col-lg-4 my-ol">
                    <div class="affix" data-spy="affix" data-offset-top="120">
                        <?=$this->render('../common/hot.php');?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>