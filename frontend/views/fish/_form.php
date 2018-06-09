<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\framework\widgets\CMultiFileUpload;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;
use backend\models\FishCategory;
use backend\models\FishCondition;
use backend\models\FishSize;
use backend\models\UserKoperasi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Fish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fish-form">

    <?php $form = ActiveForm::begin([
      'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?php
        $FishCategory = FishCategory::find()->all();
        $FishCategoryArray = ArrayHelper::map($FishCategory, 'fish_category_id', 'fish_category_name');

        $FishCondition = FishCondition::find()->all();
        $FishConditionArray = ArrayHelper::map($FishCondition, 'fish_condition_id', 'fish_condition_name');

        $FishSize = FishSize::find()->all();
        $FishSizeArray = ArrayHelper::map($FishSize, 'fish_size_id', 'fish_size_name');

        $DistributionLocation = UserKoperasi::find()->all();
        $DistributionLocationArray = ArrayHelper::map($DistributionLocation, 'koperasi_id', 'koperasi_name');
    ?>

    <?= $form->field($model, 'fish_image')->widget(FileInput::classname(), [
            // 'type' => FileInput::TYPE_INPUT,
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','gif','png'],
                'showUpload' => false,
                'showRemove' => false,
            ],
        ]);
    ?>

    <?= $form->field($model, 'fish_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fish_price')->textInput() ?>

    <?= $form->field($model, 'fish_koperasi_id')->dropDownList($DistributionLocationArray, ['prompt'=>'Pilih Lokasi Koperasi', 'disabled' => true]); ?>

    <?= $form->field($model, 'fish_category_id')->dropDownList($FishCategoryArray, ['prompt'=>'Pilih Jenis Kategori']); ?>

    <?= $form->field($model, 'fish_condition_id')->dropDownList($FishConditionArray, ['prompt'=>'Pilih Kondisi Ikan']); ?>

    <?= $form->field($model, 'fish_size_id')->dropDownList($FishSizeArray, ['prompt'=>'Pilih Ukuran Ikan']); ?>

    <?= $form->field($model, 'fish_stock')->textInput() ?>

    <?= $form->field($model, 'fish_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fish_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih tanggal...'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
