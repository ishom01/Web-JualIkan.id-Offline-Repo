<?php
  include 'connect.php';
  $sql = "SELECT * FROM `order_example`";
  $queryResult = $connect->query($sql);
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();

    $marker[] = floatval($fetchData['lat']);
    $marker[] = floatval($fetchData['lng']);

    $dialog = array();
    $dialog[] = "http://localhost/jualikan.id/".$fetchData['image'];
    $dialog[] = $fetchData['username'];
    $dialog[] = $fetchData['address'];
    $dialog[] = $fetchData['weight'];
    $dialog[] = $fetchData['price'];

    $result[] = [
        "marker" => $marker,
        "information" => $dialog,
        // "status" => $fetchData['order_status'],        //order
    ];

  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
