
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>账号管理</h2>
    </div>
</div> -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>所有管理员账号</h5>
                    <div class="ibox-tools">
                        <a href="<?= Yii::$app->urlManager->createUrl('user/add')?>" class="btn btn-info"><i class="fa fa-plus-square"></i> 创建账号 </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table id="admins-table" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>用户名</th>
                            <th>真实姓名</th>
                            <th>状态</th>
                            <th width="200" style="text-align: center">操作</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 16px;">
                       
                        <tr>
                            <td style="vertical-align: middle">111</td>
                            <td style="vertical-align: middle">222</td>
                            <td style="vertical-align: middle">333</td>
                            <td style="vertical-align: middle">
                                &nbsp;<a href="javascript:void(0)" data-id="11" class="a-acitve"><i class="fa fa-check-circle"></i></a>
                            </td>
                            <td style="text-align: center">
                                <a href="<?= Yii::$app->urlManager->createUrl(['user/add','id'=>1])?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
                                <a href="<?= Yii::$app->urlManager->createUrl(['user/del','id'=>1])?>" class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i> 删除 </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">111</td>
                            <td style="vertical-align: middle">222</td>
                            <td style="vertical-align: middle">333</td>
                            <td style="vertical-align: middle">
                                &nbsp;<a href="javascript:void(0)" data-id="11" class="a-acitve"><i class="fa ban"></i></a>
                            </td>
                            <td style="text-align: center">
                                <a href="<?= Yii::$app->urlManager->createUrl(['user/add','id'=>1])?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
                                <a href="<?= Yii::$app->urlManager->createUrl(['user/del','id'=>1])?>" class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i> 删除 </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>