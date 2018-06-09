<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Delivery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'delivery_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_order_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'delivery_order_koperasi_id')->textInput() ?>

    <?= $form->field($model, 'delivery_driver_id')->textInput() ?>

    <?= $form->field($model, 'delivery_driver_track_id')->textInput() ?>

    <?= $form->field($model, 'delivery_time_depart')->textInput() ?>

    <?= $form->field($model, 'delivery_time_arrival')->textInput() ?>

    <?= $form->field($model, 'delivery_travel_time')->textInput() ?>

    <?= $form->field($model, 'delivery_travel_distance')->textInput() ?>

    <?= $form->field($model, 'delivery_payment')->textInput() ?>

    <?= $form->field($model, 'delivery_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
