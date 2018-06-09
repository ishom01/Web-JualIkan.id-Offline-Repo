<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserNelayanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Nelayan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-nelayan-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Daftar Nelayan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'nelayan_id',
            // 'nelayan_image:ntext',
            [
                'attribute'=>'nelayan_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['nelayan_image'], ['width' => '100%','height' => '75px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'nelayan_full_name',
            'nelayan_phone',
            // 'nelayan_cooperative_id',
            // [
            //     'attribute'=>'nelayan_address',
            //     'format' => 'html',
            //     'value' => function ($data){
            //         return $data['nelayan_image'];
            //     },
            //     'headerOptions' => ['style' => 'width:130px;'],
            // ],
            // 'nelayan_saldo',
            [
                'attribute'=>'nelayan_saldo',
                // 'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['nelayan_saldo'];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
