<?php

use yii\helpers\Html;
use yii\grid\GridView;

// use;
use backend\models\KoperasiLevel;
use backend\models\Kota;
use backend\models\UserKoperasi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserKoperasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar User Koperasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-koperasi-index">

    <?php

        $newKop = UserKoperasi::find()->where(['koperasi_status' => 0])->all();

        $Object = KoperasiLevel::find()->all();
        $ObjectArray = ArrayHelper::map($Object, 'koperasi_level_id', 'koperasi_level_name');

        $Object1 = Kota::find()->all();
        $ObjectArray1 = ArrayHelper::map($Object1, 'kota_id', 'kota_name');
    ?>
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php if (count($newKop) > 0): ?>
      <p>
          <?= Html::a('Koperasi Baru ('. count($newKop) .')', ['baru'], ['class' => 'btn btn-warning']) ?>
      </p>
    <?php endif; ?>

    <p>
        <?= Html::a('Tambah Koperasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div id="map_canvas" class="mapping" style=" margin-bottom:20px;"></div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'koperasi_id',
            'koperasi_name',
            // 'kopreasi_image:ntext',
            // 'koperasi_level_id',
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
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Level Koperasi',
                ],
                'filter'=>$ObjectArray,
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
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
            // 'koperasi_address:ntext',
            [
                'attribute'=>'koperasi_address',
                'value' => function ($data){
                    $string = (strlen($data['koperasi_address']) > 40) ? substr($data['koperasi_address'],0,37).'...' : $data['koperasi_address'];
                    // $string = substr($data['koperasi_address'],0,20).'...';
                    return $string;
                },
            ],
            //'koperasi_lat',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initMap"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://localhost/jualikan.id/backend/web/js/setMaps.js" ></script>
    <script type="text/javascript">
      getKoperasi();
    </script>
</div>
