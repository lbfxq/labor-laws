<?php
use yii\helpers\Html;
$this->title = '订单详细';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>订单详细</h5>
                </div>
                <div class="ibox-content">
                    <h3>基础信息</h3>
                    <div class="table-responsive">
                      <table class="table">
                            <tr>
                              <td class="active">订单号:</td>
                              <td class="info"><?=$data->order_no?></td>
                              <td class="active">支付渠道:</td>
                              <td class="info"><?=$data->payment?></td>
                              <td class="active">支付金额:</td>
                              <td class="info"><?=$data->amount?>元</td>
                            </tr>
                            <tr>
                              <td class="active">姓名:</td>
                              <td class="info"><?=$data->name?></td>
                              <td class="active">性别:</td>
                              <td class="info"><?=$data->sex?></td>
                              <td class="active">手机号码:</td>
                              <td class="info"><?=$data->mobile?></td>
                            </tr>
                            <tr>
                              <td class="active">邮箱:</td>
                              <td class="info"><?=$data->email?></td>
                              <td class="active">是否需要发票:</td>
                              <td class="info"><?php echo $data->invoice_flag==2?"是":"否"?></td>
                              <td class="active">公司名称/税号:</td>
                              <td class="info"><?=$data->invoice_title?><br/><?=$data->invoice_no?></td>
                            </tr>
                            <tr>
                              <td class="active">备注:</td>
                              <td class="info" colspan="5"><?=$data->note?></td>
                            </tr>
                      </table>
                    </div>
                    <h3>项目信息</h3>
                   <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                            <tr>
                              <th>项目名称</th>
                              <th>地址</th>
                              <th>时间</th>
                            </tr>
                          </thead>
                          <?php
                            if($details){
                                foreach ($details as $item) {
                             ?>
                                <tr>
                                  <td><?=$item['title']?></td>
                                  <td><?=$item['area']?></td>
                                  <td><?=$item['pdate']?></td>
                                </tr>
                             <?php
                                }
                            }
                          ?>
                            
                      </table>
                    </div>

                    <h3>状态</h3>
                    <form id="form" method="post" class="form-horizontal" onsubmit="ajax_submit();return false;">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <select class="form-control m-b" name="status">
                                    <option value="1" <?php if ($data->status ==1){?> selected="selected"<?php }?> >待支付</option>
                                    <option value="2" <?php if ($data->status ==2){?> selected="selected"<?php }?> >已支付</option>
                                    <option value="3" <?php if ($data->status ==3){?> selected="selected"<?php }?> >已取消</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="submit" data-style="zoom-in">保 存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>