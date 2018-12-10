<?php
use yii\helpers\Html;
use yii\helpers\Url;
$rq_action=$this->context->action->id;
$rq_controller=$this->context->action->controller->id;
?>
<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li <?php if(in_array($rq_controller,['users'])){?>class="active" <?php }?>>
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">会员管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if(in_array($rq_controller,['users'])){?>class="active" <?php }?>><a href="<?=Url::to(['users/index']) ?>">会员列表</a></li>
                        </ul>
                    </li>
                    <li <?php if(in_array($rq_controller,['category','video','article'])){?>class="active" <?php }?>>
                        <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">内容管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if(in_array($rq_controller,['category'])){?>class="active" <?php }?>><a href="<?=Url::to(['category/index']) ?>">分类管理</a></li>
                            <!-- <li <?php if(in_array($rq_controller,['video'])){?>class="active" <?php }?>><a href="<?=Url::to(['video/index']) ?>">视屏列表</a></li> -->
                            <li <?php if(in_array($rq_controller,['article'])){?>class="active" <?php }?>><a href="<?=Url::to(['article/index']) ?>">文章列表</a></li>
                        </ul>
                    </li>
                  <!--   <li <?php if(in_array($rq_controller,['adposition','adads'])){?>class="active" <?php }?>>
                        <a href="<?=Url::to(['adads/index']) ?>#"><i class="fa fa-cog"></i> <span class="nav-label">广告管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if(in_array($rq_controller,['adads'])){?>class="active" <?php }?>><a href="<?=Url::to(['adads/index']) ?>">广告管理</a></li>
                            <li <?php if(in_array($rq_controller,['adposition'])){?>class="active" <?php }?>><a href="<?=Url::to(['adposition/index']) ?>">广告位管理</a></li>
                        </ul>
                    </li> -->
                    <li <?php if(in_array($rq_controller,['form'])){?>class="active" <?php }?>>
                        <a href="<?=Url::to(['form/contact']) ?>#"><i class="fa fa-cog"></i> <span class="nav-label">表单管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=Url::to(['form/contact']) ?>">咨询</a></li>
                            <li><a href="<?=Url::to(['form/apply']) ?>">会员申请</a></li>
                        </ul>
                    </li>
                    <li <?php if(in_array($rq_controller,['member','setting'])){?>class="active" <?php }?>>
                        <a href="<?=Url::to(['site/info']) ?>#"><i class="fa fa-cog"></i> <span class="nav-label">基本设置</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=Url::to(['member/index']) ?>">管理员管理</a></li> 
                            <li><a href="<?=Url::to(['setting/data']) ?>">基本数据</a></li>
                        </ul>
                    </li>
                    <li <?php if(in_array($rq_controller,['edmmail','edmusers','edmcategory','edmhistory'])){?>class="active" <?php }?>>
                        <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">邮件群发管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if(in_array($rq_controller,['edmcategory'])){?>class="active" <?php }?>><a href="<?=Url::to(['edmcategory/index']) ?>">用户分组管理</a></li>
                            <li <?php if(in_array($rq_controller,['edmusers'])){?>class="active" <?php }?>><a href="<?=Url::to(['edmusers/index']) ?>">用户管理</a></li>
                            <li <?php if(in_array($rq_controller,['edmmail'])){?>class="active" <?php }?>><a href="<?=Url::to(['edmmail/index']) ?>">邮件管理</a></li>
                            <li <?php if(in_array($rq_controller,['edmhistory'])){?>class="active" <?php }?>><a href="<?=Url::to(['edmhistory/index']) ?>">发送任务管理</a></li>
                        </ul>
                    </li>

                   <!--  <li <?php if(in_array($rq_controller,['project','project-order','project-category'])){?>class="active" <?php }?>>
                        <a href="<?=Url::to(['project/index']) ?>#"><i class="fa fa-cog"></i> <span class="nav-label">项目管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=Url::to(['project/base']) ?>">基本设置</a></li>
                            <li><a href="<?=Url::to(['project-category/index']) ?>">分类管理</a></li>
                            <li><a href="<?=Url::to(['project/index']) ?>">项目管理</a></li>
                            <li><a href="<?=Url::to(['project-order/index']) ?>">申请管理</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </nav>