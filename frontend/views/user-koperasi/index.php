<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserKoperasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Koperasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-koperasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Koperasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'koperasi_id',
            'koperasi_name',
            'kopreasi_image:ntext',
            'koperasi_level_id',
            'koperasi_holder_name',
            //'koperasi_holder_phone',
            //'koperasi_email:email',
            //'koperasi_password',
            //'koperasi_kota_id',
            //'koperasi_address:ntext',
            //'koperasi_lat',
            //'koperasi_lng',
            //'koperasi_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
