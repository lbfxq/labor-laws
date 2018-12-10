<div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="account">
                <table class="orders">
                    <thead>
                        <tr>
                            <th width="10%">订单号</th>
                            <th width="20%">商品名称</th>
                            <th width="10%">支付渠道</th>
                            <th width="10%">订单金额</th>
                            <th width="20%">下单时间</th>
                            <th width="10%">交易状态</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($orders){
                            foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td><?=$order->order_no?></td>
                            <td><?=$order->product?></td>
                            <td><?=$order->pay_channel?></td>
                            <td>￥<?=$order->pay_money?></td>
                            <td><?=$order->created?></td>
                            <td><?=$order->getStatus()?></td>
                        </tr>
                        <?php
                            }
                        }else{
                        ?>
                            <tr>
                                <td colspan="99" class="norecord">您还没有订单哦！</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>