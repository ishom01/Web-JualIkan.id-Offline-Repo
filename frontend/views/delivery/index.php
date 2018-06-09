<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use common\models\UserDriver;
use backend\models\UserKoperasi;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pengiriman';
$this->params['breadcrumbs'][] = $this->title;

$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";
$object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();

?>
<div class="delivery-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Delivery', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <div id="map_canvas" class="mapping" style="margin-bottom:20px;"></div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'delivery_id',
            // 'delivery_code',
            [
                'label' => 'Kode Pengiriman',
                'attribute'=>'delivery_code',
                'value' => function ($data){
                    $berat = "Pengiriman ID-". $data['delivery_code'];
                    return $berat;
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'label' => 'Jumlah Order',
                'format' => 'html',
                'attribute'=>'delivery_code',
                'value' => function ($data){
                    $array = json_decode($data['delivery_order_id']);
                    return Html::a(count($array) . ' Order', ['view', 'id' => $data['delivery_id']],
                    [
                        'class' => 'btn btn-success',
                        'style' => 'width:100%',
                        'data' => [
                            'confirm' => 'Apa Benar kamu akan verifikasi pembayaran ini ?',
                            'method' => 'post',
                        ],
                    ]);
                },
                'headerOptions' => ['style' => 'width:110px;'],
            ],
            // 'delivery_order_id:ntext',
            // 'delivery_order_koperasi_id',
            // 'delivery_driver_id',
            [
                'label' => 'Nama Driver',
                'attribute'=>'delivery_code',
                'value' => function ($data){
                    $berat = UserDriver::find()->where(['driver_id' => $data['delivery_driver_id']])->one();
                    return $berat['driver_full_name'];
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute' => 'delivery_status',
                'format' => 'html',
                'label' => 'Status Pengiriman',
                'value' => function ($data){
                    if ($data['delivery_status'] == 0){
                        return "<p style='color:orange;'>Belum di Proses</p><p>";
                    }
                    elseif ($data['delivery_status'] == 1){
                        return "<p style='color:#337ab7;'>Dalam Proses Pengriman</p>";
                    }
                    elseif ($data['delivery_status'] == 2){
                        return "<p style='color:green;'>Pengiriman Selesai</p>";
                    }
                    elseif ($data['delivery_status'] == 3){
                        return "<p style='color:red;'>Pengiriman Gagal</p>";
                    }
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Status',
                ],
                'filter'=>array( 0 =>"Belum di Proses", 1 =>"Dalam Proses Pengiriman", 2 =>"Pengriman Selesai", 3 =>"Pengriman Gagal"),
                'headerOptions' => ['style' => 'width:200px'],
            ],
            //'delivery_driver_track_id',
            //'delivery_time_depart',
            //'delivery_time_arrival',
            //'delivery_travel_time:datetime',
            //'delivery_travel_distance',
            //'delivery_payment',
            //'delivery_status',

            [
                'header' => '',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                    'data-method' => 'post', 'data-pjax' => '0',
                        ]);
                    },
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'View')
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'delete') {
                        $url = Url::to(['delivery/delete', 'id' => $model['delivery_id']]);
                        return $url;
                    }
                    if ($action === 'view') {
                        $url = Url::to(['delivery/view', 'id' => $model['delivery_id']]);
                        return $url;
                    }
                },
                'headerOptions' => ['style' => 'width:50px'],
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo $server?>backend/web/js/setMaps.js" ></script>
    <script type="text/javascript">
      getDelivery("<?php echo $object->koperasi_id ?>");
    </script>

</div>
