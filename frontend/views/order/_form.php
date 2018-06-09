<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_cart_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order_user_id')->textInput() ?>

    <?= $form->field($model, 'order_location_adress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order_location_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_location_lng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_driver_id')->textInput() ?>

    <?= $form->field($model, 'order_drive_track_id')->textInput() ?>

    <?= $form->field($model, 'order_koperasi_location_id')->textInput() ?>

    <?= $form->field($model, 'order_delivery_time')->textInput() ?>

    <?= $form->field($model, 'order_delivery_distance')->textInput() ?>

    <?= $form->field($model, 'order_delivery_payment')->textInput() ?>

    <?= $form->field($model, 'order_delivery_payment_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order_weight')->textInput() ?>

    <?= $form->field($model, 'order_date')->textInput() ?>

    <?= $form->field($model, 'order_payment_type_id')->textInput() ?>

    <?= $form->field($model, 'order_payment_total')->textInput() ?>

    <?= $form->field($model, 'order_delivery_time_id')->textInput() ?>

    <?= $form->field($model, 'order_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
