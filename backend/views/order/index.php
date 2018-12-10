<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '订单列表';
?>
<link href="<?=Yii::$app->getHomeUrl()?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?=Yii::$app->getHomeUrl()?>css/plugins/select2/select2.min.css" rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>订单列表</h5>
                </div>
                <?=$this->render('_search.php');?>
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>

                            <th>用户邮箱</th>
                            <th>订单号</th>
                            <th>支付中心订单号</th>
                            <th>渠道</th>
                            <th>渠道订单号</th>
                            <th>支付金额</th>
                            <th>支付产品</th>
                            <th>支付完成时间</th>
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
                            <td><?=$value->user->email?></td>
                            <td><?=$value->order_no?></td>
                            <td><?=$value->payment_order_no?></td>

                            <td><?=$value->pay_channel?></td>
                            <td><?=$value->pay_channel_no?></td>
                            <td><?=$value->pay_money?></td>
                            <td><?=$value->product?></td>
                            <td><?=$value->pay_date?></td>
                            <td><?=$value->getStatus()?></td>
                            <td><?=$value->created?></td>
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
<!-- iCheck -->
    <script src="<?=Yii::$app->getHomeUrl()?>js/plugins/iCheck/icheck.min.js"></script>
    <script src="<?=Yii::$app->getHomeUrl()?>js/plugins/select2/select2.full.min.js"></script>

 <script>
    $(document).ready(function(){
        $(".chosen-select").select2();
    });
</script>