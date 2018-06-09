<?php
  include 'connect.php';

  $month = Date('m');
  $last  = date('t');

  $date_first = date('Y-m-1 00:00:00');
  $date_last = date('Y-m-'. $last . ' H:m:s');

  $id = $_GET['id'];

  $sql = "SELECT pesanan.*, user.*
          FROM `order` as pesanan, user_pengguna as user
          WHERE user.user_id = pesanan.order_user_id and pesanan.order_koperasi_location_id = $id and pesanan.order_date BETWEEN '$date_first' AND '$date_last'";

  $queryResult = $connect->query($sql);
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();

    $marker[] = floatval($fetchData['order_location_lat']);
    $marker[] = floatval($fetchData['order_location_lng']);
    $dialog = array();
    $dialog[] = $fetchData['user_full_name'];
    $dialog[] = $fetchData['order_location_adress'];
    $result[] = [
        "marker" => $marker,
        "dialog" => $dialog,
        "status" => $fetchData['order_status'],        //order
    ];
  }
  echo json_encode($result, JSON_PRETTY_PRINT);
  // echo json_encode($result);
 ?>
