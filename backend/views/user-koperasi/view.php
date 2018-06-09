<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\KoperasiLevel;
/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */

$this->title = $model->koperasi_name;
$this->params['breadcrumbs'][] = ['label' => 'User Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-koperasi-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->koperasi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->koperasi_id], [
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
                'attribute'=>'kopreasi_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '../'. $data['kopreasi_image'], ['width' => '160px','height' => '160px']);
                },
                'headerOptions' => ['style' => 'width:90px;'],
            ],
            'koperasi_id',
            'koperasi_name',
            // 'kopreasi_image:ntext',
            [
                'attribute'=>'koperasi_level_id',
                'value' => function ($data){
                    if ($data['koperasi_level_id'] == 0) {
                        return "Belum tersedia";
                    }else {
                        $object  = KoperasiLevel::find()->where(['koperasi_level_id' => $data['koperasi_level_id']])->one();
                        return $object->koperasi_level_name;
                    }
                },
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            'koperasi_holder_name',
            'koperasi_holder_phone',
            'koperasi_email:email',
            // 'koperasi_password',
            'koperasi_kota_id',
            'koperasi_address:ntext',
            // 'koperasi_lat',
            // 'koperasi_lng',
            [
                'attribute' => 'koperasi_status',
                'format' => 'html',
                'label' => 'Status Koperasi',
                'value' => function ($data){
                    if ($data['koperasi_status'] == 0){
                        return "<p style='color:red;'>Belum Terverifikasi</p>".
                        Html::a('Verifikasi Koperasi',
                        ['verifikasi', 'id' => $data['koperasi_id']],
                        [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Apa Benar kamu akan verifikasi koperasi ini ?',
                                'method' => 'post',
                            ],
                        ]).'<br/>'.
                        Html::a('Unverfikasi Koperasi',
                        ['unverifikasi', 'id' => $data['koperasi_id']],
                        [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Apa Benar kamu akan menghapus koperasi ini ?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                    elseif ($data['koperasi_status'] == 1){
                        return "<p style='color:green;'>Aktif</p>";
                    }
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Status Koperasi',
                ],
                'filter'=>array( 0 =>"Belum Terverifikasi", 1 =>"Aktif"),
            ],        ],
    ]) ?>

</div>
