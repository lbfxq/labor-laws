<?php
use yii\helpers\Html;
$this->title = '编辑会员';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑会员</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">登录名</label>
                            <div class="col-lg-10">
                               <input type="text" placeholder="登录名"  class="form-control" required="" value="<?=$model->email?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-10">
                                <input id="pwd" type="password" placeholder="新密码" name="postdata[pwd]" class="form-control" >
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">公司名称</label>
                            <div class="col-lg-10"><input id="name" type="text" placeholder="昵称" name="postdata[name]" class="form-control" required="" value="<?=$model->name?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">到期时间</label>
                            <div class="col-lg-10"><input id="last_date" type="text" placeholder="到期时间" name="postdata[last_date]" class="form-control date" required="" value="<?=$model->last_date?>"></div>
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
<script src="<?= Yii::$app->getHomeUrl() ?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $(function () {
    $('.date').datepicker({
      todayBtn: 'linked',
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
  })
</script>