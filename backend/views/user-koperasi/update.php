<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */

$this->title = $model->koperasi_name;
$this->params['breadcrumbs'][] = ['label' => 'User Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->koperasi_id, 'url' => ['view', 'id' => $model->koperasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-koperasi-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?php
    if ($model->koperasi_status == 0) {
    ?> 

    <!-- belum terverifikasi -->
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php
    }else {
    ?>

    <!-- sudah terverifikasi -->
    <?= $this->render('_formVerifikasi', [
        'model' => $model,
    ]) ?>

    <?php
    }
    ?>



</div>
