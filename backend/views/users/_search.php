<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$query=\Yii::$app->request->get("serach");
?>
<div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>搜索</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <form role="form" class="form-inline" method="get">
                <div class="form-group">
                    <label for="search-uuid" class="sr-only">登录名</label>
                    <input type="text" placeholder="登录名" id="search-uuid"
                           class="form-control" name="serach[email]" value="<?=@$query['email']?>">
                </div>
                <div class="form-group">
                    <label for="search-nickname" class="sr-only">公司名称</label>
                    <input type="text" placeholder="公司名称" id="search-nickname"
                           class="form-control" name="serach[name]" value="<?=$query['name']?>">
                </div>
                <div class="form-group">
                    <label for="search-nickname" class="sr-only">到期时间</label>
                    <input type="text" placeholder="到期时间" id="search-nickname"
                           class="form-control date" name="serach[last_date]" value="<?=$query['last_date']?>">
                </div>
                <div class="form-group">
                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                </div>
            </form>
        </div>
</div>
<script src="<?= Yii::$app->getHomeUrl() ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $(function () {
    $('.date').datepicker({
      todayBtn: 'linked',
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
  })
</script>