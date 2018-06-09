<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiLevel */

$this->title = 'Update Koperasi Level: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->koperasi_level_id, 'url' => ['view', 'id' => $model->koperasi_level_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="koperasi-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
