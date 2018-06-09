<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserDriver */

$this->title = "Ubah data : " . $model->driver_full_name;
$this->params['breadcrumbs'][] = ['label' => 'User Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->driver_id, 'url' => ['view', 'id' => $model->driver_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-driver-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
