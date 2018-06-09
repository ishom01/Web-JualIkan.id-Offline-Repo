<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\UserNelayan;
use backend\models\UserKoperasi;
use yii\helpers\ArrayHelper;


$Object = UserNelayan::find()->all();
$objectArray = ArrayHelper::map($Object, 'nelayan_id', 'nelayan_full_name');

/* @var $this yii\web\View */
/* @var $model common\models\KoperasiPinjaman */

$this->title = "ID Peminjaman : " . $model->pinjaman_id;
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-pinjaman-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pinjaman_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pinjaman_id], [
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
          'pinjaman_id',
          [
              'attribute'=>'pinjaman_koperasi_id',
              'format' => 'html',
              'value' => function ($data){
                  $object  = UserKoperasi::find()->where(['koperasi_id' => $data['pinjaman_koperasi_id']])->one();
                  return $object['koperasi_name'];
              },
          ],
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

          'pinjaman_desc:ntext',
        ],
    ]) ?>

</div>
