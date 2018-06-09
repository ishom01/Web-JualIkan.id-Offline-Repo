<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-koperasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'koperasi_id') ?>

    <?= $form->field($model, 'koperasi_name') ?>

    <?= $form->field($model, 'kopreasi_image') ?>

    <?= $form->field($model, 'koperasi_level_id') ?>

    <?= $form->field($model, 'koperasi_holder_name') ?>

    <?php // echo $form->field($model, 'koperasi_holder_phone') ?>

    <?php // echo $form->field($model, 'koperasi_email') ?>

    <?php // echo $form->field($model, 'koperasi_password') ?>

    <?php // echo $form->field($model, 'koperasi_kota_id') ?>

    <?php // echo $form->field($model, 'koperasi_address') ?>

    <?php // echo $form->field($model, 'koperasi_lat') ?>

    <?php // echo $form->field($model, 'koperasi_lng') ?>

    <?php // echo $form->field($model, 'koperasi_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
