<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\KoperasiLevel;
use backend\models\Kota;
use backend\models\UserKoperasi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaldoHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kopreasi Baru';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-koperasi-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

        $newKop = UserKoperasi::find()->where(['koperasi_status' => 0])->all();

        $Object = KoperasiLevel::find()->all();
        $ObjectArray = ArrayHelper::map($Object, 'koperasi_level_id', 'koperasi_level_name');

        $Object1 = Kota::find()->all();
        $ObjectArray1 = ArrayHelper::map($Object1, 'kota_id', 'kota_name');
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'koperasi_id',
            'koperasi_name',
            // 'kopreasi_image:ntext',
            // 'koperasi_level_id',
            // 'koperasi_holder_name',
            [
                'attribute'=>'koperasi_kota_id',
                'value' => function ($data){
                    $object  = Kota::find()->where(['kota_id' => $data['koperasi_kota_id']])->one();
                    return $object->kota_name;
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Kota',
                ],
                'filter'=>$ObjectArray1,
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            //'koperasi_holder_phone',
            //'koperasi_email:email',
            //'koperasi_password',
            //'koperasi_kota_id',
            [
                'attribute'=>'koperasi_address',
                'value' => function ($data){
                    $string = (strlen($data['koperasi_address']) > 60) ? substr($data['koperasi_address'],0,57).'...' : $data['koperasi_address'];
                    // $string = substr($data['koperasi_address'],0,20).'...';
                    return $string;
                },
            ],            //'koperasi_lat',
            //'koperasi_lng',
            // 'koperasi_status',

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
            ],
        ],
    ]); ?>
</div>
