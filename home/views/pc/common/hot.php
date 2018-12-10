<?php
use yii\helpers\Url;
use app\services\CommonServices;
$category_id=isset($category_id)?intval($category_id):0;
$limit=isset($limit)?intval($limit):10;
$hotvideos=CommonServices::getHotArticles($category_id,$limit);
?>
<div>
    <div class="my-ol-header">热门文章</div>
    <ol class="listdata">
        <?php 
        if($hotvideos){
            foreach ($hotvideos as $key => $value) {
        ?>
        <li><a href="<?=Url::to(['article/index','id'=>$value->id]) ?>"><span><?=$value->title?></span></a></li>
        <?php }}?>
    </ol>
</div>