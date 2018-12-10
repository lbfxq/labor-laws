<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '视屏列表';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视屏列表</h5>
                    <div class="ibox-tools">
                        <?= Html::a('新增', ['create'], ['class' => 'btn btn-xs  btn-outline']) ?>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <form role="form" class="form-inline" method="get">
                                <div class="form-group">
                                    <select class="form-control" name="category_id">
                                        <option value="">--选择用户分组--</option>
                                        <?=$categorys?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="">--状态--</option>
                                            <option value="1" <?php if(@$query['status']==1){?>selected="selected"<?php }?>>可用</option>
                                            <option value="2" <?php if(@$query['status']==2){?>selected="selected"<?php }?>>停用</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <select class="form-control" name="is_recommand">
                                            <option value="">--推荐--</option>
                                            <option value="1" <?php if(@$query['is_recommand']==1){?>selected="selected"<?php }?>>否</option>
                                            <option value="2" <?php if(@$query['is_recommand']==2){?>selected="selected"<?php }?>>是</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <select class="form-control" name="is_hot">
                                            <option value="">--热门--</option>
                                            <option value="1" <?php if(@$query['is_hot']==1){?>selected="selected"<?php }?>>否</option>
                                            <option value="2" <?php if(@$query['is_hot']==2){?>selected="selected"<?php }?>>是</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                   <input type="form-control" name="keywords" placeholder="关键字" value="<?=@$query['keywords']?>">
                                </div>
                                <div class="form-group">
                                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </form>
                        </div>
                </div>
                </div>
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>分类</th>
                            <th>推荐</th>
                            <th>热门</th>
                            <th>时长/分钟</th>
                            <th>价格/元</th>
                            <th>状态</th>
                            <th align="center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($data){
                            foreach ($data as $key => $value) {
                        ?>
                        <tr class="gradeX">
                            <td><?=$value->title?></td>
                            <td><?=$value->category->name?></td>
                            <td><?php if($value->is_recommand==2){echo "<span style='color:#f00'>是</span>";}else{echo "否";}?></td>
                            <td><?php if($value->is_hot==2){echo "<span style='color:#f00'>是</span>";}else{echo "否";}?></td>
                            <td><?=$value->vlen?></td>
                            <td><?=$value->price?></td>
                            <td><?=$value->getStatus()?></td>
                            <td class="center">
                                <?= Html::a('编辑', ['update','id'=>$value->id], ['class' => 'btn btn-xs  btn-outline']) ?>
                                <?= Html::a('删除', ['delete','id'=>$value->id], ['class' => 'btn btn-xs  btn-outline','onclick'=>'return del_confirm()']) ?>

                                <?= Html::a($value->is_hot==1?'热门':'取消热门', ['hr','id'=>$value->id,'k'=>'is_hot','v'=>$value->is_hot==1?2:1], ['class' => 'btn btn-xs  btn-outline']) ?>
                                <?= Html::a($value->is_recommand==1?'推荐':'取消推荐', ['hr','id'=>$value->id,'k'=>'is_recommand','v'=>$value->is_recommand==1?2:1], ['class' => 'btn btn-xs  btn-outline']) ?>
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