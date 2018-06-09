<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserNelayanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-nelayan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nelayan_id') ?>

    <?= $form->field($model, 'nelayan_full_name') ?>

    <?= $form->field($model, 'nelayan_image') ?>

    <?= $form->field($model, 'nelayan_phone') ?>

    <?= $form->field($model, 'nelayan_cooperative_id') ?>

    <?php // echo $form->field($model, 'nelayan_address') ?>

    <?php // echo $form->field($model, 'nelayan_saldo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
