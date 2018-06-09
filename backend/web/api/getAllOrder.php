<?php
  include 'connect.php';
  $queryResult = $connect->query("SELECT * FROM `order`");
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();
    $marker[] = floatval($fetchData['order_location_lat']);
    $marker[] = floatval($fetchData['order_location_lng']);
    $dialog = array();
    $dialog[] = "Order ke-" . $fetchData['order_id'];
    $dialog[] = $fetchData['order_location_adress'];
    $result[] = [
        "marker" => $marker,
        "dialog" => $dialog,
        "status" => 2         //order
    ];
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
