<?php
use yii\helpers\Html;
$this->title = '会员申请详细';
?>
<style type="text/css">
.form-group{
    overflow: auto;
}
.form-group p{
    height: 15px;
}
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>会员申请详细</h5>
                </div>
                <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">お申込み日:</label>
                            <div class="col-sm-8">
                                <?=$data->apply_date?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">貴社名:</label>
                            <div class="col-sm-8">
                                <?=$data->company?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">郵便番号:</label>
                            <div class="col-sm-8">
                                <?=$data->zipcode?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご住所:</label>
                            <div class="col-sm-8">
                                <?=$data->address?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">TEL:</label>
                            <div class="col-sm-8">
                                <?=$data->tel?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">FAX:</label>
                            <div class="col-sm-8">
                                <?=$data->fax?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様1-所属部署:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_dpt_1?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様1-お名前:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_name_1?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様1-TEL:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_tel_1?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様1-E-mail:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_mail_1?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様2-所属部署:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_dpt_2?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様2-お名前:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_name_2?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様2-TEL:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_tel_2?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様2-E-mail:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_mail_2?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様3-所属部署:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_dpt_3?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様3-お名前:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_name_3?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様3-TEL:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_tel_3?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご担当者様3-E-mail:</label>
                            <div class="col-sm-8">
                                <?=$data->contact_mail_3?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">貴社名:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_company?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">郵便番号:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_zipcode?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ご住所:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_add?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">所属部署:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_dpt?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">職務:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_job?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">お名前:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_name?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">TEL:</label>
                            <div class="col-sm-8">
                                <?=$data->recive_tel?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">メールマガジン1:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_1?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">メールマガジン2:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_2?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">メールマガジン3:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_3?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ホームページを見て:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_4?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">セミナーに参加して:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_m?>-<?=$data->unknow_d?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">セミナー名:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_5?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">知人の紹介    お名前:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_6?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">その他:</label>
                            <div class="col-sm-8">
                                <?=$data->unknow_7?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">備考:</label>
                            <div class="col-sm-8">
                                <?=nl2br($data->marks)?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="ladda-button ladda-button-demo btn btn-primary" type="button" data-style="zoom-in" onclick="javascript:history.back(-1);">返 回</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>