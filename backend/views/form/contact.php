<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '咨询列表';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>咨询列表</h5>
                </div>
                <?=$this->render('_search.contact.php');?>
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>公司名称</th>
                            <th>姓名</th>
                            <th>邮箱</th>
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
                            <td><?=$value->company?></td>
                            <td><?=$value->username?></td>
                            <td><?=$value->email?></td>
                            <td><?=$value->created?></td>
                            <td class="center">
                                <?= Html::a('详细', ['contactview','id'=>$value->id], ['class' => 'btn btn-xs  btn-outline']) ?>
                                <?= Html::a('删除', ['contactdelete','id'=>$value->id], ['class' => 'btn btn-xs  btn-outline']) ?>
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