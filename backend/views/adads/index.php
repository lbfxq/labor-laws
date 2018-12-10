<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '广告位列表';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>广告位列表</h5>
                    <div class="ibox-tools">
                        <?= Html::a('新增', ['create'], ['class' => 'btn btn-xs  btn-outline']) ?>
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
                                <div class="form-group">
                                    <select class="form-control" name="position_id">
                                        <option value="">--选择广告位--</option>
                                        <?php
                                        if($position){
                                            foreach ($position as $value) {
                                        ?>
                                        <option value="<?=$value->id?>" <?php if(@$query['position_id']==$value->id){?>selected="selected"<?php }?>><?=$value->name?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="">--状态--</option>
                                            <option value="1" <?php if(@$query['status']==1){?>selected="selected"<?php }?>>禁用</option>
                                            <option value="2" <?php if(@$query['status']==2){?>selected="selected"<?php }?>>启用</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>广告位置</th>
                            <th>图片</th>
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
                            <td><?=$value->id?></td>
                            <td><?=@$value->position->name?></td>
                            <td><img src="<?=@$value->vimg?>" width="100" ></td>
                            <td><?=$value->getStatus()?></td>
                            <td><?=$value->created?></td>
                            <td class="center">
                                <?= Html::a('编辑', ['update','id'=>$value->id], ['class' => 'btn btn-xs  btn-outline']) ?>
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