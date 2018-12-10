<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$query=\Yii::$app->request->get("DataMemberSearch");
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
                    <label for="datamembersearch-username" class="sr-only">用户名</label>
                    <input type="text" placeholder="用户名" id="datamembersearch-username"
                           class="form-control" name="DataMemberSearch[username]" value="<?=$query['username']?>">
                </div>
                <div class="form-group">
                    <label for="DataMemberSearch-name" class="sr-only">昵称</label>
                    <input type="text" placeholder="昵称" id="DataMemberSearch-name"
                           class="form-control" name="DataMemberSearch[name]" value="<?=$query['name']?>">
                </div>
                <div class="form-group">
                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                </div>
            </form>
        </div>
</div>