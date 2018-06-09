<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserNelayan */

$this->title = 'Tambah Daftar Nelayan';
$this->params['breadcrumbs'][] = ['label' => 'User Nelayans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-nelayan-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
