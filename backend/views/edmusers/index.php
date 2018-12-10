<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '用户列表';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>用户列表</h5>
                    <div class="ibox-tools">
                        <?= Html::a('新增', ['create'], ['class' => 'btn btn-xs  btn-outline','style'=>'color:#000']) ?>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>搜索</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" class="form-inline" method="get">
                                <input type="hidden" name="mt" id="mt" value="search">
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
                                        <select class="form-control" name="status">
                                            <option value="">--状态--</option>
                                            <option value="1" <?php if(@$query['status']==1){?>selected="selected"<?php }?>>待验证</option>
                                            <option value="2" <?php if(@$query['status']==2){?>selected="selected"<?php }?>>可用</option>
                                            <option value="3" <?php if(@$query['status']==3){?>selected="selected"<?php }?>>停用</option>
                                            <option value="4" <?php if(@$query['status']==4){?>selected="selected"<?php }?>>废弃</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <input type="form-control" name="keywords" placeholder="输入邮箱" value="<?=@$query['keywords']?>">
                                </div>
                                <div class="form-group">
                                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary','onclick'=>"return setMt('search')"]) ?>
                                    <?= Html::submitButton('导出CSV', ['class' => 'btn btn-primary','onclick'=>"return setMt('export')"]) ?>
                                </div>
                            </form>
                        </div>
                        <div class="ibox-content">
                            <form role="form" class="form-inline" method="post" enctype="multipart/form-data" action="<?=Yii::$app->getRequest()->getBaseUrl()."/edmusers/importdata" ?>">
                                <div class="form-group">
                                    <input type="file" name="importdata">
                                </div>
                                <div class="form-group">
                                    <?= Html::submitButton('导入', ['class' => 'btn btn-primary']) ?>
                                    <?= Html::Button('清空', ['class' => 'btn btn-primary','onclick'=>"emptydata('". Yii::$app->getRequest()->getBaseUrl()."/edmusers/emptydata"."')"]) ?>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>分组</th>
                            <th>名称</th>
                            <th>邮箱</th>
                            <th>发送数量</th>
                            <th>成功数量</th>
                            <th>失败数量</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($data){
                            foreach ($data as $key => $value) {
                        ?>
                        <tr class="gradeX">
                            <td><?=$value['id']?></td>
                            <td><?=@$value['category_name']?></td>
                            <td><?=@$value['name']?></td>
                            <td><?=@$value['email']?></td>
                            <td><?=$value['send_num']?></td>
                            <td><?=$value['send_s_num']?></td>
                            <td><?=$value['send_f_num']?></td>
                            <td><?=$value['status_name']?></td>
                            <td><?=$value['created']?></td>
                            <td class="center">
                                <?= Html::a('编辑', ['update','id'=>$value['id']], ['class' => 'btn btn-xs  btn-outline']) ?>
                                <?= Html::a('删除', ['delete','id'=>$value['id']], ['class' => 'btn btn-xs  btn-outline','onclick'=>'return del_confirm()']) ?>
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
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">校验用户</h4>
            </div>
            <div class="modal-body">正在校验中...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script type="text/javascript">
//var check_url="http://localhost/datagame/mailgun/validate.php";
var check_url="http://mailgun.72-web.com/validate.php";
    function emptydata(urlstr){
        if(confirm("确认清空用户!")){
            location.href=urlstr;
        }
    }

    $(function(){
        $(".checkmail").click(function(){
            $.get(check_url,function(msg){
                //alert("校验完成");
                location.reload();
            });
        });
    });

    function setMt($mt){
        $("#mt").val($mt);
    }

</script>