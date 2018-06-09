<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\UserNelayan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-nelayan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nelayan_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nelayan_image')->widget(FileInput::classname(), [
            // 'type' => FileInput::TYPE_INPUT,
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','gif','png'],
                'showUpload' => false,
                'showRemove' => false,
            ],
        ]);
    ?>

    <?= $form->field($model, 'nelayan_phone')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'nelayan_cooperative_id')->textInput() ?> -->

    <?= $form->field($model, 'nelayan_address')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'nelayan_saldo')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
