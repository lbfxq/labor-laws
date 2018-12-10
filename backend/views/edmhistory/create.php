<?php
use yii\helpers\Html;
$this->title = '任务新增';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>任务新增</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">用户分组</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="postdata[category_id]">
                                    <option value="">--所有分组--</option>
                                    <?php
                                    if($category){
                                        foreach ($category as $value) {
                                    ?>
                                    <option value="<?=$value->id?>"><?=$value->name?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">发送邮件</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="postdata[mail_id]">
                                    <option value="">--选择邮件--</option>
                                    <?php
                                    if($mails){
                                        foreach ($mails as $value) {
                                    ?>
                                    <option value="<?=$value->id?>"><?=$value->subject?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="submit" data-style="zoom-in">保 存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>