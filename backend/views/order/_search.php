<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$query=\Yii::$app->request->get("serach");
?>
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
                    <label for="search-uuid" class="sr-only">订单号</label>
                    <input type="text" placeholder="订单号" id="search-uuid"
                           class="form-control" name="serach[order_no]" value="<?=$query['order_no']?>">
                </div>
                <div class="form-group">
                    <label for="search-order_no" class="sr-only">支付中心订单号</label>
                    <input type="text" placeholder="支付中心订单号" id="search-order_no"
                           class="form-control" name="serach[payment_order_no]" value="<?=$query['payment_order_no']?>">
                </div>
                
                <div class="form-group">
                    <select class="form-control" name="serach[status]">
                        <option value="">--订单状态--</option>
                        <option value="1" <?php if($query['status']==1){?>selected="selected"<?php }?>>待支付</option>
                        <option value="2" <?php if($query['status']==2){?>selected="selected"<?php }?>>支付成功</option>
                        <option value="3" <?php if($query['status']==3){?>selected="selected"<?php }?>>支付失败</option>
                    </select>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                </div>
            </form>
        </div>
</div>