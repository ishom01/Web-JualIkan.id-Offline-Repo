<?php
  $id = $_GET['id'];
  include 'connect.php';
  $sql = "SELECT pesanan.*, user.* FROM `order` as pesanan, user_pengguna as user WHERE user.user_id = pesanan.order_user_id and pesanan.order_id = '$id'";
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
  echo json_encode($result);
  // echo json_encode($result);
 ?>
