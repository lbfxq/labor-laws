<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-8 col-md-7 col-lg-8">
            <div class="media">
                <h5><span class="label label-default">用户登录</span></h5>
                <div class="media-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">电子邮箱</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">登录密码</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="Password" name="pwd">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputPassword1">验证码</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="Password">
                        </div> 
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> 在此电脑记住用户
                            </label>
                        </div>-->
                        <p><?=$errormsg?></p>
                        <button type="submit" class="btn btn-default btn-block">登录</button>
                    </form>
                </div>

            </div>

        </div>

        <div class="col-sm-4 col-md-5 col-lg-4 my-ol right mt10" id="right1">
            <div id="my-position2" data-spy="affix" data-offset-top="106" data-offset-bottom="82">


                <div class="media">
                    <div class="my-ol-header">联系方式</div>
                    <div class="media-body" style="word-break: break-all;padding: 0 0.3rem">
                        <p>联系方式联系方式联系方式联系方式</p>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
