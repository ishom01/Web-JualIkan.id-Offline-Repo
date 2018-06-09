<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Fish */

$this->title = 'Tambah Ikan';
$this->params['breadcrumbs'][] = ['label' => 'Fish', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fish-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
