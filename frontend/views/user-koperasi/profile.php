<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use frontend\models\Kota;
use common\models\KoperasiLevel;
use frontend\models\UserKoperasi;

/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */

$this->title = $model->koperasi_name;

$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";
$object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
?>
<div class="user-koperasi-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->koperasi_id], ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::a('Delete', ['delete', 'id' => $model->koperasi_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'koperasi_id',
            [
                'attribute'=>'kopreasi_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['kopreasi_image'], ['width' => '100%','height' => '125px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],
            'koperasi_name',
            [
                'attribute'=>'koperasi_level_id',
                'format' => 'html',
                'value' => function ($data){
                    $model = KoperasiLevel::find()->where(['koperasi_level_id' => $data['koperasi_level_id']])->one();
                    return $model['koperasi_level_name'];
                },
            ],
            'koperasi_holder_name',
            'koperasi_holder_phone',
            'koperasi_email:email',
            // 'koperasi_password',
            'koperasi_address:ntext',
            [
                'attribute'=>'koperasi_kota_id',
                'format' => 'html',
                'value' => function ($data){
                    $model = Kota::find()->where(['kota_id' => $data['koperasi_kota_id']])->one();
                    return $model['kota_name'];
                },
            ],
            // 'koperasi_lat',
            // 'koperasi_lng',
            [
                'attribute'=>'koperasi_kota_id',
                'format' => 'html',
                'value' => function ($data){
                    if ($data['koperasi_kota_id'] == 0){
                        return "<p style='color:red;'>Tidak Aktif</p>";
                    }
                    elseif ($data['koperasi_kota_id'] == 1){
                        return "<p style='color:green;'>Aktif</p>";
                    }
                },
            ],
        ],
    ]) ?>

    <div id="map_canvas" class="mapping" style="margin-bottom:20px;"></div>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo $server?>backend/web/js/setMaps.js" ></script>
    <script type="text/javascript">
      getKoperasiById("<?php echo $object->koperasi_id ?>");
    </script>

</div>
