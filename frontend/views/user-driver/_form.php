<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\UserDriver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'driver_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_image')->widget(FileInput::classname(), [
            // 'type' => FileInput::TYPE_INPUT,
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','gif','png'],
                'showUpload' => false,
                'showRemove' => false,
            ],
        ]);
    ?>


    <?= $form->field($model, 'driver_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_password')->passwordInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'driver_device_id')->textInput(['maxlength' => true]) ?> -->


    <!-- <?= $form->field($model, 'driver_koperasi_id')->textInput() ?> -->

    <?= $form->field($model, 'driver_vehicle_weight')->textInput() ?>

    <?= $form->field($model, 'driver_address')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'driver_saldo')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
