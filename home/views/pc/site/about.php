<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\utils\CommUtil;

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

	        <div class="row flex-layout">

	            <div class="myleft" id="left">
                    <?=$data?> 
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
