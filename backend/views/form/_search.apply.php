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
            <form role="form" class="form-inline" method="get" id="searchform">
                <input type="hidden" name="doflag" id="doflag" value="search">
                <div class="form-group">
                    <label for="search-uuid" class="sr-only">电话</label>
                    <input type="text" placeholder="电话" id="search-uuid"
                           class="form-control" name="serach[tel]" value="<?=@$query['tel']?>">
                </div>
                <div class="form-group">
                    <label for="search-nickname" class="sr-only">公司名称</label>
                    <input type="text" placeholder="公司名称" id="search-nickname"
                           class="form-control" name="serach[company]" value="<?=$query['company']?>">
                </div>
                <div class="form-group">
                    <input type="button" name="search" value="搜索" class="btn btn-primary" onclick="searchBtn()" />
                    <input type="button" name="export" value="导出CSV" class="btn btn-primary"  onclick="exportBtn()" />
                </div>
            </form>
        </div>
</div>
<script type="text/javascript">
    function searchBtn(){
        $("#doflag").val("search");
        $("#searchform").submit();
    }
    function exportBtn(){
        $("#doflag").val("export");
        $("#searchform").submit();
    }
</script>