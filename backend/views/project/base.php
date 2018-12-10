<?php
use yii\helpers\Html;
$this->title = '项目新增';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本设置</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=@$data->id?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-10">
                                <input id="title" type="text" placeholder="" name="postdata[title]" class="form-control" required="" value="<?=@$data->title?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">主办方</label>
                            <div class="col-sm-10">
                                <input id="zbf_name" type="text" placeholder="" name="postdata[zbf_name]" class="form-control" required="" value="<?=@$data->zbf_name?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">主办方联系人</label>
                            <div class="col-sm-10">
                                <input id="zbf_linker" type="text" placeholder="" name="postdata[zbf_linker]" class="form-control" required=""  value="<?=@$data->zbf_linker?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">主办方联系人邮箱</label>
                            <div class="col-sm-10">
                                <input id="zbf_email" type="text" placeholder="" name="postdata[zbf_email]" class="form-control" required="" value="<?=@$data->zbf_email?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">主办方联系人电话</label>
                            <div class="col-sm-10">
                                <input id="zbf_tel" type="text" placeholder="" name="postdata[zbf_tel]" class="form-control" required="" value="<?=@$data->zbf_tel?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">阅读量</label>
                            <div class="col-sm-10">
                                <input id="vnum" type="text" placeholder="" name="postdata[vnum]" class="form-control"  value="<?=@$data->vnum?>">
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