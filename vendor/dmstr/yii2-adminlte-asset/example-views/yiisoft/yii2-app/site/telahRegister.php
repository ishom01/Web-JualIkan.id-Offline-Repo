<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box" style="margin-top:60px;">
    <div class="login-logo">
        <a href="index"><b>Koperasi </b>JualIkan.id</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h4 class="login-box-msg" style="margin-top:20px;"><b>Selamat anda telah melakukan registerasi !</b></h4>
        <p class="login-box-msg" >Tunggu data anda akan diverifikasi oleh admin dan dikirim via email</p>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
