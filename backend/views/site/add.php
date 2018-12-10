<link href="<?=Yii::$app->getHomeUrl()?>css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>创建账号</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= Yii::$app->urlManager->createUrl('user/index') ?>">账号管理</a>
            </li>
            <li class="active">
                <a>创建账号</a>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>创建账号</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">用户名</label>
                            <div class="col-lg-10"><input id="username" type="text" placeholder="用户名" name="username" class="form-control" required=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">真实姓名</label>
                            <div class="col-lg-10"><input id="realname" type="text" placeholder="真实姓名" name="realname" class="form-control" required=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">登录密码</label>
                            <div class="col-sm-10"><input id="password" type="password" placeholder="登录密码" class="form-control required" name="password" required=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">再次输入</label>
                            <div class="col-sm-10"><input id="confirm" type="password" placeholder="再次输入" class="form-control required" name="confirm" required=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">状态</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="account">
                                    <option value="1">启用</option>
                                    <option value="0">禁用</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="cancel">取 消</button>&nbsp;&nbsp;
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="submit" data-style="zoom-in">提 交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/validate/messages_zh.js"></script>
<!-- Ladda -->
<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/ladda/spin.min.js"></script>
<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/ladda/ladda.min.js"></script>
<script src="<?=Yii::$app->getHomeUrl()?>js/plugins/ladda/ladda.jquery.min.js"></script>
<script>
    var l = $( '.ladda-button-demo' ).ladda();
    function ajax_submit(){
        l.ladda( 'start' );
        $.ajax({
            type: "POST",
            url: "<?= Yii::$app->urlManager->createUrl('user/add')?>",
            data: $('#form').serialize(),
            success: function(msg){console.log(msg.status)
                if(msg.status == 200){

                }else if(msg.status == 201){
                    if($('#username-error').length){
                        $('#username-error').html('这个用户名已经被使用了').show();
                    }else{
                        $('#username').before('<label id="username-error" class="error" for="username">这个用户名已经被使用了</label>');
                    }
                    $('#username').removeClass('valid').addClass('error');
                }else{
                    toastr.error('操作失败','',{positionClass: "toast-top-center"});
                }
                l.ladda( 'stop' );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.status,'页面错误',{positionClass: "toast-top-center"})
                l.ladda( 'stop' );
            },
            dataType: 'json'
        });
        return false;
    }
    $(document).ready(function() {
        $("#form").validate({
            errorPlacement: function (error, element) {
                element.before(error);
            },
            rules: {
                password: {
                    required:true,
                    minlength:6
                },
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        l.click(function(){
            if($('#form').valid()){
                ajax_submit();
            }
            return false;
        });
    });
</script>