<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KoperasiSimpanan */

$this->title = 'Update Koperasi Simpanan: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->simpanan_id, 'url' => ['view', 'id' => $model->simpanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="koperasi-simpanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
