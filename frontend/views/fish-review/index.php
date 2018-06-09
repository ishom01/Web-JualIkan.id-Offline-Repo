<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\UserPengguna;
use common\models\FishReview;
use backend\models\UserKoperasi;
use backend\models\Fish;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FishReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$koperasi = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
$koperasiId = $koperasi->koperasi_id;
$FishReview = FishReview::find()->where(['koperasi_id' => $koperasiId])->all();

$totReview = 0;

for($i = 0; $i < count($FishReview); $i++){
    $totReview = $totReview + $FishReview[$i]['review_jumalh'];
}

$review = $totReview/(count($FishReview));

$this->title = 'Daftar Review Koperasi';
?>
<div class="fish-review-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 style="font-size:32px;">
                        <?php echo $review . "/5";?>
                    </h3>
                    <p>Jumlah Rating</p>
                </div>
                <div class="icon">
                    <i class="fa fa fa-star"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 style="font-size:32px;">
                        <?php echo count($FishReview);?>
                    </h3>
                    <p>Jumlah user yang mereview</p>
                </div>
                <div class="icon">
                    <i class="fa fa fa-star"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'user_id',
                'format' => 'html',
                'value' => function ($data){
                    $obj = UserPengguna::find()->where(['user_id' => $data['user_id']])->one();
                    return $obj['user_full_name'];
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            [
                'attribute'=>'fish_id',
                'format' => 'html',
                'value' => function ($data){
                    $obj = Fish::find()->where(['fish_id' => $data['fish_id']])->one();
                    return Html::a($obj['fish_name'], ['fish/view', 'id' => $obj["fish_id"]]);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'review_text:ntext',

            [
                'attribute'=>'review_jumalh',
                'format' => 'html',
                'value' => function ($data){
                    $total = $data['review_jumalh'];
                    if ($total > 0 && $total <= 1) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>' . " ($total)";
                    }else if ($total > 1 && $total <= 2) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>'. " ($total)";
                    }else if ($total > 2 && $total <= 3) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>'. " ($total)";
                    }else if ($total > 3 && $total <= 4) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star "></span>' . " ($total)";
                    }else if ($total > 4 && $total <= 5) {
                        return '<span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>' . " ($total)" ;
                    }

                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
        ],
    ]); ?>
</div>
