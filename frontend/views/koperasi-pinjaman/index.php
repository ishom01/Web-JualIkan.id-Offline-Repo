<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\UserNelayan;
use yii\helpers\ArrayHelper;


$Object = UserNelayan::find()->all();
$objectArray = ArrayHelper::map($Object, 'nelayan_id', 'nelayan_full_name');

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KoperasiPinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pinjaman Koperasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-pinjaman-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pinjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'pinjaman_id',

            // 'pinjaman_koperasi_id',
            [
                'attribute'=>'pinjaman_nelayan_id',
                'format' => 'html',
                'value' => function ($data){
                    $object  = UserNelayan::find()->where(['nelayan_id' => $data['pinjaman_nelayan_id']])->one();
                    return $object['nelayan_full_name'];
                },
            ],
            'pinjaman_date',
            // 'pinjaman_jumlah',
            [
                'attribute'=>'pinjaman_jumlah',
                'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['pinjaman_jumlah'];
                },
            ],

            // 'pinjaman_dessc:ntext',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
