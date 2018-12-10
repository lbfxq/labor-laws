<?php
use yii\helpers\Html;
$this->title = '咨询详细';
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
                    <h5>咨询详细</h5>
                </div>
                <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">貴社名:</label>
                            <div class="col-sm-11">
                                <?=$data->company?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">部署:</label>
                            <div class="col-sm-11">
                                <?=$data->deparment?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">職務:</label>
                            <div class="col-sm-11">
                                <?=$data->post?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">お名前:</label>
                            <div class="col-sm-11">
                                <?=$data->username?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">住所:</label>
                            <div class="col-sm-11">
                                <?=$data->address?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">TEL:</label>
                            <div class="col-sm-11">
                                <?=$data->tel?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">FAX:</label>
                            <div class="col-sm-11">
                                <?=$data->fax?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">EMAIL:</label>
                            <div class="col-sm-11">
                                <?=$data->email?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">ホームページ:</label>
                            <div class="col-sm-11">
                                <?=$data->home?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">認証番号:</label>
                            <div class="col-sm-11">
                                <?=$data->number1?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">テーマ:</label>
                            <div class="col-sm-11">
                                <?=$data->theme?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">内容:</label>
                            <div class="col-sm-11">
                                <?=nl2br($data->content)?>
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