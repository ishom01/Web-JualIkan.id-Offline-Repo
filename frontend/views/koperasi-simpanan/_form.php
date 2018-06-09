<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\UserNelayan;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;

$Nelaayan = UserNelayan::find()->all();
$NelayanArray  = ArrayHelper::map($Nelaayan, 'nelayan_id', 'nelayan_full_name');
/* @var $this yii\web\View */
/* @var $model common\models\KoperasiSimpanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="koperasi-simpanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'simpanan_nelayan_id')->dropDownList($NelayanArray, [
        'prompt'=>'Pilih Nama Nelayan']); ?>

    <!-- <?= $form->field($model, 'simpanan_koperasi_id')->textInput() ?> -->

    <!-- <?= $form->field($model, 'simpanan_date')->textInput() ?> -->

    <?= $form->field($model, 'simpanan_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih tanggal...'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <!-- <?= $form->field($model, 'simpanan_nelayan_id')->textInput() ?> -->

    <?= $form->field($model, 'simpanan_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'simpanan_jumlah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
