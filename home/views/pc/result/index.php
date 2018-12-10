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
                        
                        <div class="media">
                            <h5><span class="label label-default">支付结果</span></h5>
                            <div class="video_orator">
                               支付成功
                            </div>
                        </div>
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