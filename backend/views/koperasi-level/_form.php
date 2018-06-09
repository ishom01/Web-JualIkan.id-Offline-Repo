<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="koperasi-level-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'koperasi_level_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_level_desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
