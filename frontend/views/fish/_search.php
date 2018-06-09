<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FishSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fish-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fish_id') ?>

    <?= $form->field($model, 'fish_image') ?>

    <?= $form->field($model, 'fish_name') ?>

    <?= $form->field($model, 'fish_price') ?>

    <?= $form->field($model, 'fish_koperasi_id') ?>

    <?php // echo $form->field($model, 'fish_category_id') ?>

    <?php // echo $form->field($model, 'fish_condition_id') ?>

    <?php // echo $form->field($model, 'fish_size_id') ?>

    <?php // echo $form->field($model, 'fish_stock') ?>

    <?php // echo $form->field($model, 'fish_description') ?>

    <?php // echo $form->field($model, 'fish_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
