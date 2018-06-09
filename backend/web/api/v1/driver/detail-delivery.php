<?php
  include '../../connect.php';

  $response = array();

  if (isset($_GET['delivery_id'])) {

      //do something when right
      $delivery_id = $_GET['delivery_id'];

      $query = "SELECT delivery.*, user_koperasi.* FROM delivery as delivery, user_koperasi as user_koperasi WHERE delivery_id = '$delivery_id' and user_koperasi.koperasi_id = delivery.delivery_order_koperasi_id";
      $result = $connect->query($query);
      $row = $result->fetch_assoc();
      $objDelivery = array();

      //memecah array order
      $orders = array();
      $arrayOrder = json_decode($row['delivery_order_id']);
      for ($i=0; $i < count($arrayOrder); $i++) {

          $idOrder = $arrayOrder[$i];
          $objOrder = array();

          //menjalankan query order
          $query2 = "SELECT `order`.*, user_pengguna.* FROM `order` as `order`, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_id = $idOrder";
          $result2 = $connect->query($query2);
          $row2 = $result2->fetch_assoc();

          $user['id'] = $row2['user_id'];
          $user['name'] = $row2['user_full_name'];
          $user['image'] = $row2['user_image'];
          $user['email'] = $row2['user_email'];
          $user['phone'] = $row2['user_phone'];

          //mengambil data cart
          $cart = array();
          $arrayCart = json_decode($row2['order_cart_id']);
          // echo json_encode($arrayCart);
          $total = 0;
          for ($j=0; $j < count($arrayCart); $j++) {

              $idCart = $arrayCart[$j];
              $objCart = array();

              //menjalankan query keranjang
              $query3 = "SELECT keranjang.*, ikan.* FROM cart as keranjang, fish as ikan WHERE keranjang.cart_id = '$idCart' and ikan.fish_id = keranjang.cart_fish_id";
              $result3 = $connect->query($query3);
              $row3 = $result3->fetch_assoc();

              $objCart['id'] = $row3['cart_id'];
              $objCart['fish_id'] = $row3['cart_fish_id'];
              $objCart['image'] = $row3['fish_image'];
              $objCart['name'] = $row3['fish_name'];
              $objCart['price'] = (int)$row3['fish_price'];
              $objCart['qty'] = (int)$row3['cart_fish_qty'];
              $objCart['total_price'] = $objCart['price'] * $objCart['qty'];
              $total = $objCart['total_price'] + $total;
              $cart[] = $objCart;
          }

          $lokasi['lokasi_name'] = $row2['order_location_adress'];
          $lokasi['lokasi_lat'] = $row2['order_location_lat'];
          $lokasi['lokasi_lng'] = $row2['order_location_lng'];

          $objOrder['id'] = "Order JD-" . $row2['order_id'];
          $objOrder['user'] = $user;
          $objOrder['cart']['items'] = $cart;
          $objOrder['cart']['total'] = $total;
          $objOrder['lokasi'] = $lokasi;

          $orders[] = $objOrder;
      }

      $koperasi['id'] = $row['koperasi_id'];
      $koperasi['name'] = $row['koperasi_name'];
      $koperasi['address'] = $row['koperasi_address'];
      $koperasi['lat'] = $row['koperasi_lat'];
      $koperasi['lng'] = $row['koperasi_lng'];

      $objDelivery['id'] = (int)$row['delivery_id'];
      $objDelivery['code'] = "Pengiriman ID-" . $row['delivery_code'];
      $objDelivery['orders'] = $orders;
      $objDelivery['koperasi'] = $koperasi;

      $time['value'] = (int)$row['delivery_travel_time'];
      $time['text'] = timeFormat($row['delivery_travel_time']);

      $distance['value'] = (int)$row['delivery_travel_distance'];
      $distance['text'] = distanceFormat($row['delivery_travel_distance']);

      $biaya['value'] = (int)$row['delivery_payment'];
      $biaya['text'] = biayaFormat($row['delivery_payment']);

      $objDelivery['time'] = $time;
      $objDelivery['distance'] = $distance;
      $objDelivery['biaya'] = $biaya;
      $objDelivery['status'] = (int) $row['delivery_status'];

      $response['response'] = 200;
      $response['status'] = true;
      $response['message'] = "Data berhasil di ambil";
      $response['data'] = $objDelivery;

      echo json_encode($response, JSON_PRETTY_PRINT);
  }else {

      //do something when false
      $response['response'] = 400;
      $response['status'] = false;
      $response['message'] = "Pastikan parameter anda terisi";

      echo json_encode($response, JSON_PRETTY_PRINT);
  }

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

  function biayaFormat($seconds){
      $km = floor($seconds / 1000);
      $rm = floor($seconds % 1000);

      return "Rp. " . $km . "." . $rm;
  }
?>
