<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use frontend\models\UserKoperasi;

/* @var $this yii\web\View */
/* @var $model common\models\UserDriver */

$this->title = $model->driver_full_name;
$this->params['breadcrumbs'][] = ['label' => 'User Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->driver_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->driver_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'driver_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['driver_image'], ['width' => '100%','height' => '125px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'driver_full_name',
            'driver_email:email',
            'driver_phone',
            [
                'attribute'=>'driver_koperasi_id',
                'format' => 'html',
                'value' => function ($data){
                    $koperasi = UserKoperasi::find()->where(['koperasi_id' => $data['driver_koperasi_id']])->one();
                    return $koperasi['koperasi_name'];
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'driver_address:ntext',
            [
                'attribute'=>'driver_vehicle_weight',
                'format' => 'html',
                'value' => function ($data){
                    return $data['driver_vehicle_weight'] . " Kg";
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            [
                'attribute'=>'driver_saldo',
                'format' => 'html',
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
                            'style' => 'width:150px',
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
        ],
    ]) ?>

</div>
