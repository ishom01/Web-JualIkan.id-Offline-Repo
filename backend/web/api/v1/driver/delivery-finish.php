<?php
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");

include '../../connect.php';
$response = array();

if (isset($_POST['driver_id']) && isset($_POST['delivery_id'])) {
    $driver_id = $_POST['driver_id'];
    $delivery_id = $_POST['delivery_id'];

    $sql_delivery = "UPDATE delivery SET
            delivery_status = 2
            WHERE delivery_id = $delivery_id";

    $sqlDriver = "SELECT * FROM user_driver WHERE driver_id = $driver_id";
    $result1 = $connect->query($sqlDriver);
    $driver = $result1->fetch_assoc();

    $sqlDelivery = "SELECT * FROM delivery WHERE delivery_id = $delivery_id";
    $result = $connect->query($sqlDelivery);
    $delivery = $result->fetch_assoc();

    $payment = (int) $delivery['delivery_payment'];
    $title = "Pengiriman ID-" . $delivery['delivery_code'];

    if ($connect->query($sql_delivery)) {

        $saldoSekarang = (int)$driver['driver_saldo'];
        $saldoSekarang = $saldoSekarang + $payment;

        $arrayOder = json_decode($delivery['delivery_order_id']);
        for ($i=0; $i < count($arrayOder); $i++) {
            finish_order($arrayOder[$i]);
        }

        $sql_driver = "UPDATE user_driver SET driver_status = 1, driver_saldo = $saldoSekarang WHERE driver_id = $driver_id";
        $sql_saldo_history = "INSERT INTO saldo_history (
          saldo_history_title,
          saldo_user_id,
          saldo_user_level,
          saldo_value)
          VALUES (
          '$title',
          $driver_id,
          2,
          $payment
        )";

        if ($connect->query($sql_driver) && $connect->query($sql_saldo_history)) {
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Delivery berhasil di selesaikan";
        }

    }else {
        $response['response'] = 200;
        $response['status'] = false;
        $response['message'] = "Gagal mengambil delivery";
    }

}else {
    $response['response'] = 400;
    $response['status'] = false;
    $response['message'] = "Pastikan parameter anda terisi";
}

function finish_order($idPemesanan){
    include '../../connect.php';
    $sqlorder = "UPDATE `order` SET order_status = 3 WHERE order_id = $idPemesanan";
    $connect->query($sqlorder);
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
