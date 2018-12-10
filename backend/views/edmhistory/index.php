<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '邮件任务列表';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>邮件任务列表</h5>
                    <div class="ibox-tools">
                        <?= Html::a('新增任务', ['create'], ['class' => 'btn btn-xs  btn-outline']) ?>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <form role="form" class="form-inline" method="get">
                                <div class="form-group">
                                    <select class="form-control" name="category_id">
                                        <option value="">--选择用户分组--</option>
                                        <?php
                                        if($category){
                                            foreach ($category as $value) {
                                        ?>
                                        <option value="<?=$value->id?>" <?php if(@$query['category_id']==$value->id){?>selected="selected"<?php }?>><?=$value->name?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="mail_id">
                                        <option value="">--选择邮件--</option>
                                        <?php
                                        if($mails){
                                            foreach ($mails as $value) {
                                        ?>
                                        <option value="<?=$value->id?>" <?php if(@$query['mail_id']==$value->id){?>selected="selected"<?php }?>><?=$value->subject?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="">--状态--</option>
                                            <option value="1" <?php if(@$query['status']==1){?>selected="selected"<?php }?>>待发送</option>
                                            <option value="2" <?php if(@$query['status']==2){?>selected="selected"<?php }?>>已发送</option>
                                            <option value="3" <?php if(@$query['status']==3){?>selected="selected"<?php }?>>发送失败</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </form>
                        </div>
                </div>

                <div class="ibox-title">
                    <div class="ibox-tools">
                        <label id="unsend_num"><?=$unsendnum?></label>个待发送任务
                        <!-- <?= Html::button('发送',['id'=>"sendmail"]) ?> -->
                    </div>
                </div>
                
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>发送邮箱</th>
                            <th>接收邮箱</th>
                            <th>更新时间</th>
                            <th>MAILGUN状态</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($data){
                            foreach ($data as $key => $value) {
                        ?>
                        <tr class="gradeX">
                            <td><?=$value->id?></td>
                            <td><?=$value->subject?></td>
                            <td><?=htmlspecialchars($value->email_from)?></td>
                            <td><?=$value->email_to?></td>
                            <td><?=$value->updated?></td>
                            <td><?=$value->message_status?></td>
                            <td><?=$value->getStatus()?></td>
                            <td class="center">
                                <?= Html::a('删除', ['delete','id'=>$value->id], ['class' => 'btn btn-xs  btn-outline','onclick'=>'return del_confirm()']) ?>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                        </table>
                        <div class="dataTables_paginate paging_simple_numbers">
                        <?php
                            echo \yii\widgets\LinkPager::widget(array(
                                'pagination' => $pages,
                                'firstPageLabel' => '首页',
                                'lastPageLabel' => '尾页',
                                'maxButtonCount' => 5,
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
//var sendmail_url="http://localhost/datagame/mailgun/index.php";
var sendmail_url="http://mailgun.72-web.com/index.php";
var sendflag=false;
$(function(){
    $("#sendmail").click(function(){
        if(!sendflag){
            send();
        }else{
            zt();
        }
        
    });
});

function sendMail(){
    var unsend_num = $("#unsend_num").text();
    unsend_num= parseInt(unsend_num);
    if(!isNaN(unsend_num) && unsend_num >0 ){
        $.get(sendmail_url,function(msg){
            if(msg=="success"){
                unsend_num=unsend_num-1;
                $("#unsend_num").text(unsend_num);
            }
            if(unsend_num >0){
                if(sendflag){
                    setTimeout("sendMail()", 500);
                }
            }else{
                zt();
                alert("发送完毕");
            }
        });
    }else{
        zt();
        alert("发送完毕");
    }
}

function send(){
    sendflag=true;
    $("#sendmail").text("暂停");
    sendMail();
}
function zt(){
    sendflag=false;
    $("#sendmail").text("发送");
    //location.reload();
}
</script>