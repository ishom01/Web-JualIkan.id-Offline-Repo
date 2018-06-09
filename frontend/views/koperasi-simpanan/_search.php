<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiSimpananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="koperasi-simpanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'simpanan_id') ?>

    <?= $form->field($model, 'simpanan_koperasi_id') ?>

    <?= $form->field($model, 'simpanan_date') ?>

    <?= $form->field($model, 'simpanan_nelayan_id') ?>

    <?= $form->field($model, 'simpanan_desc') ?>

    <?php // echo $form->field($model, 'simpanan_jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
