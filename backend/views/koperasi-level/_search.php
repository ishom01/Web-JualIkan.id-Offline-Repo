<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiLevelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="koperasi-level-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'koperasi_level_id') ?>

    <?= $form->field($model, 'koperasi_level_name') ?>

    <?= $form->field($model, 'koperasi_level_desc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
