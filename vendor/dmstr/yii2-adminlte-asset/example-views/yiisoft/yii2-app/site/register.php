<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use frontend\models\Kota;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Register Koperasi';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$Object = Kota::find()->all();
$ObjectArray = ArrayHelper::map($Object, 'kota_id', 'kota_name');
?>

<div class="login-box" style="margin-top:60px;">
    <div class="login-logo">
        <a href="index"><b>Koperasi </b>JualIkan.id</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Silahkan isi form register ini !</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form->field($model, 'koperasi_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'koperasi_holder_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'koperasi_holder_phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'koperasi_email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'koperasi_kota_id')->dropDownList($ObjectArray, ['prompt'=>'Pilih Nama Kota']); ?>

        <?= $form->field($model, 'koperasi_address')->textarea(['rows' => 6]) ?>

        <div class="row">
            <div class="col-xs-12">
              <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>

        <!-- <a href="login" class="text-center btn btn-primary btn-block btn-flat" style="margin-top:16px;">Log</a> -->

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
