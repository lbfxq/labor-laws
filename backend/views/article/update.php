<?php
use yii\helpers\Html;
$this->title = '文章编辑';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>文章编辑</h5>
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
                            <label class="col-sm-2 control-label">发布时间</label>
                            <div class="col-sm-10">
                                <input id="public_date" type="text" placeholder="" name="postdata[public_date]"
                                       class="form-control date" required="" maxlength="40" value="<?=$model->public_date?>">
                            </div>
                        </div>
                       <!--  <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-10">
                                <input id="summary" type="text" placeholder="简介" name="postdata[summary]" class="form-control" required="" maxlength="40"  value="<?=$model->summary?>">
                            </div>
                        </div> -->
                       <!--  <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">主图</label>
                            <div class="col-sm-10">
                                <p><img src="<?=$model->vimg?>" style="width: 200px"></p>
                                <p style="color:#f00;">建议上传470*280的图片</p>
                                <input type="file" id="imgs" name="imgs">
                                <div class="canvas-box"></div>

                                <div class="preview"></div>
                                <input type="hidden" name="postdata[vimg]" id="vimg" value="<?=$model->vimg?>">
                            </div>
                        </div> -->
                        <div class="hr-line-dashed"></div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea name="postdata[content]" id="content"  style="width:100%;height:300px;"><?=$model->content?></textarea>
                            </div>
                        </div>
                        <!-- <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">关键字</label>
                            <div class="col-sm-10">
                                <input id="keywords" type="text" placeholder="关键字,多个关键字用,隔开" name="postdata[keywords]" class="form-control" required="" value="<?=$model->keywords?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">描述</label>
                            <div class="col-sm-10">
                                <input id="des" type="text" placeholder="描述" name="postdata[des]" class="form-control" required="" value="<?=$model->des?>">
                            </div>
                        </div> -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">排序(数值越大越靠前)</label>
                            <div class="col-sm-10">
                                <input id="rank" type="text" placeholder="排序(数值越大越靠前)" name="postdata[rank]"
                                       class="form-control" value="<?=$model->rank?>" required="">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">免费</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="postdata[is_free]">
                                     <option value="1" <?php if ($model->is_free ==1){?> selected="selected"<?php }?> >否</option>
                                    <option value="2" <?php if ($model->is_free ==2){?> selected="selected"<?php }?> >是</option>
                                </select>
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
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="submit" data-style="zoom-in" id="save">保 存</button>
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
<script src="<?=Yii::$app->getHomeUrl()?>js/cutImage.js"></script>
<script type="text/javascript">
$(function(){
    //CKEDITOR.replace( 'postdata[content]' );

    CKEDITOR.replace( 'postdata[content]', {
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

    $('.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    function saveCallBack (base64) {
        $("#vimg").val(base64);
    }
    var u = window.u = new CutImage({
        el: $('.canvas-box'),
        fileInput: $('#imgs')[0],
        saveBtn: $('#save')[0],
        box_width: 300,  //剪裁容器的最大宽度
//        box_height: 300, //剪裁容器的最大高度
        min_width: 470,  //要剪裁图片的最小宽度
        min_height: 280  //要剪裁图片的最小高度
      }, saveCallBack);


});
</script>
