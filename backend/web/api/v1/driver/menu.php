<?php
  include '../../connect.php';

  $resposne = array();

  if (isset($_POST['driver_id'])) {
      $idDriver = $_POST['driver_id'];

      $menu = array();

      $sql = "SELECT * FROM user_driver WHERE driver_id = $idDriver";
      $result = $connect->query($sql);
      $row = $result->fetch_assoc();

      $driver['id'] = $row['driver_id'];
      $driver['name'] = $row['driver_full_name'];
      $driver['image'] = $row['driver_image'];
      $driver['email'] = $row['driver_email'];
      $driver['phone'] = $row['driver_phone'];
      $driver['saldo'] = (int)$row['driver_saldo'];
      $driver['status'] = (int)$row['driver_status'];

      if ($driver['status'] == 1) {
          $driver['text_status'] = "Aktif";
      }else if ($driver['status'] == 2) {
          $driver['text_status'] = "Delivery";
      }else {
          $driver['text_status'] = "Tidak Aktif";
      }

      $menu['driver'] = $driver;

      $sql2 = "SELECT * FROM delivery WHERE delivery_driver_id = $idDriver ORDER BY delivery_time_depart DESC";
      $result2 = $connect->query($sql2);
      $row2 = $result2->fetch_assoc();

      $last_deliver['id'] = $row2['delivery_id'];
      $last_deliver['code'] = "Pengiriman ID-" . $row2['delivery_code'];
      $last_deliver['order_count'] = count(json_decode($row2['delivery_order_id']));
      $last_deliver['date_time'] = $row2['delivery_time_depart'];
      $last_deliver['distance'] = distanceFormat((int)$row2['delivery_travel_distance']);
      $last_deliver['time'] = timeFormat((int)$row2['delivery_travel_time']);

      if ($row2['delivery_id'] != null) {
          $menu['last_delivery'] = $last_deliver;
      }else {
          $menu['last_delivery'] = null;
      }

      $response['response'] = 200;
      $response['status'] = true;
      $response['message'] = "Data berhasil di ambil";
      $response['data'] = $menu;

  }else {
      $response['response'] = 400;
      $response['status'] = false;
      $response['message'] = "Pastikan parameter anda terisi";
  }

  echo json_encode($response, JSON_PRETTY_PRINT);

  function timeFormat($seconds){
      $hours = floor($seconds / 3600);
      $mins = floor($seconds / 60 % 60);
      $secs = floor($seconds % 60);

      if ($hours != 0) {
          if ($menit != 0) {
              return $hours . " Jam " . $mins . " Menit";
          }else {
              return $hours . " Jam";
          }
      }else {
          if ($mins != 0) {
              return $mins . " Menit";
          }else {
              return $secs . " Detik";
          }
      }
  }

  function distanceFormat($seconds){
      $km = floor($seconds / 1000);
      $rm = floor($seconds / 100 % 10);

      return $km . "," . $rm . " KM";
  }
?>
