<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Fish;
use common\models\Cart;
use common\models\UserPengguna;
use common\models\UserDriver;
use common\models\PaymentType;
use common\models\DeliveryTime;
/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = "ORDER JD-".$model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <div id="map_canvas" class="mapping" style="margin-bottom:20px;"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='http://localhost/jualikan.id/backend/web/js/timer.js' ></script>
    <?php
      date_default_timezone_set('Asia/Jakarta');
      $date = date("Y-m-d H:i:s");
    ?>

    <p>
        <?php if ($model->order_payment_type_id == 2): ?>
          <a href="<?php echo $model->order_delivery_payment_url ?>" class="btn btn-success">Payment Url</a>
        <?php endif; ?>
        <!-- <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?> -->
        <?= Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <form action='index.php' name='form1' id='form1'>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'order_id',
            [
                'attribute'=>'order_id',
                'value' => function ($data){
                    return "ORDER JD-".$data['order_id'];
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            // 'order_cart_id:ntext',
            [
                'attribute'=>'Order Cart',
                'value' => function ($data){
                    $array = json_decode($data['order_cart_id']);
                    $total = "";
                    for ($i=0; $i < count($array) ; $i++) {
                        $keranjangModel = Cart::find()->where(['cart_id' => $array[$i]])->one();
                        $ikanModel = Fish::find()->where(['fish_id' => $keranjangModel->cart_fish_id])->one();
                        if ($i == (count($array)-1)) {
                            $total = $total . $ikanModel->fish_name . " (" . $keranjangModel->cart_fish_qty ." Kg)";
                        }else {
                            $total = $total . $ikanModel->fish_name . " (" . $keranjangModel->cart_fish_qty ." Kg), ";
                        }
                    }
                    return $total;
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute'=>'Order User',
                'value' => function ($data){
                    $object  = UserPengguna::find()->where(['user_id' => $data['order_user_id']])->one();
                    return $object->user_full_name;
                },
            ],
            'order_location_adress:ntext',
            [
                'attribute'=>'Order Driver',
                'value' => function ($data){
                      $object  = UserDriver::find()->where(['driver_id' => $data['order_driver_id']])->one();
                    return "Belum Ada";
                },
            ],
            // if ($model->order_driver_id != 0) {
            //   'order_driver_id',
            // }
            // 'order_koperasi_location_id',
            [
                'attribute'=>'order_delivery_time',
                'value' => function ($data){
                    if ($data['order_delivery_time'] > 60 && $data['order_delivery_time'] < 3559) {
                        return ((int)($data['order_delivery_time']/60)). " Minutes";
                    }else if ($data['order_delivery_time'] < 60){
                        return ((int)($data['order_delivery_time']/60)). " Second";
                    }else {
                        return ((int)($data['order_delivery_time']/3600)). " Hours";
                    }
                },
            ],
            [
                'attribute'=>'order_delivery_distance',
                'value' => function ($data){
                    if ($data['order_delivery_distance'] > 1000) {
                        return ((int)($data['order_delivery_distance']/1000)). " KiloMeters";
                    }else {
                        return ((int)($data['order_delivery_distance']/1000)). " Meters";
                    }
                },
            ],
            [
                'attribute'=>'order_delivery_payment',
                'value' => function ($data){
                    return "Rp. " . $data['order_delivery_payment'];
                },
            ],
            [
                'attribute'=>'order_payment_total',
                'value' => function ($data){
                    return "Rp. " . $data['order_payment_total'];
                },
            ],
            [
                'attribute'=>'order_weight',
                'value' => function ($data){
                    return $data['order_weight'] . " Kg";
                },
            ],
            [
                'attribute'=>'Order Payment Type',
                'value' => function ($data){
                    $status = $data['order_payment_type_id'];
                    $object  = PaymentType::find()->where(['payment_type_id' => $data['order_payment_type_id']])->one();
                    return $object->payment_type_name;
                },
            ],
            [
                'attribute'=>'order_date',
                'value' => function ($data){
                    Yii::$app->formatter->locale = 'en-US';
                    // echo Yii::$app->formatter->asDate('2014-01-01'); // output: 1. Januar 2014
                    return Yii::$app->formatter->asDate($data['order_date']);
                },
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute'=>'Order Delivery Time',
                'value' => function ($data){

                    $status = $data['order_delivery_time_id'];
                    $object  = DeliveryTime::find()->where(['delivery_time_id' => $data['order_delivery_time_id']])->one();

                    return $object->delivery_time_name;
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'order_status',
                'format' => 'html',
                'label' => 'Status Order',
                'value' => function ($data){
                    if ($data['order_status'] == 0){
                        return "<p style='color:orange;'>Belum Melakukan Pembayaran</p>".
                        Html::a('Verifikasi Pembayaran', ['verifikasipembayaran', 'id' => $data['order_id']],
                        [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Apa Benar kamu akan verifikasi pembayaran ini ?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                    elseif ($data['order_status'] == 1){
                        return "<p style='color:#337ab7;'>Sudah Melakukan Pembayaran</p>";
                    }
                    elseif ($data['order_status'] == 2){
                        return "<p style='color:#337ab7;'>Dalam Proses Pengiriman</p>";
                    }
                    elseif ($data['order_status'] == 3){
                        return "<p style='color:green;'>Pengiriman Selesai</p>";
                    }
                    elseif ($data['order_status'] == 5){
                        return "<p style='color:red;'>Expired</p>";
                    }
                }
            ],
        ],
    ]) ?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
    <script src="http://localhost/jualikan.id/backend/web/js/setMaps.js" ></script>
    <script type="text/javascript">
      getDetailOrder(<?php echo $model->order_id; ?>);
    </script>

</div>
