<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\rating\StarRating;
use frontend\models\UserKoperasi;
use common\models\FishReview;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Ikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="fish-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $Object = UserKoperasi::find()->all();
        $objectArray = ArrayHelper::map($Object, 'koperasi_id', 'koperasi_name');
    ?>

    <p>
        <?= Html::a('Create Fish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'fish_id',
            // 'fish_image:ntext',
            [
                'attribute'=>'fish_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['fish_image'], ['width' => '120px','height' => '75px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],

            'fish_name',
            // 'fish_price',
            // [
            //     'attribute'=>'fish_koperasi_id',
            //     'value' => function ($data){
            //         $object  = UserKoperasi::find()->where(['koperasi_id' => $data['fish_koperasi_id']])->one();
            //         return $object->koperasi_name;
            //     },
            //     'filterInputOptions' => [
            //         'class' => 'form-control',
            //         'prompt'=>'Pilih Lokasi Distribusi',
            //     ],
            //     'filter'=> $objectArray,
            //     // 'headerOptions' => ['style' => 'width:20%'],
            // ],
            [
                'attribute'=>'fish_price',
                'value' => function ($data){
                    return "Rp. ". $data['fish_price'];
                },
            ],
            // [
            //     'attribute'=>'fish_stock',
            //     'value' => function ($data){
            //         return $data['fish_stock']  . " ekor";
            //     },
            // ],
            [
                'attribute'=>'Rating',
                'format' => 'html',
                'value' => function ($data){
                    $object  = FishReview::find()->where(['fish_id' => $data['fish_id']])->all();
                    $item = 0;
                    foreach ($object as $value) {
                        $item = $value['review_jumalh'] + $item;
                    }
                    if (count($object) != 0) {
                        $total = $item/count($object);
                    }else {
                        $total = 0;
                    }
                    if (count($object) == 0) {
                        return "Belum ada review";
                    }else if ($total > 0 && $total <= 1) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>' . " ($total.0)";
                    }else if ($total > 1 && $total <= 2) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>'. " ($total.0)";
                    }else if ($total > 2 && $total <= 3) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>'. " ($total.0)";
                    }else if ($total > 3 && $total <= 4) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star "></span>' . " ($total.0)";
                    }else if ($total > 4 && $total <= 5) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>' . " ($total.0)" ;
                    }
                },
            ],
            [
                'attribute'=>'fish_qty',
                'value' => function ($data){
                    return $data['fish_qty'] . " KG";
                },
            ],
            // 'fish_category_id',
            // 'fish_condition_id',
            // 'fish_size_id',
            // 'fish_stock',

            // 'fish_description:ntext',
            // 'fish_date',
            [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                    'data-method' => 'post', 'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'Update')
                        ]);
                    },
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'View')
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $data) {
                    if ($action === 'delete') {
                        $url = Url::to(['fish/delete', 'id' => $data['fish_id']]);
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = Url::to(['fish/update', 'id' => $data['fish_id']]);
                        return $url;
                    }
                    if ($action === 'view') {
                        $url = Url::to(['fish/view', 'id' => $data['fish_id']]);
                        return $url;
                    }
                }
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
