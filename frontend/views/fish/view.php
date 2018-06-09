<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\FishCategory;
use backend\models\FishCondition;
use backend\models\UserKoperasi;
use backend\models\FishSize;

/* @var $this yii\web\View */
/* @var $model backend\models\Fish */

$this->title = $model->fish_name;
$this->params['breadcrumbs'][] = ['label' => 'Fish', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fish-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fish_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fish_id], [
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
            // 'fish_id',
            // 'fish_image:ntext',
            [
                'attribute'=>'fish_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['fish_image'], ['width' => '320px','height' => '200px']);
                },
            ],
            'fish_name',
            // 'fish_price',
            [
                'attribute'=>'fish_price',
                'value' => function ($data){
                    return "Rp. ". $data['fish_price'];
                },
            ],

            // 'fish_category_id',
            [
                'attribute'=>'fish_koperasi_id',
                'value' => function ($data){
                    $object  = UserKoperasi::find()->where(['koperasi_id' => $data['fish_koperasi_id']])->one();
                    return $object->koperasi_name;
                },
            ],
            [
                'attribute'=>'fish_category_id',
                'value' => function ($data){
                    $user  = FishCategory::find()->where(['fish_category_id' => $data['fish_category_id']])->one();
                    return $user->fish_category_name;
                },
            ],
            [
                'attribute'=>'fish_condition_id',
                'value' => function ($data){
                    $user  = FishCondition::find()->where(['fish_condition_id' => $data['fish_condition_id']])->one();
                    return $user->fish_condition_name;
                },
            ],
            [
                'attribute'=>'fish_size_id',
                'value' => function ($data){
                    $user  = FishSize::find()->where(['fish_size_id' => $data['fish_size_id']])->one();
                    return $user->fish_size_name;
                },
            ],
            // 'fish_condition_id',
            // 'fish_size_id',
            // 'fish_stock',
            [
                'attribute'=>'fish_stock',
                'value' => function ($data){
                    return $data['fish_stock']  . " ekor";
                },
            ],
            'fish_description:ntext',
            // 'fish_date',
            [
                'attribute'=>'fish_date',
                'value' => function ($data){
                    Yii::$app->formatter->locale = 'en-US';
                    // echo Yii::$app->formatter->asDate('2014-01-01'); // output: 1. Januar 2014
                    return Yii::$app->formatter->asDate($data['fish_date']);
                },
            ],
        ],
    ]) ?>

</div>
