<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserDriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Driver';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Daftar Driver Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'driver_id',
            [
                'attribute'=>'driver_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['driver_image'], ['width' => '100%','height' => '75px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'driver_full_name',
            'driver_phone',
            'driver_email:email',
            // 'driver_password',
            //'driver_device_id',
            //'driver_koperasi_id',
            //'driver_vehicle_weight',
            //'driver_address:ntext',
            //'driver_track_id',
            [
                'attribute'=>'driver_saldo',
                // 'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['driver_saldo'];
                },
            ],
            [
                'attribute' => 'driver_status',
                'format' => 'html',
                'value' => function ($data){
                    if ($data['driver_status'] == 0){
                        return "<p style='color:red;'>Tidak Aktif</p>";
                    }
                    elseif ($data['driver_status'] == 1){
                        return "<p style='color:green;'>Aktif</p>";
                    }
                    elseif ($data['driver_status'] == 2){
                        return "<p style='color:#337ab7;'>Dalam Proses Pengiriman</p><p>".
                        Html::a('Tracking Driver', ['delivery/track', 'id' => $data['driver_id']],
                        [
                            'style' => 'width:100%',
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Apa Benar kamu akan verifikasi pembayaran ini ?',
                                'method' => 'post',
                            ],
                        ])."</p>";
                    }
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Status',
                ],
                'filter'=>array( 0 =>"Tidak Aktif", 1 =>"Aktif", 2 =>"Dalam Proses Pengiriman"),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
