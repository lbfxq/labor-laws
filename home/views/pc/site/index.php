<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\utils\CommUtil;

$assets_url=Yii::$app->params['assets'];
$predata=array_slice($recommend,0,3);
$afdata=array_slice($recommend,3);

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

	            <div class="myleft">
	            	<?php
	            	if($predata){
	            		$first=$predata[0];
	            	?>
                    <div class="row no-border">
                        <div class="col-sm-7 col-md-7 col-lg-7 mb0 recommd-left">
                            <a href="<?=Url::to(['article/index','id'=>$first->id]) ?>">
                                <img src="<?=$first->vimg?>" alt="<?=$first->title?>">
                            </a>
                            <div>
                               <h4><a href="<?=Url::to(['article/index','id'=>$first->id]) ?>"><?=$first->title?></a></h4>
                                <p><?=$first->summary?></p>
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-5 col-lg-5 starea">
                            <?php $second=@$predata[1];if($second){?>
                                <div>
                                    <a href="<?=Url::to(['article/index','id'=>$second->id]) ?>" title="<?=$second->title?>" class="fbword"><?=CommUtil::showSubStr($second->title,22)?></a>
                                    <div class="layout-word">
                                        <div class="layout-word-text">
                                            <a href="<?=Url::to(['article/index','id'=>$second->id]) ?>"><img src="<?=$second->vimg?>" class="layout-word-img"></a>
                                            <?=CommUtil::showSubStr($second->summary,60)?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php $third=@$predata[2];if($third){?>
                                <div class="subrecrow">
                                    <a href="<?=Url::to(['article/index','id'=>$third->id]) ?>" title="<?=$third->title?>" class="fbword"><?=CommUtil::showSubStr($third->title,22)?></a>
                                    <div class="layout-word">
                                        <div class="layout-word-text">
                                            <a href="<?=Url::to(['article/index','id'=>$third->id]) ?>"><img src="<?=$third->vimg?>" class="layout-word-img"></a>
                                            <?=CommUtil::showSubStr($third->summary,60)?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
	                


	                <?php } ?>

	                <div class="media">
                        <div class="listtitle">
                                编辑推荐
                            <div class="line3">
                                <div class="dashed-line"></div>
                                <div class="dashed-line"></div>
                                <div class="dashed-line"></div>
                            </div>
                        </div>
	                    <div class="row my-flex">
	                    	<?php
		                    if($afdata){
		                    	foreach ($afdata as $key => $value) {
		                    ?>
	                        <div class="col-sm-6 col-md-4 dashed-line-top-item">
	                            <div class="thumbnail mb0">
				            		<a href="<?=Url::to(['article/index','id'=>$value->id]) ?>">
										<img src="<?=$value->vimg?>" alt="<?=$value->title?>">
									</a>
				            	</div>
	                            <div class="caption">
	                                <h6><a href="<?=Url::to(['article/index','id'=>$value->id]) ?>" class="fbword"><?=$value->title?></a></h6>
	                                <p><?=$value->summary?></p>
	                            </div>
	                        </div>
	                        <?php }}?>
	                    </div>
	                </div>
	                <?php
	                if($catedata){
	                	foreach ($catedata as $key => $value) {
	                ?>
                            <div class="media">
                                <div class="listtitle">
                                    <?=$value['name']?>
                                    <div class="line3">
                                        <div class="dashed-line"></div>
                                        <div class="dashed-line"></div>
                                        <div class="dashed-line"></div>
                                    </div>
                                </div>
                                <div class="row my-flex">
                                    <?php
                                    foreach ($value['articles'] as $item) {
                                        ?>
                                        <div class="col-sm-6 col-md-4 dashed-line-top-item">
                                            <div class="thumbnail mb0">
                                                <a>
													<img src="<?=$item->vimg?>" alt="<?=$item->title?>">
												</a>
                                            </div>

                                            <div class="caption">
                                                <h6><a href="<?=Url::to(['article/index','id'=>$item->id]) ?>" class="fbword"><?=$item->title?></a></h6>
                                                <p><?=$item->summary?></p>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
	                <?php
	                	}
	                }
	                ?>

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
