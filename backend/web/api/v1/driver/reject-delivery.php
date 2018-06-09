<?php
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");

include '../../connect.php';

if (isset($_POST['driver_id']) && isset($_POST['delivery_id']) && isset($_POST['time'])) {
    $driver_id = $_POST['driver_id'];
    $delivery_id = $_POST['delivery_id'];
    $time = (int)$_POST['time'];

    $newTime = (strtotime($date)) + $time;
    $newDate = date("Y-m-d H:i:s",$newTime);

    $sql_delivery = "UPDATE delivery SET
            delivery_driver_id = 0
            WHERE delivery_id = $delivery_id";

    if ($connect->query($sql_delivery)) {

        $sqldelivery = "SELECT * FROM delivery WHERE delivery_id = $delivery_id";
        $resultDelivery = $connect->query($sqldelivery);
        $rowDelivery = $resultDelivery->fetch_assoc();

        $sql_driver = "SELECT * FROM user_driver WHERE driver_id != $driver_id and driver_device_id != '' and driver_status = 1";
        $resultDriver = $connect->query($sql_driver);
        while ($row = $resultDriver->fetch_assoc()) {
            postNotification(count(json_decode($rowDelivery['delivery_order_id'])), $driver_id, $delivery_id, $row['driver_device_id']);
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Anda berhasil menolak pengiriman";
    }else {
        $response['response'] = 200;
        $response['status'] = false;
        $response['message'] = "Anda gagal menolak pengiriman";
    }

}else {
    $response['response'] = 400;
    $response['status'] = false;
    $response['message'] = "Pastikan parameter anda terisi";
}

function postNotification($jumalah_order, $driver_id, $delivery_id, $idPhone){
    $message = $jumalah_order . " Order Siap Dikirim";
    $title = "JualIkan Driver";

    $path = 'https://fcm.googleapis.com/fcm/send';
    $server = "AAAAqJsb9OQ:APA91bHfkeiN0pol3m2Hj1Z86fbhlj3mNwBk4f_-0OZEXEWigig5sjlh_yviCvxXQv3aUu5riYfxP74d4_6kXkio5jlnm04UG11mlxwW8DZr8vM84trQ8IfkQvv-oOA6KKHm9k9X0ZQK";

    $headers = array(
        'Authorization:key='. $server,
        'Content-Type:application/json'
    );

    $msg = array(
         'body' => $message,
         'title' => $title,
         'click_action' => "DELIVERY_NOTIF"
    );

    $data = array(
        'driver_id' => $driver_id,
        'delivery_id' => $delivery_id
    );

    $fields = array(
      'to' => $idPhone,
      'notification' => $msg,
      'data' => $data
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
