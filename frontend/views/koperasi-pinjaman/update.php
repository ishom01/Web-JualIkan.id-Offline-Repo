<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KoperasiPinjaman */

$this->title = "ID Peminjaman : " . $model->pinjaman_id;
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pinjaman_id, 'url' => ['view', 'id' => $model->pinjaman_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="koperasi-pinjaman-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
