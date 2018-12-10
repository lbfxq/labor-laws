<?php
use yii\helpers\Html;
$this->title = '广告位新增';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>广告位新增</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">标识</label>
                            <div class="col-lg-10">
                               <input disabled="disabled" type="text" placeholder="标识"  class="form-control" value="<?=$model->code?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" placeholder="名称" name="postdata[name]" class="form-control" required="" value="<?=$model->name?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">状态</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="postdata[status]">
                                    <option value="0" <?php if ($model->status ==0){?> selected="selected"<?php }?> >禁用</option>
                                    <option value="1" <?php if ($model->status ==1){?> selected="selected"<?php }?> >启用</option>
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