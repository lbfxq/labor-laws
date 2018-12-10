<?php
use yii\helpers\Html;
$this->title = '用户新增';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>用户新增</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">用户分组</label>
                            <div class="col-sm-10">
                                 <?php
                                    if($category){
                                        foreach ($category as $value) {
                                    ?>
                                    <label><input type="checkbox" name="postdata[categorys][]" value="<?=$value->id?>"> <?=$value->name?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                   <?php
                                        }
                                    }
                                    ?> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" placeholder="名称" name="postdata[name]" class="form-control" required="">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                <input id="email" type="text" placeholder="email" name="postdata[email]" class="form-control" required="">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">状态</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="postdata[status]">
                                    <option value="1">待验证</option>
                                    <option value="2">可用</option>
                                    <option value="3">停用</option>
                                    <option value="4">废弃</option>
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