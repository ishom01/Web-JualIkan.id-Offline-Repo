<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DeliverySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'delivery_id') ?>

    <?= $form->field($model, 'delivery_code') ?>

    <?= $form->field($model, 'delivery_order_id') ?>

    <?= $form->field($model, 'delivery_order_koperasi_id') ?>

    <?= $form->field($model, 'delivery_driver_id') ?>

    <?php // echo $form->field($model, 'delivery_driver_track_id') ?>

    <?php // echo $form->field($model, 'delivery_time_depart') ?>

    <?php // echo $form->field($model, 'delivery_time_arrival') ?>

    <?php // echo $form->field($model, 'delivery_travel_time') ?>

    <?php // echo $form->field($model, 'delivery_travel_distance') ?>

    <?php // echo $form->field($model, 'delivery_payment') ?>

    <?php // echo $form->field($model, 'delivery_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
