<?php
  include 'connect.php';
  $id = $_GET['id'];
  $resultFinal = array();

  $date = date('y-m-d');

  $sql = "SELECT * FROM `order_example`";
  $queryResult = $connect->query($sql);
  $resultLocation = array();

  $sql1 = " SELECT user_driver.*, driver_track.*
            FROM user_driver as user_driver, driver_track as driver_track
            WHERE user_driver.driver_koperasi_id = '$id' and driver_track.driver_track_id = user_driver.driver_track_id";
  $queryResult1 = $connect->query($sql1);
  $resultDriver = array();

  $sql2 = "SELECT * FROM user_koperasi WHERE koperasi_id = '$id'";
  $queryResult2 = $connect->query($sql2);
  $koperasi = $queryResult2->fetch_assoc();

  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();
    //
    $marker[] = floatval($fetchData['lat']);
    $marker[] = floatval($fetchData['lng']);

    $dialog = array();
    $dialog['id'] = (int)$fetchData['id'];
    $dialog['image'] = "http://localhost/jualikan.id/".$fetchData['image'];
    $dialog['username'] = $fetchData['username'];
    $dialog['address'] = $fetchData['address'];
    $dialog['weight'] = (int) $fetchData['weight'];
    $dialog['price'] = (int) $fetchData['price'];
    $dialog['lat'] = (double) $fetchData['lat'];
    $dialog['lng'] = (double) $fetchData['lng'];

    $resultLocation[] = [
        "marker" => $marker,
        "information" => $dialog,
    ];
  }

  while($fetchData1 = $queryResult1->fetch_assoc()){
    $dialog1 = array();

    $dialog1['id'] = (int)$fetchData1['driver_id'];
    $dialog1['image'] = "http://localhost/jualikan.id/".$fetchData1['driver_image'];
    $dialog1['username'] = $fetchData1['driver_full_name'];
    $dialog1['address'] = $fetchData1['driver_address'];
    $dialog1['device_id'] = "a22affeie";
    $dialog1['weight'] = (int) $fetchData1['driver_vehicle_weight'];
    $dialog1['lat'] = (double) $fetchData1['driver_lat'];
    $dialog1['lng'] = (double) $fetchData1['driver_lat'];

    $resultDriver[] = $dialog1;
  }

  $resultFinal["order"] = $resultLocation;
  $resultFinal["driver"] = $resultDriver;
  $resultFinal["koperasi"] = $koperasi;

  echo json_encode($resultFinal, JSON_PRETTY_PRINT);
  // echo json_encode($result);
 ?>
