<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use frontend\models\UserKoperasi;
use common\models\UserPengguna;
use common\models\Order;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h1 width:"100%" style="text-align:center;">Order selesai dikirim ke driver</h1>
    <h3 width:"100%" style="text-align:center;margin-top:0px;">Sedang menunggu konfirmasi dari driver</h3>
    <div style="text-align:center;"><a href="hariini"><button class="btn btn-success">Kembali ke dashboard order</button></a></div>

</div>
