<?php
  include 'connect.php';
  $result = array();
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryResult = $connect->query("SELECT * FROM distribution_location WHERE distribution_id = '$id'");
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
  }else {
    $result['response'] = false;
    $result['message'] = "id not found";
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
