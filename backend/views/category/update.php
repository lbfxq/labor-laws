<?php
use yii\helpers\Html;
$this->title = '分类编辑';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分类编辑</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">父级分类</label>
                            <div class="col-sm-8">
                                <select name="postdata[parent_id]" id="parent_id" class="form-control">
                                    <option value="0">请选择父级分类</option>
                                    <?php echo $cdata;?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">名称</label>
                            <div class="col-sm-8">
                                <input id="name" type="text" placeholder="名称" name="postdata[name]" class="form-control" required="" value="<?=$model->name?>">
                            </div>
                        </div>
                        <!-- <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">关键字</label>
                            <div class="col-sm-8">
                                <input id="keywords" type="text" placeholder="关键字,多个关键字用,隔开" name="postdata[keywords]" class="form-control" required="" value="<?=$model->keywords?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">描述</label>
                            <div class="col-sm-8">
                                <input id="des" type="text" placeholder="描述" name="postdata[des]" class="form-control" required="" value="<?=$model->des?>">
                            </div>
                        </div> -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">排序(填写数字，越大越靠前)</label>
                            <div class="col-sm-8">
                                <input id="rank" type="text" placeholder="排序(填写数字，越大越靠前)" name="postdata[rank]" class="form-control" value="<?=$model->rank?>" required="">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-2">
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="submit" data-style="zoom-in">保 存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>