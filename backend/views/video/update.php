<?php
use yii\helpers\Html;
$this->title = '视屏新增';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视屏新增</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-10">
                                <input id="title" type="text" placeholder="标题" name="postdata[title]" class="form-control" required="" value="<?=$model->title?>">
                            </div>
                        </div>
                         <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">分类</label>
                            <div class="col-sm-10">
                                <select name="postdata[category_id]" id="category_id" class="form-control">
                                    <option value="0">请选择分类</option>
                                    <?php echo $categorys;?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-10">
                                <input id="summary" type="text" placeholder="简介" name="postdata[summary]" class="form-control" required="" maxlength="40"  value="<?=$model->summary?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">主图</label>
                            <div class="col-sm-10">
                                <input type="file" name="imgs">
                                <p><img src="<?=$model->vimg?>"  width="100"></p>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">视屏内容</label>
                            <div class="col-sm-10">
                               <textarea name="postdata[video_link]" id="video_link"  style="width:100%;height:200px;"><?=$model->video_link?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">演讲者</label>
                            <div class="col-sm-10">
                                <textarea name="postdata[orator]" id="orator"  style="width:100%;height:300px;"><?=$model->orator?></textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">演讲内容</label>
                            <div class="col-sm-10">
                                <textarea name="postdata[content]" id="content"  style="width:100%;height:300px;"><?=$model->content?></textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">价格(单位：元)</label>
                            <div class="col-sm-10">
                                <input id="price" type="text" placeholder="价格" name="postdata[price]" class="form-control" required="" maxlength="40" value="<?=$model->price?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">时长(单位：分钟)</label>
                            <div class="col-sm-10">
                                <input id="vlen" type="text" placeholder="时长" name="postdata[vlen]" class="form-control" required="" maxlength="40" value="<?=$model->vlen?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">状态</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="postdata[status]">
                                    <option value="1" <?php if ($model->status ==1){?> selected="selected"<?php }?> >启用</option>
                                    <option value="2" <?php if ($model->status ==2){?> selected="selected"<?php }?> >禁用</option>
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
<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?=Yii::$app->getHomeUrl()?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
    CKEDITOR.replace( 'postdata[content]' );
    CKEDITOR.replace( 'postdata[orator]' );
    $('.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
});
</script>