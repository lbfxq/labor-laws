<?php
use yii\helpers\Html;
$this->title = '文章编辑';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本数据</h5>
                </div>
                <div class="ibox-content">
                    <form id="form" method="post" class="form-horizontal" >
                        <div class="form-group">
                            <label class="col-sm-2 control-label">浏览量</label>
                            <div class="col-sm-10">
                                <input id="title" type="text" placeholder="标题" name="postdata[title]" class="form-control" required="" value="<?=$data->index_browse?>" readonly="readonly">
                            </div>
                        </div>
                         <div class="hr-line-dashed"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>