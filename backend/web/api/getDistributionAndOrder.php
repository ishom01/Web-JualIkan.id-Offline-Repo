<?php
  include 'connect.php';
  $queryResult = $connect->query("SELECT * FROM `order`");
  $queryResult1 = $connect->query("SELECT * FROM distribution_location");
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

  while($fetchData1 = $queryResult1->fetch_assoc()){
    $marker = array();
    $marker[] = floatval($fetchData1['distribution_lat']);
    $marker[] = floatval($fetchData1['distribution_lng']);
    $dialog = array();
    $dialog[] = $fetchData1['distribution_name'];
    $dialog[] = $fetchData1['distribution_address'];
    $result[] = [
        "marker" => $marker,
        "dialog" => $dialog,
        "status" => 1         //order
    ];
  }

  echo json_encode($result);
  // echo json_encode($result);
 ?>
