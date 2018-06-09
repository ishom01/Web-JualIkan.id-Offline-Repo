<?php
use yii\helpers\Html;

use frontend\models\UserKoperasi;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php
    $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->request->baseUrl . '/'. $object->kopreasi_image ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $object->koperasi_name ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menu Koperasi JualIkan.id', 'options' => ['class' => 'header']],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Daftar Simpan & Pinjam', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Daftar Pinjaman Nelayan',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Lihat Pinjaman Bulan Ini', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-pinjaman/indexbulan')],
                            ['label' => 'Lihat Pinjaman Keseluruhan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-pinjaman')],
                            ['label' => 'Tambah Pinjaman', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-pinjaman/create')],
                        ],
                    ],
                    [
                        'label' => 'Daftar Simpanan Nelayan',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Lihat Simpanan Bulan Ini', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-simpanan/indexbulan')],
                            ['label' => 'Lihat Simpanan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-simpanan')],
                            ['label' => 'Tambah Simpanan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-simpanan/create')],
                        ],
                    ],


                    ['label' => 'Daftar Ikan', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Daftar Ikan',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Daftar Ikan Keseluruhan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('fish')],
                            ['label' => 'Daftar 10 Ikan Paling Laris', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('fish/terlaris')],
                            ['label' => 'Tambah Data Ikan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('fish/create')],
                            // ['label' => 'Daftar Pinjaman Nelayan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('koperasi-pinjaman')],
                        ],
                    ],

                    ['label' => 'Daftar Order & Pengiriman  ', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Daftar Order',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Daftar Order Hari Ini', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('order/hariini')],
                            ['label' => 'Daftar Order Bulan Ini', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('order/bulanini')],
                            ['label' => 'Daftar Order keseluruhan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('order/')],

                        ],
                    ],
                    [
                        'label' => 'Daftar Pengiriman',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Daftar Pengiriman Hari Ini', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('delivery/hariini')],
                            ['label' => 'Daftar Pengiriman Bulan Ini', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('delivery/bulanini')],
                            ['label' => 'Daftar Pengiriman keseluruhan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('delivery/index')],

                        ],
                    ],


                    ['label' => 'Daftar User Driver & Nelayan', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Daftar Nelayan',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Daftar Nelayan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('user-nelayan')],
                            ['label' => 'Tambah Daftar Nelayan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('user-nelayan/create')],
                        ],
                    ],
                    [
                        'label' => 'Daftar Driver',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Daftar Driver', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('user-driver')],
                            ['label' => 'Tambah Daftar Driver', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('user-driver/create')],
                        ],
                    ],

                    ['label' => 'Profile Koperasi', 'options' => ['class' => 'header']],
                    ['label' => 'Review Koperasi', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('fish-review')],
                    ['label' => 'Profile Koperasi', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('user-koperasi/profile')],
                    // ['label' => 'Ikan', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('fish')],

                    // ['label' => 'Order', 'icon' => 'circle-o', 'url' => Yii::$app->urlManager->createUrl('order')],

                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>

    </section>

</aside>
