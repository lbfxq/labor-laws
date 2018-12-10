<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '分类列表';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分类列表</h5>
                    <div class="ibox-tools">
                        <?= Html::a('新增', ['create'], ['class' => 'btn btn-xs  btn-outline']) ?>
                    </div>
                </div>
                <div class="ibox-content">
                   <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php echo $lists ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>