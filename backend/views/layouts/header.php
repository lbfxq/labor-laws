 <?php
use yii\helpers\Html;
use yii\helpers\Url;
$session=Yii::$app->getSession();
$memberinfo=$session->get("loginuserinfo");
?>
 <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">欢迎回来!</span>
                </li>
                <li>
                    <a href="<?=Url::to(['login/out']) ?>">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>