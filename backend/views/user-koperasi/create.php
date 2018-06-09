<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */

$this->title = 'Tambah Koperasi';
$this->params['breadcrumbs'][] = ['label' => 'User Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-koperasi-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formVerifikasi', [
        'model' => $model,
    ]) ?>

</div>
