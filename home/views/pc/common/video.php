<?php
use yii\helpers\Url;
use app\services\CommonServices;
use app\services\UserServices;
$loginuser=UserServices::getLoginInfo();

if($loginuser){
	$videoid=isset($video->id)?$video:0;
	$payflag =CommonServices::checkVideo($loginuser['id'],$videoid);
	if($payflag){
		echo $video->video_link;
	}else{
	?>
	<a class="pay_require" data-vid="<?=$video->id?>">
		<img src="<?=$video->vimg?>" alt="<?=$video->title?>">
	</a>
	<?php
	}
}else{
?>
<a class="login_require">
	<img src="<?=$video->vimg?>" alt="<?=$video->title?>">
</a>
<?php
}
?>