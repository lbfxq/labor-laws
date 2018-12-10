<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="tab-content">
    <div class="container mb10">
	    <div class="alert alert-danger" style="margin-top:100px;">
	       错误信息: <?= nl2br(Html::encode($message)) ?>
	    </div>
	</div>
</div>
