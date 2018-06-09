<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'order_cart_id') ?>

    <?= $form->field($model, 'order_user_id') ?>

    <?= $form->field($model, 'order_location_adress') ?>

    <?= $form->field($model, 'order_location_lat') ?>

    <?php // echo $form->field($model, 'order_location_lng') ?>

    <?php // echo $form->field($model, 'order_driver_id') ?>

    <?php // echo $form->field($model, 'order_drive_track_id') ?>

    <?php // echo $form->field($model, 'order_koperasi_location_id') ?>

    <?php // echo $form->field($model, 'order_delivery_time') ?>

    <?php // echo $form->field($model, 'order_delivery_distance') ?>

    <?php // echo $form->field($model, 'order_delivery_payment') ?>

    <?php // echo $form->field($model, 'order_delivery_payment_url') ?>

    <?php // echo $form->field($model, 'order_weight') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'order_payment_type_id') ?>

    <?php // echo $form->field($model, 'order_payment_total') ?>

    <?php // echo $form->field($model, 'order_delivery_time_id') ?>

    <?php // echo $form->field($model, 'order_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
