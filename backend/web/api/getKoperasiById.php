<?php
  include 'connect.php';
  $id = $_GET['id'];
  $queryResult = $connect->query("SELECT * FROM user_koperasi WHERE koperasi_status = 1 and koperasi_id = $id");
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();
    $marker[] = floatval($fetchData['koperasi_lat']);
    $marker[] = floatval($fetchData['koperasi_lng']);
    $dialog = array();
    $dialog[] = $fetchData['koperasi_name'];
    $dialog[] = $fetchData['koperasi_address'];
    $result[] = [
        "marker" => $marker,
        "dialog" => $dialog,
        "status" => 1         //order
    ];
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
