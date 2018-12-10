<?php
use yii\helpers\Html;
$this->title = '基本设置';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本设置</h5>
                </div>
                <div class="ibox-content">
                <form id="form" method="post" class="form-horizontal">
                <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>标识</th>
                            <th>名称</th>
                            <th>内容</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($data){
                            foreach ($data as $key => $value) {
                         ?>
                        <tr>
                            <td><?=$value->item_key?></td>
                            <td><?=$value->item_name?><input type="hidden" name="setting[<?=$key?>][id]" value="<?=$value->id?>"></td>
                            <td><textarea name="setting[<?=$key?>][item_value]"><?=$value->item_value?></textarea>
                        </tr>
                        <?php
                        }}
                        ?>
                        </tbody>
                    </table>
                    <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="submit" data-style="zoom-in">保 存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= Yii::$app->getHomeUrl() ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(function () {
    CKEDITOR.replace( 'setting[0][item_value]', {
            toolbar: [
                { name: 'document', items: [ 'Print' ] },
                { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
                { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                '/',
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'insert', items: [ 'Image', 'Table' ] },
                { name: 'tools', items: [ 'Maximize' ] }
            ],
    } );
  })
</script>
