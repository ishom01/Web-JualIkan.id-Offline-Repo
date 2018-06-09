<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */

$this->title = $model->koperasi_name;
// $this->params['breadcrumbs'][] = ['label' => 'User Koperasis', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->koperasi_id, 'url' => ['view', 'id' => $model->koperasi_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-koperasi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
