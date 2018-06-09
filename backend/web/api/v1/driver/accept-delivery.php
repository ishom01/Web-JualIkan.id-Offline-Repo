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
            delivery_status = 1,
            delivery_time_depart = '$date',
            delivery_time_arrival = '$newDate',
            delivery_driver_id = $driver_id
            WHERE delivery_id = $delivery_id";

    $sql_driver = "UPDATE user_driver SET driver_status = 2 WHERE driver_id = $driver_id";

    // echo $sql_delivery . "\n" . $sql_driver;

    if ($connect->query($sql_delivery) && $connect->query($sql_driver)) {

        $sqlDelivery = "SELECT * FROM delivery WHERE delivery_id = $delivery_id";
        $deliveryResult = $connect->query($sqlDelivery);
        $row = $deliveryResult->fetch_assoc();

        arrayOrder(json_decode($row['delivery_order_id']), $driver_id);

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil mengambil delivery";
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

function arrayOrder($array_order, $driverId){
    for ($i=0; $i < count($array_order); $i++) {
        $id = $array_order[$i];
        $order = order($id);
        udpateOrder($id, $driverId);
        $user = user($order['order_user_id']);
        postNotification($order['order_id'],$order['order_user_id'],$user['user_device_id']);
    }
}

function order($id){
    include '../../connect.php';
    $sql = "SELECT * FROM `order` WHERE order_id = $id";
    $result = $connect->query($sql);
    return $result->fetch_assoc();
}

function udpateOrder($id, $driverId){
    include '../../connect.php';
    $sql = "UPDATE `order` SET order_driver_id = $driverId WHERE order_id = $id";
    $connect->query($sql);
}

function user($id){
    include '../../connect.php';
    $sql = "SELECT * FROM `user_pengguna` WHERE user_id = $id";
    $result = $connect->query($sql);
    return $result->fetch_assoc();
}

function postNotification($user_id, $order_id, $idPhone){
    $message = "Order anda dalam perjalanan";
    $title = "JualIkan User";

    $path = 'https://fcm.googleapis.com/fcm/send';
    $server = "AAAAqJsb9OQ:APA91bHfkeiN0pol3m2Hj1Z86fbhlj3mNwBk4f_-0OZEXEWigig5sjlh_yviCvxXQv3aUu5riYfxP74d4_6kXkio5jlnm04UG11mlxwW8DZr8vM84trQ8IfkQvv-oOA6KKHm9k9X0ZQK";

    $headers = array(
        'Authorization:key='. $server,
        'Content-Type:application/json'
    );

    $msg = array(
         'body' => $message,
         'title' => $title,
         'click_action' => "ORDER_NOTIF"
    );

    $data = array(
        'user_id' => $order_id,
        'order_id' => $user_id
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
