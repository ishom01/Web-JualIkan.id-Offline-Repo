<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserNelayan */

$this->title = $model->nelayan_full_name;
$this->params['breadcrumbs'][] = ['label' => 'User Nelayans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-nelayan-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nelayan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nelayan_id], [
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
            [
                'attribute'=>'nelayan_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['nelayan_image'], ['width' => '100%','height' => '125px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'nelayan_full_name',
            'nelayan_phone',
            // 'nelayan_cooperative_id',
            'nelayan_address:ntext',
            // 'nelayan_saldo',
            [
                'attribute'=>'nelayan_saldo',
                // 'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['nelayan_saldo'];
                },
            ],
            // 'nelayan_id',
            // 'nelayan_full_name',
            // 'nelayan_image:ntext',
            // 'nelayan_phone',
            // 'nelayan_cooperative_id',
            // 'nelayan_address:ntext',
            // 'nelayan_saldo',
        ],
    ]) ?>

</div>
