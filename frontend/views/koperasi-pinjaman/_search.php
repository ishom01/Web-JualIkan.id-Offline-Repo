<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiPinjamanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="koperasi-pinjaman-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pinjaman_id') ?>

    <?= $form->field($model, 'pinjaman_koperasi_id') ?>

    <?= $form->field($model, 'pinjaman_nelayan_id') ?>

    <?= $form->field($model, 'pinjaman_date') ?>

    <?= $form->field($model, 'pinjaman_desc') ?>

    <?php // echo $form->field($model, 'pinjaman_jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
