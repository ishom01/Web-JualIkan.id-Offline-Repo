<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KoperasiSimpanan */

use common\models\UserNelayan;
use backend\models\UserKoperasi;
use yii\helpers\ArrayHelper;

$this->title = "ID Simpanan ke-". $model->simpanan_id;
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-simpanan-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->simpanan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->simpanan_id], [
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
            'simpanan_id',
            [
                'attribute'=>'simpanan_nelayan_id',
                'format' => 'html',
                'value' => function ($data){
                    $object  = UserNelayan::find()->where(['nelayan_id' => $data['simpanan_nelayan_id']])->one();
                    return $object['nelayan_full_name'];
                },
            ],
            // 'simpanan_koperasi_id',
            [
                'attribute'=>'simpanan_koperasi_id',
                'format' => 'html',
                'value' => function ($data){
                    $object  = UserKoperasi::find()->where(['koperasi_id' => $data['simpanan_koperasi_id']])->one();
                    return $object['koperasi_name'];
                },
            ],
            // 'simpanan_desc:ntext',
            // 'simpanan_jumlah',
            [
                'attribute'=>'simpanan_jumlah',
                'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['simpanan_jumlah'];
                },
            ],
            'simpanan_desc:ntext',
        ],
    ]) ?>

</div>
