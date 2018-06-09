<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Kota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kota-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kota_provinsi_id')->textInput() ?>

    <?= $form->field($model, 'kota_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
