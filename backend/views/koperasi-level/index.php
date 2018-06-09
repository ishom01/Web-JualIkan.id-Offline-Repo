<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KoperasiLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Koperasi Levels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-level-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Koperasi Level', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'koperasi_level_id',
            'koperasi_level_name',
            'koperasi_level_desc:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
