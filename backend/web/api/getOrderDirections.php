<?php
  include 'connect.php';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $queryResult = $connect->query("SELECT * FROM `order` WHERE order_id = '$id'");
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

      $id2 = $fetchData['order_distribution_location_id'];
      $queryResult1 = $connect->query("SELECT * FROM distribution_location WHERE distribution_id = '$id2'");
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

      $id3 = $fetchData['order_drive_track_id'];
      if ($id3 != 0) {
          $queryResult1 = $connect->query("SELECT * FROM driver_track WHERE driver_track_id = '$id3'");
          while($fetchData1 = $queryResult1->fetch_assoc()){
              $marker = array();
              $marker[] = floatval($fetchData1['driver_lat']);
              $marker[] = floatval($fetchData1['driver_lng']);
              $dialog = array();
              $dialog[] = "Driver";
              $dialog[] = "Lokasi Driver";
              $result[] = [
                  "marker" => $marker,
                  "dialog" => $dialog,
                  "status" => 2         //order
              ];
          }
      }
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
  }else {
    $result['response'] = false;
    $result['message'] = "id not found";
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
