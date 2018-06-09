<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\UserNelayan;
use yii\helpers\ArrayHelper;


$Object = UserNelayan::find()->all();
$objectArray = ArrayHelper::map($Object, 'nelayan_id', 'nelayan_full_name');

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KoperasiSimpananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Simpanan Koperasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-simpanan-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Simpanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'simpanan_id',
            // 'simpanan_koperasi_id',
            // 'simpanan_nelayan_id',
            [
                'attribute'=>'simpanan_nelayan_id',
                'format' => 'html',
                'value' => function ($data){
                    $object  = UserNelayan::find()->where(['nelayan_id' => $data['simpanan_nelayan_id']])->one();
                    return $object['nelayan_full_name'];
                },
            ],
            'simpanan_date',
            // 'simpanan_desc:ntext',
            // 'simpanan_jumlah',
            [
                'attribute'=>'simpanan_jumlah',
                'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['simpanan_jumlah'];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
