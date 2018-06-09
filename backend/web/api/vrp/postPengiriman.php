<?php

  $id = $_GET['id'];
  // echo $id;
  $array = json_decode($id);

  echo json_encode($array, JSON_PRETTY_PRINT);

  function upload($arrayOrderId, $driverId, $koperasiId, $waktu, $jarak){
      include '../connect.php';

      //model mengambil data driver
      $driver = driver($driverId);

      
  }

  function pemesanan($id){
      include '../connect.php';
      $sql = "SELECT * FROM `order` WHERE order_id = '$id'";
      $result = $connect->query($sql);
      return $result->fetch_assoc();
  }

  function driver($id){
      include '../connect.php';
      $sql = "SELECT * FROM user_driver WHERE user_driver_id = '$id'";
      $result = $connect->query($sql);
      return $result->fetch_assoc();
  }

  function postNotification($id){
      echo "postNotification";
  }

  function udpateSaldoDriver($delivery_id, $driver_id, $level, $value){
      include '../connect.php';

      $title = "Pembayaran Order-". $delivery_id;

      $sql = "INSERT INTO saldo_history (
                saldo_history_title,
                saldo_user_id,
                saldo_user_level,
                saldo_value)
              VALUES (
                '$title',
                '$driver_id',
                '$level',
                '$value'
              )";

      if ($connect->query($sql)) {
          echo "sukses";
      }else {
          echo "gagal";
      }
  }

?>
