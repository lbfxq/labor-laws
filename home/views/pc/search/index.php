<?php
use yii\helpers\Url;

$assets_url = Yii::$app->params['assets'];
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

	                <div class="media">
	                    <h5>搜索关键字-<?=$keywords?></h5>
	                    <div class="row">
	                    	<?php
if ($datas) {
	foreach ($datas as $item) {
		?>
	                        <div class="col-sm-6 col-md-4">
	                            <div class="thumbnail mb0">
			            			<a href="<?=Url::to(['article/index', 'id' => $item->id])?>">
	                                    <img src="<?=$item->vimg?>" alt="<?=$item->title?>">
	                                </a>
			            		</div>


	                            <div class="caption">
	                                <h6><a href="<?=Url::to(['article/index', 'id' => $item->id])?>" class="fbword"><?=$item->title?></a></h6>
	                                <p><?=$item->summary?></p>
	                            </div>
	                        </div>
	                        <?php }}?>
	                    </div>

	                </div>

	                <nav aria-label="Page navigation" class="center">
                        <?php
echo \yii\widgets\LinkPager::widget(array(
	'pagination' => $pages,
	'firstPageLabel' => '首页',
	'lastPageLabel' => '尾页',
	'maxButtonCount' => 5,
));
?>
                        </nav>

	            </div>
                <div class="my-ol">
                    <div id="myAffix">
                        <?php if ($ads_rf) {?>
                            <a href="<?=$ads_rf->links?>" class="adright">
                                <img src="<?=$ads_rf->vimg?>" alt="" width="100%">
                            </a>
                        <?php }?>
                        <?=$this->render('../common/hot.php');?>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
</div>