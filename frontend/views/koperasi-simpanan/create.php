<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KoperasiSimpanan */

$this->title = 'Tambah Simpanan';
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-simpanan-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
