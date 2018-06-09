<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kota */

$this->title = 'Update Kota: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Kotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kota_id, 'url' => ['view', 'id' => $model->kota_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
