<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */

$this->title = $model->koperasi_name;
$this->params['breadcrumbs'][] = ['label' => 'User Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->koperasi_name, 'url' => ['view', 'id' => $model->koperasi_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-koperasi-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formVerifikasi', [
        'model' => $model,
    ]) ?>

</div>
