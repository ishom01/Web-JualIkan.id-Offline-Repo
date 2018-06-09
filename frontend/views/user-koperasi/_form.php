<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\FileInput;
use frontend\models\Kota;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-koperasi-form">

    <?php $form = ActiveForm::begin();

    $Kota = Kota::find()->all();
    $KotaArray = ArrayHelper::map($Kota, 'kota_id', 'kota_name');

    ?>

    <?= $form->field($model, 'koperasi_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kopreasi_image')->widget(FileInput::classname(), [
            // 'type' => FileInput::TYPE_INPUT,
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','gif','png'],
                'showUpload' => false,
                'showRemove' => false,
            ],
        ]);
    ?>


    <?= $form->field($model, 'koperasi_holder_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_holder_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_kota_id')->dropDownList($KotaArray, ['prompt'=>'Pilih Lokasi Kota']); ?>

    <?= $form->field($model, 'koperasi_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'koperasi_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_lng')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
