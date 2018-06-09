<?php
use yii\helpers\Html;

use frontend\models\UserKoperasi;
use common\models\Order;
/* @var $this \yii\web\View */
/* @var $content string */

$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";
?>

<header class="main-header">

    <?php
        date_default_timezone_set('Asia/Jakarta');
        $date = Date('Y-m-d');

        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();

        $OrderBelumDibayar = Order::find()->where(['order_status' => 0])->andFilterWhere(['like', 'order_date',$date])->all();
        $totOrderBelumDibayar = count($OrderBelumDibayar);

        $OrderSudahDibayar = Order::find()->where(['order_status' => 1])->andFilterWhere(['like', 'order_date',$date])->all();
        $totOrderSudahDibayar = count($OrderSudahDibayar);

    ?>

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <?php
                    $count = $totOrderSudahDibayar  + $totOrderBelumDibayar;
                ?>
                <li class="dropdown notifications-menu">
                    <?php
                    if ($count != 0) {
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?php echo $count ?></span>
                    </a>
                    <?php
                    }
                    ?>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php echo $count ?> notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <!-- <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may
                                        not fit into the page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-red"></i> 25 order notification
                                    </a>
                                </li> -->

                                <li>
                                    <a href="<?php echo $server. 'order/hariini' ?>">
                                        <i class="fa fa-shopping-cart text-yellow"></i> <?php echo ($totOrderBelumDibayar + $totOrderSudahDibayar) ?> order yang masuk
                                    </a>
                                </li>

                                <!-- <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->request->baseUrl . '/'. $object->kopreasi_image ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $object->koperasi_name ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->request->baseUrl . '/'. $object->kopreasi_image ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php echo $object->koperasi_name ?>
                                <small>Member since Nov. 2018</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo $server. 'user-koperasi/profile' ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
