<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserDriver */

$this->title = 'Daftar Driver Baru';
$this->params['breadcrumbs'][] = ['label' => 'User Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
