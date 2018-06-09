<?php
  include 'connect.php';
  $id = $_GET["id"];

  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d');

  $sql = "SELECT * FROM delivery WHERE delivery_order_koperasi_id = $id and delivery_time_depart like '%{$date}%'";
  $queryResult = $connect->query($sql);
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();
    $arrayOrder = json_decode($fetchData['delivery_order_id']);
    for ($i=0; $i < count($arrayOrder); $i++) {
        $result[] = getOrder($arrayOrder[$i]);
    }
  }
  echo json_encode($result);

  function getOrder($id){
      include 'connect.php';
      $sql = "SELECT pesanan.*, user.* FROM `order` as pesanan, user_pengguna as user WHERE user.user_id = pesanan.order_user_id and pesanan.order_koperasi_location_id";
      $queryResult = $connect->query($sql);
      $fetchData = $queryResult->fetch_assoc();
      $marker = array();

      $marker[] = floatval($fetchData['order_location_lat']);
      $marker[] = floatval($fetchData['order_location_lng']);
      $dialog = array();
      $dialog[] = $fetchData['user_full_name'];
      $dialog[] = $fetchData['order_location_adress'];
      $obj = [
          "marker" => $marker,
          "dialog" => $dialog,
          "status" => $fetchData['order_status'],        //order
      ];

      return $obj;
  }
  // echo json_encode($result);
 ?>
