<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KoperasiLevel */

$this->title = 'Create Koperasi Level';
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
