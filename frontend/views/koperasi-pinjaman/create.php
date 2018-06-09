<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KoperasiPinjaman */

$this->title = 'Tambah Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-pinjaman-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
