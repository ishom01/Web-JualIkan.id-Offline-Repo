<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserNelayan */

$this->title = $model->nelayan_full_name;
$this->params['breadcrumbs'][] = ['label' => 'User Nelayans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nelayan_id, 'url' => ['view', 'id' => $model->nelayan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-nelayan-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
