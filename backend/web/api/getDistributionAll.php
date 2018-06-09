<?php
  include 'connect.php';
  $queryResult = $connect->query("SELECT * FROM distribution_location");
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();
    $marker[] = floatval($fetchData['distribution_lat']);
    $marker[] = floatval($fetchData['distribution_lng']);
    $dialog = array();
    $dialog[] = $fetchData['distribution_name'];
    $dialog[] = $fetchData['distribution_address'];
    $result[] = [
        "marker" => $marker,
        "dialog" => $dialog,
        "status" => 1         //order
    ];
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
