<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Kota */

$this->title = $model->kota_id;
$this->params['breadcrumbs'][] = ['label' => 'Kotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kota_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kota_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kota_id',
            'kota_provinsi_id',
            'kota_name',
        ],
    ]) ?>

</div>
