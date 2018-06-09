<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiLevel */

$this->title = $model->koperasi_level_id;
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-level-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->koperasi_level_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->koperasi_level_id], [
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
            'koperasi_level_id',
            'koperasi_level_name',
            'koperasi_level_desc:ntext',
        ],
    ]) ?>

</div>
